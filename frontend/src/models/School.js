class School {
    constructor(id, name) {
      this.id = id;
      this.name = name;
      this.users = []; // Liste des utilisateurs associés à cette école
    }
  
    // Ajouter un utilisateur à l'école
    addUser(user) {
      if (!this.users.includes(user)) {
        this.users.push(user);
      }
    }
  
    // Supprimer un utilisateur de l'école
    removeUser(user) {
      this.users = this.users.filter(u => u !== user);
    }
  
    // Récupérer le nom de l'école
    getName() {
      return this.name;
    }
  }
  
  export default School;
  