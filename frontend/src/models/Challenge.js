class Challenge {
    constructor(id, academicYear, missionEnd, sponsorshipEnd) {
      this.id = id;
      this.academicYear = academicYear;
      this.missionEnd = missionEnd ? new Date(missionEnd) : null;
      this.sponsorshipEnd = sponsorshipEnd ? new Date(sponsorshipEnd) : null;
      this.missions = [];  // Liste des missions liées à ce challenge
      this.rankings = [];  // Liste des classements pour ce challenge
    }
  
    // Ajouter une mission au challenge
    addMission(mission) {
      this.missions.push(mission);
    }
  
    // Retirer une mission du challenge
    removeMission(missionId) {
      this.missions = this.missions.filter(mission => mission.id !== missionId);
    }
  
    // Ajouter un classement au challenge
    addRanking(ranking) {
      this.rankings.push(ranking);
    }
  
    // Retirer un classement du challenge
    removeRanking(rankingId) {
      this.rankings = this.rankings.filter(ranking => ranking.id !== rankingId);
    }
  
    // Méthode pour vérifier si le challenge est terminé
    isChallengeFinished() {
      const currentDate = new Date();
      return this.missionEnd && currentDate > this.missionEnd;
    }
  
    // Optionnel : méthode pour formater la date
    formatDate(date) {
      return date ? date.toLocaleDateString() : '';
    }
  }
  
  export default Challenge;
  