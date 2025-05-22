<template>
  <div class="page">
    <h1 class="text-h4 mb-6">Récompenses</h1>
    <v-progress-circular v-if="loading" indeterminate color="primary" class="mx-auto my-8" />
    <v-alert v-else-if="rewards.length === 0" type="info" class="my-8">
      Aucune récompense disponible pour le moment.
    </v-alert>
    <v-table v-else>
      <thead>
        <tr>
          <th>Titre</th>
          <th>Description</th>
          <th>Points requis</th>
          <th>Unique</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="reward in rewards" :key="reward.id">
          <td>{{ reward.title }}</td>
          <td>{{ reward.description }}</td>
          <td>{{ reward.minPoints }}</td>
          <td>{{ reward.isUniqueReward ? 'Oui' : 'Non' }}</td>
        </tr>
      </tbody>
    </v-table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { getAllRewards } from '../api/rewardService'; 

const rewards = ref([]);
const loading = ref(true);

const fetchRewards = async () => {
  console.log('Début de la fonction fetchRewards');
  try {
    loading.value = true;
    console.log('Chargement des récompenses...');
    const response = await getAllRewards();
    console.log('Réponse de l\'API reçue :', response);
    rewards.value = response.member || [];
    console.log('Récompenses mises à jour :', rewards.value);
  } catch (error) {
    console.error('Erreur lors de la récupération des récompenses :', error);
    rewards.value = [];
  } finally {
    loading.value = false;
    console.log('Chargement terminé. Valeur de loading :', loading.value);
  }
};

onMounted(() => {
  console.log('Composant monté. Appel de fetchRewards.');
  fetchRewards();
});
</script>

<style scoped>
.page {
  max-width: 1200px;
  margin: 0 auto;
  padding: 24px;
}
</style>