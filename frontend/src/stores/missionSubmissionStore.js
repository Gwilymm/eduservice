import { defineStore } from 'pinia';
import MissionSubmission from './MissionSubmission';  // Import du modèle MissionSubmission
import { ref, computed } from 'vue';

export const useMissionSubmissionStore = defineStore('missionSubmission', () => {
  const submissions = ref([]); // Liste des soumissions de mission
  const selectedSubmission = ref(null); // Soumission sélectionnée

  // Charger les soumissions (par exemple, après récupération d'une API)
  function loadSubmissions(data) {
    submissions.value = data.map(submissionData => new MissionSubmission(
      submissionData.id,
      submissionData.ambassador,
      submissionData.mission,
      submissionData.proofPath,
      submissionData.status,
      submissionData.rejectionReason,
      submissionData.admin,
      submissionData.submissionDate,
      submissionData.validationDate
    ));
  }

  // Sélectionner une soumission spécifique
  function selectSubmission(submissionId) {
    selectedSubmission.value = submissions.value.find(submission => submission.id === submissionId);
  }

  // Ajouter une soumission
  function addSubmission(submissionData) {
    const newSubmission = new MissionSubmission(
      submissionData.id,
      submissionData.ambassador,
      submissionData.mission,
      submissionData.proofPath,
      submissionData.status,
      submissionData.rejectionReason,
      submissionData.admin,
      submissionData.submissionDate,
      submissionData.validationDate
    );
    submissions.value.push(newSubmission);
  }

  // Retirer une soumission
  function removeSubmission(submissionId) {
    submissions.value = submissions.value.filter(submission => submission.id !== submissionId);
  }

  // Mettre à jour le statut d'une soumission
  function updateSubmissionStatus(submissionId, newStatus) {
    const submission = submissions.value.find(sub => sub.id === submissionId);
    if (submission) {
      submission.status = newStatus;
    }
  }

  // Calculer les soumissions validées
  const approvedSubmissions = computed(() => {
    return submissions.value.filter(submission => submission.isValid());
  });

  // Calculer les soumissions rejetées
  const rejectedSubmissions = computed(() => {
    return submissions.value.filter(submission => submission.status === 'rejected');
  });

  return {
    submissions,
    selectedSubmission,
    loadSubmissions,
    selectSubmission,
    addSubmission,
    removeSubmission,
    updateSubmissionStatus,
    approvedSubmissions,
    rejectedSubmissions
  };
});
