<template>
  <div class="page">
    <div class="d-flex justify-space-between align-center mb-6">
      <h1 class="text-h4">Récompenses</h1>
      <v-btn color="primary" variant="text" prepend-icon="mdi-arrow-left" @click="goBack">
        Retour à la page précédente
      </v-btn>
    </div>

    <v-progress-circular v-if="loading" indeterminate color="primary" class="mx-auto d-block my-8"></v-progress-circular>

    <div v-else-if="rewards.length === 0" class="text-center my-8">
      <v-icon icon="mdi-alert-circle-outline" size="large" color="info" class="mb-4"></v-icon>
      <h3 class="text-h5 mb-4">Aucune récompense disponible</h3>
      <p class="mb-6 text-body-1">Revenez plus tard pour découvrir de nouvelles récompenses.</p>
    </div>

    <v-table v-else class="full-width">
      <thead>
        <tr>
          <th class="text-left">Titre</th>
          <th class="text-center">Description</th>
          <th class="text-center" @click="sortRewardsByPoints" style="cursor: pointer;">
            Points requis
          </th>
          <th class="text-center">Type</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="reward in rewards" :key="reward.id" :class="{ 'striped': reward.id % 2 === 0 }">
          <td class="reward-title">
            {{ reward.title }}
          </td>
          <td class="text-center">{{ reward.description }}</td>
          <td class="text-center">
            <v-chip color="blue" size="small" class="status-chip">
              {{ reward.minPoints }} points
            </v-chip>
          </td>
          <td class="text-center">
            {{ reward.type === 'unique' ? 'Unique' : 'Standard' }}
          </td>
        </tr>
      </tbody>
    </v-table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { getAllRewards } from '../api/rewardService';

const rewards = ref([]);
const loading = ref(true);
const router = useRouter();

const fetchRewards = async () => {
  try {
    loading.value = true;
    const response = await getAllRewards();
    rewards.value = response.member || [];
  } catch (error) {
    console.error('Erreur lors de la récupération des récompenses :', error);
    rewards.value = [];
  } finally {
    loading.value = false;
  }
};

const goBack = () => {
  router.back();
};

// Méthode pour trier les récompenses par points requis
const sortRewardsByPoints = () => {
  rewards.value.sort((a, b) => a.minPoints - b.minPoints);
};

onMounted(() => {
  fetchRewards();
});
</script>

<style scoped>
.page {
  max-width: 1200px;
  margin: 0 auto;
  padding: 24px;
}

.v-table {
  background: transparent !important;
  width: 100%; 
}

.v-table thead th {
  font-weight: bold;
  text-transform: uppercase;
  background-color: #f5f5f5;
  border-bottom: 2px solid #ddd;
  padding: 12px 16px;
}

.v-table tbody tr {
  background-color: white;
  border-bottom: 1px solid #eee;
}

.v-table tbody tr.striped {
  background-color: #f5f9fc;
}

.reward-title {
  font-weight: 500;
}

.status-chip {
  min-width: 100px;
}

td {
  height: 48px !important;
  padding: 8px 16px !important;
}

th {
  cursor: pointer;
}

th:hover {
  background-color: #f0f0f0;
}
</style>