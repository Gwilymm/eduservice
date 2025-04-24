class MissionSubmission {
  constructor(id, ambassador, mission, proofPath, status, rejectionReason, admin, submissionDate, validationDate) {
    this.id = id;
    this.ambassador = ambassador; // Représente l'ID ou l'objet User
    this.mission = mission; // Représente l'ID ou l'objet Mission
    this.proofPath = proofPath;
    this.status = status; // Représente l'état de la soumission
    this.rejectionReason = rejectionReason;
    this.admin = admin; // Représente l'ID ou l'objet User
    this.submissionDate = submissionDate;
    this.validationDate = validationDate;
  }

  // Méthode pour vérifier si la soumission est validée
  isValid() {
    return this.status === 'approved';
  }

  // Méthode pour formater la date de soumission
  formatDate(date) {
    return date ? new Date(date).toLocaleDateString() : '';
  }
}

export default MissionSubmission;
