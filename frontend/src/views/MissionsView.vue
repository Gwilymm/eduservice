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
      <thead>
        <tr>
          <th>Mission</th>
          <th class="text-center">Date de soumission</th>
          <th class="text-center">Points</th>
          <th class="text-center">Statut</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="mission in missions"
          :key="mission.id"
          :class="{ 'striped': mission.id % 2 === 0 }"
        >
          <td class="mission-title">
            {{ getMissionTitle(mission) }}
            <v-icon
              v-if="mission.proofPath"
              :icon="getFileIcon(getFileType(mission.proofPath))"
              :color="getFileColor(getFileType(mission.proofPath))"
              size="small"
              class="ml-2"
            ></v-icon>
          </td>
          <td class="text-center">{{ formatDate(mission.submissionDate) }}</td>
          <td class="text-center">{{ getMissionPoints(mission) }} points</td>
          <td class="text-center">
            <v-chip
              :color="getStatusColor(mission.status)"
              size="small"
              class="status-chip"
            >
              {{ getStatusText(mission.status) }}
            </v-chip>
          </td>
          <td class="text-center">
            <v-tooltip text="Voir les détails" location="top">
              <template v-slot:activator="{ props }">
                <v-btn
                  v-bind="props"
                  icon="mdi-eye"
                  size="small"
                  variant="text"
                  @click="viewMissionDetails(mission)"
                ></v-btn>
              </template>
            </v-tooltip>
            <v-tooltip v-if="mission.rejectionReason" text="Voir la raison du refus" location="top">
              <template v-slot:activator="{ props }">
                <v-btn
                  v-bind="props"
                  icon="mdi-alert-circle"
                  size="small"
                  variant="text"
                  color="error"
                  @click="showRejectionReason(mission)"
                ></v-btn>
              </template>
            </v-tooltip>
          </td>
        </tr>
      </tbody>
    </v-table>

    <!-- Dialog pour les détails de la mission -->
    <v-dialog v-model="detailDialog" max-width="600px">
      <v-card>
        <v-card-title>
          <span class="text-h5">Détails de la mission</span>
        </v-card-title>
        <v-card-text v-if="selectedMission">
          <v-row>
            <v-col cols="12">
              <strong>Mission:</strong> {{ getMissionTitle(selectedMission) }}
            </v-col>
            <v-col cols="6">
              <strong>Date de soumission:</strong><br>
              {{ formatDateTime(selectedMission.submissionDate) }}
            </v-col>
            <v-col cols="6">
              <strong>Statut:</strong><br>
              <v-chip :color="getStatusColor(selectedMission.status)" size="small">
                {{ getStatusText(selectedMission.status) }}
              </v-chip>
            </v-col>
            <v-col v-if="selectedMission.validationDate" cols="6">
              <strong>Date de validation:</strong><br>
              {{ formatDateTime(selectedMission.validationDate) }}
            </v-col>
            <v-col cols="6">
              <strong>Points:</strong><br>
              {{ getMissionPoints(selectedMission) }}
            </v-col>
            <v-col v-if="selectedMission.rejectionReason" cols="12">
              <strong>Raison du refus:</strong><br>
              <v-alert type="error" variant="tonal" class="mt-2">
                {{ selectedMission.rejectionReason }}
              </v-alert>
            </v-col>
            <v-col v-if="selectedMission.proofPath" cols="12">
              <strong>Preuve fournie:</strong><br>
              <v-btn
                :prepend-icon="getFileIcon(getFileType(selectedMission.proofPath))"
                :color="getFileColor(getFileType(selectedMission.proofPath))"
                variant="outlined"
                size="small"
                class="mt-2"
                @click="viewProof(selectedMission.proofPath)"
              >
                Voir la preuve
              </v-btn>
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" variant="text" @click="detailDialog = false">
            Fermer
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { getMissionSubmissionById } from '@/api/missionSubmissionService';
import { getMissionById } from '@/api/missionService';
import { getCurrentUser } from '@/api/userService';


const router = useRouter();
const missions = ref([]);
const loading = ref(true);
const detailDialog = ref(false);
const selectedMission = ref(null);

const fetchMissionDetails = async (missionId) => {
  try {
    const response = await getMissionById(missionId);
    return response;
  } catch (error) {
    console.error(`Erreur lors de la récupération des détails de la mission ${missionId}:`, error);
    return null;
  }
};

const fetchUserMissions = async () => {
  try {
    loading.value = true;

    const user = await getCurrentUser();
    const submissionUrls = user.missionSubmissions || [];

    const submissionDetails = await Promise.all(
      submissionUrls.map(async (url) => {
        try {
          const id = url.split('/').pop();
          const submission = await getMissionSubmissionById(id);

          if (submission.mission) {
            const missionId = submission.mission.split('/').pop();
            const missionDetails = await fetchMissionDetails(missionId);
            submission.missionDetails = missionDetails;  // <-- ici on ajoute la vraie mission
          }

          return submission;
        } catch (error) {
          console.error(`Erreur sur la soumission ${url}`, error);
          return null;
        }
      })
    );

    missions.value = submissionDetails.filter(Boolean);
  } catch (error) {
    console.error('Erreur lors de la récupération des missions utilisateur:', error);
    missions.value = [];
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  fetchUserMissions();
});

const getMissionTitle = (submission) => {
  if (submission.missionDetails && submission.missionDetails.name) {
    return submission.missionDetails.name;
  }
  return 'Mission inconnue';
};

const getMissionPoints = (submission) => {
  if (submission.missionDetails && submission.missionDetails.points) {
    return submission.missionDetails.points;
  }
  return '-';
};

const formatDate = (date) => {
  if (!date) return '-';
  return new Date(date).toLocaleDateString('fr-FR');
};

const formatDateTime = (date) => {
  if (!date) return '-';
  return new Date(date).toLocaleString('fr-FR');
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
      return 'mdi-file';
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
      return 'grey';
  }
};

const getStatusColor = (status) => {
  if (!status) return 'warning';

  switch (status) {
    case 'approved':
      return 'success';
    case 'rejected':
      return 'error';
    case 'submitted':
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
    case 'submitted':
      return 'Soumise';
    case 'pending':
    default:
      return 'En attente de validation';
  }
};

const viewMissionDetails = (mission) => {
  selectedMission.value = mission;
  detailDialog.value = true;
};

const showRejectionReason = (mission) => {
  selectedMission.value = mission;
  detailDialog.value = true;
};

const baseStaticUrl = 'http://localhost';

const viewProof = (proofPath) => {
  if (!proofPath) return;
  const url = proofPath.startsWith('/') ? baseStaticUrl + proofPath : `${baseStaticUrl}/${proofPath}`;
  window.open(url, '_blank');
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

.v-table thead th {
  background-color: #f8f9fa;
  font-weight: 600;
  border-bottom: 2px solid #dee2e6;
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

th {
  padding: 12px 16px !important;
}
</style>
