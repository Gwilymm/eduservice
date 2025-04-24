<template>
  <div class="page">
    <div class="d-flex justify-space-between align-center mb-6">
      <h1 class="text-h4">Mes missions réalisées</h1>
      <v-btn
        color="primary"
        variant="text"
        prepend-icon="mdi-arrow-left"
        @click="router.push('/')"
      >
        Retour à la page principale
      </v-btn>
    </div>

    <v-table>
      <tbody>
        <tr
          v-for="mission in missions"
          :key="mission.id"
          :class="{ 'striped': mission.id % 2 === 0 }"
        >
          <td class="mission-title">
            {{ mission.title }}
            <v-icon
              v-if="mission.fileType"
              :icon="getFileIcon(mission.fileType)"
              :color="getFileColor(mission.fileType)"
              size="small"
              class="ml-2"
            ></v-icon>
          </td>
          <td class="text-center">{{ formatDate(mission.date) }}</td>
          <td class="text-center">{{ mission.points }} points</td>
          <td class="text-center">
            <v-chip
              :color="mission.status === 'validated' ? 'success' : 'warning'"
              size="small"
              class="status-chip"
            >
              {{ mission.status === 'validated' ? 'Validée' : 'En attente de validation' }}
            </v-chip>
          </td>
        </tr>
      </tbody>
    </v-table>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('fr-FR');
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

// Données de test
const missions = ref([
  {
    id: 1,
    title: 'Intervention lycée',
    date: '2024-12-04',
    points: 30,
    status: 'pending',
    fileType: 'pdf'
  },
  {
    id: 2,
    title: 'Shooting photos',
    date: '2024-12-04',
    points: 20,
    status: 'validated',
    fileType: 'image'
  },
  {
    id: 3,
    title: 'Événement',
    date: '2024-12-04',
    points: 30,
    status: 'validated',
    fileType: null
  },
  {
    id: 4,
    title: 'Événement',
    date: '2024-12-04',
    points: 30,
    status: 'validated',
    fileType: null
  },
  {
    id: 5,
    title: 'Témoignage',
    date: '2024-12-04',
    points: 10,
    status: 'validated',
    fileType: 'pdf'
  },
  {
    id: 6,
    title: 'Post RS',
    date: '2024-12-04',
    points: 3,
    status: 'validated',
    fileType: 'video'
  },
  {
    id: 7,
    title: 'Avis E-réputation',
    date: '2024-12-04',
    points: 5,
    status: 'validated',
    fileType: 'image'
  },
  {
    id: 8,
    title: 'Avis E-réputation',
    date: '2024-12-04',
    points: 5,
    status: 'validated',
    fileType: 'image'
  }
]);
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