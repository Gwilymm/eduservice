class Reward {
    constructor(id, minPoints, title, description, isUniqueReward) {
      this.id = id;
      this.minPoints = minPoints;
      this.title = title;
      this.description = description;
      this.isUniqueReward = isUniqueReward;
    }
  
    // Méthode pour vérifier si l'utilisateur a droit à la récompense
    isEligible(userPoints) {
      return userPoints >= this.minPoints;
    }
  }
  
  export default Reward;
  