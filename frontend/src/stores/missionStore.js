import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useMissionStore = defineStore('mission', () => {
  const selectedMissions = ref([]);

  function setSelectedMissions(missions) {
    selectedMissions.value = missions;
  }

  return {
    selectedMissions,
    setSelectedMissions
  };
});
