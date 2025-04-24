import { defineStore } from 'pinia';
import School from './School';  // Import du modèle School
import { ref, computed } from 'vue';

export const useSchoolStore = defineStore('school', () => {
  const schools = ref([]); // Liste des écoles
  const selectedSchool = ref(null); // École sélectionnée

  // Charger les écoles (par exemple, après récupération d'une API)
  function loadSchools(data) {
    schools.value = data.map(schoolData => new School(
      schoolData.id,
      schoolData.name
    ));
  }

  // Sélectionner une école spécifique
  function selectSchool(schoolId) {
    selectedSchool.value = schools.value.find(school => school.id === schoolId);
  }

  // Ajouter une école
  function addSchool(schoolData) {
    const newSchool = new School(
      schoolData.id,
      schoolData.name
    );
    schools.value.push(newSchool);
  }

  // Retirer une école
  function removeSchool(schoolId) {
    schools.value = schools.value.filter(school => school.id !== schoolId);
  }

  // Ajouter un utilisateur à une école
  function addUserToSchool(schoolId, user) {
    const school = schools.value.find(school => school.id === schoolId);
    if (school) {
      school.addUser(user);
    }
  }

  // Retirer un utilisateur d'une école
  function removeUserFromSchool(schoolId, user) {
    const school = schools.value.find(school => school.id === schoolId);
    if (school) {
      school.removeUser(user);
    }
  }

  return {
    schools,
    selectedSchool,
    loadSchools,
    selectSchool,
    addSchool,
    removeSchool,
    addUserToSchool,
    removeUserFromSchool
  };
});
