import { defineStore } from 'pinia'

export const useRegisterStore = defineStore('form', {
  state: () => ({
    step: JSON.parse(localStorage.getItem('step')) || 1,
    form: JSON.parse(localStorage.getItem('form')) || {
      firstName: '',
      lastName: '',
      school: '',
      class: '',
      email: '',
      schoolEmail: '',
      phone: '',
      selectedMissions: [
        { id: 1, title: 'Communiquer sur les RS', isCompleted: false },
        { id: 2, title: 'Poster des avis', isCompleted: false },
        { id: 3, title: 'Participer à des TikTok', isCompleted: false },
        { id: 4, title: 'Livrer votre témoignage', isCompleted: false },
        { id: 5, title: 'Participer à un shooting photos', isCompleted: false },
        { id: 6, title: 'Intervenir dans votre ancien établissement', isCompleted: false },
        { id: 7, title: 'Participer à des événements', isCompleted: false },
        { id: 8, title: 'Parrainer des futurs étudiants', isCompleted: false },
      ],
    },
  }),
  actions: {
    updateStep(newStep) {
      this.step = newStep
      localStorage.setItem('step', JSON.stringify(newStep))
    },
    updateFormField(field, value) {
      this.form[field] = value
      this.saveToLocalStorage()
    },
    updateMissionStatus(missionId, isCompleted) {
      const mission = this.form.selectedMissions.find((m) => m.id === missionId)
      if (mission) {
        mission.isCompleted = isCompleted
        this.saveToLocalStorage()
      }
    },
    saveToLocalStorage() {
      localStorage.setItem('form', JSON.stringify(this.form))
    },
    saveForm(formData) {
      this.form = { ...formData }
      this.saveToLocalStorage()
    },
    resetForm() {
      this.step = 1;
      this.form = {
        firstName: '',
        lastName: '',
        school: '',
        class: '',
        email: '',
        schoolEmail: '',
        phone: '',
        selectedMissions: [
          { id: 1, title: 'Communiquer sur les RS', isCompleted: false },
          { id: 2, title: 'Poster des avis', isCompleted: false },
          { id: 3, title: 'Participer à des TikTok', isCompleted: false },
          { id: 4, title: 'Livrer votre témoignage', isCompleted: false },
          { id: 5, title: 'Participer à un shooting photos', isCompleted: false },
          { id: 6, title: 'Intervenir dans votre ancien établissement', isCompleted: false },
          { id: 7, title: 'Participer à des événements', isCompleted: false },
          { id: 8, title: 'Parrainer des futurs étudiants', isCompleted: false },
        ],
      };
      localStorage.removeItem('form');
      localStorage.removeItem('step');
    }
  },
})