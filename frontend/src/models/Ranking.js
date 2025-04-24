class Ranking {
    constructor(id, ambassador, challenge) {
      this.id = id;
      this.ambassador = ambassador;
      this.challenge = challenge;
    }
  
    // Méthode pour mettre à jour un classement
    updateRanking(ambassador, challenge) {
      this.ambassador = ambassador;
      this.challenge = challenge;
    }
  
    // Optionnel : méthode pour vérifier si le classement est valide
    isValid() {
      return this.ambassador && this.challenge;
    }
  }
  
  export default Ranking;
  