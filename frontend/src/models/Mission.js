class Mission {
    constructor(id, name, description, points, challenge, admin, repeatable, maxRepetitions, status) {
      this.id = id;
      this.name = name;
      this.description = description;
      this.points = points;
      this.challenge = challenge; // Représente l'ID ou l'objet Challenge
      this.admin = admin; // Représente l'ID ou l'objet User
      this.repeatable = repeatable;
      this.maxRepetitions = maxRepetitions;
      this.status = status;
      this.missionSubmissions = [];  // Liste des soumissions de mission
    }
  
    // Ajouter une soumission de mission
    addMissionSubmission(submission) {
      this.missionSubmissions.push(submission);
    }
  
    // Retirer une soumission de mission
    removeMissionSubmission(submissionId) {
      this.missionSubmissions = this.missionSubmissions.filter(submission => submission.id !== submissionId);
    }
  
    // Vérifier si la mission est répétable
    isRepeatable() {
      return this.repeatable && (this.maxRepetitions === null || this.missionSubmissions.length < this.maxRepetitions);
    }
  
    // Format de la date (si applicable)
    formatDate(date) {
      return date ? new Date(date).toLocaleDateString() : '';
    }
  }
  
  export default Mission;
  