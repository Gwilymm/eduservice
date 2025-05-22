<template>
  <div class="page">
    <div class="d-flex justify-space-between align-center mb-6">
      <h1 class="text-h4">Missions</h1>
      <v-btn
        color="primary"
        variant="text"
        prepend-icon="mdi-arrow-left"
        @click="router.push('/')"
      >
        Retour à la page principale
      </v-btn>
    </div>

    <v-progress-circular v-if="loading" indeterminate color="primary" class="mx-auto d-block my-8"></v-progress-circular>

    <div v-else-if="missions.length === 0" class="text-center my-8">
      <v-icon icon="mdi-alert-circle-outline" size="large" color="info" class="mb-4"></v-icon>
      <h3 class="text-h5 mb-4">Vous n'avez pas encore de missions</h3>
      <p class="mb-6 text-body-1">Commencez par ajouter votre première mission pour accumuler des points.</p>
      <v-btn 
        color="primary" 
        prepend-icon="mdi-plus" 
        @click="router.push('/missions/add')"
      >
        Ajouter une mission
      </v-btn>
    </div>

    <v-table v-else>
      <tbody>
        <tr
          v-for="mission in missions"
          :key="mission.id"
          :class="{ 'striped': mission.id % 2 === 0 }"
        >
          <td class="mission-title">
            {{ mission.title || mission.name }}
            <v-icon
              v-if="mission.proofPath"
              :icon="getFileIcon(getFileType(mission.proofPath))"
              :color="getFileColor(getFileType(mission.proofPath))"
              size="small"
              class="ml-2"
            ></v-icon>
          </td>
          <td class="text-center">{{ formatDate(mission.submissionDate) }}</td>
          <td class="text-center">{{ mission.points || mission.mission?.points }} points</td>
          <td class="text-center">
            <v-chip
              :color="getStatusColor(mission.status)"
              size="small"
              class="status-chip"
            >
              {{ getStatusText(mission.status) }}
            </v-chip>
          </td>
        </tr>
      </tbody>
    </v-table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { getAllMissionSubmissions } from '@/api/missionSubmissionService';

const router = useRouter();
const missions = ref([]);
const loading = ref(true);


const fetchUserMissions = async () => {
  try {
    loading.value = true;
    const response = await getAllMissionSubmissions();
    if (response && Array.isArray(response['hydra:member'])) {
      missions.value = response['hydra:member'];
    } else {
      missions.value = [];
    }
  } catch (error) {
    console.error('Erreur lors de la récupération des missions:', error);
    missions.value = [];
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  fetchUserMissions();
});

const formatDate = (date) => {
  if (!date) return '-';
  return new Date(date).toLocaleDateString('fr-FR');
};

const getFileType = (path) => {
  if (!path) return null;
  if (path.endsWith('.pdf')) return 'pdf';
  if (path.match(/\.(jpg|jpeg|png|gif|webp)$/i)) return 'image';
  if (path.match(/\.(mp4|mov|avi|wmv|flv|mkv)$/i)) return 'video';
  return null;
};

const getFileIcon = (type) => {
  switch (type) {
    case 'pdf':
      return 'mdi-file-pdf-box';
    case 'video':
      return 'mdi-file-video';
    case 'image':
      return 'mdi-file-image';
    default:
      return '';
  }
};

const getFileColor = (type) => {
  switch (type) {
    case 'pdf':
      return 'red';
    case 'video':
      return 'purple';
    case 'image':
      return 'blue';
    default:
      return '';
  }
};

const getStatusColor = (status) => {
  if (!status) return 'warning';
  
  switch (status) {
    case 'approved':
      return 'success';
    case 'rejected':
      return 'error';
    case 'pending':
    default:
      return 'warning';
  }
};

const getStatusText = (status) => {
  if (!status) return 'En attente de validation';
  
  switch (status) {
    case 'approved':
      return 'Validée';
    case 'rejected':
      return 'Refusée';
    case 'pending':
    default:
      return 'En attente de validation';
  }
};
</script>

<style scoped>
.page {
  max-width: 1200px;
  margin: 0 auto;
  padding: 24px;
}

.v-table {
  background: transparent !important;
}

.v-table tbody tr {
  background-color: white;
  border-bottom: 1px solid #eee;
}

.v-table tbody tr.striped {
  background-color: #f5f9fc;
}

.mission-title {
  font-weight: 500;
}

.status-chip {
  min-width: 140px;
}

td {
  height: 48px !important;
  padding: 8px 16px !important;
}
</style>