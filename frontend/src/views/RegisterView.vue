<template>
  <v-container>
    <v-row>
      <v-col>
        <v-form ref="formRef" v-model="isValid" lazy-validation>
          <v-stepper v-model="step" :items="['Informations', 'École', 'Coordonnées', 'Missions']" hide-actions>
            <!-- Step 1 : personal informations -->
            <template v-slot:item.1>
              <v-card>
                <v-card-title>Informations personnelles</v-card-title>
                <v-card-text>
                  <v-text-field v-model="form.firstName" label="Prénom" :rules="[rules.required]"
                    required></v-text-field>

                  <v-text-field v-model="form.lastName" label="Nom" :rules="[rules.required]" required></v-text-field>
                </v-card-text>
              </v-card>
            </template>

            <!-- Step 2 : school & classe -->
            <template v-slot:item.2>
              <v-card>
                <v-card-title>École & Classe</v-card-title>
                <v-card-text>
                  <v-select v-model="form.school" label="École" :items="schools" :rules="[rules.required]"
                    required></v-select>

                  <v-text-field v-model="form.class" label="Classe" :rules="[rules.required]" required></v-text-field>
                </v-card-text>
              </v-card>
            </template>

            <!-- Step 3 : contact details -->
            <template v-slot:item.3>
              <v-card>
                <v-card-title>Coordonnées</v-card-title>
                <v-card-text>
                  <v-text-field v-model="form.email" label="Mail personnel" :rules="[rules.required, rules.email]"
                    required></v-text-field>

                  <v-text-field v-model="form.schoolEmail" label="Mail école" :rules="[rules.required, rules.email]"
                    required></v-text-field>

                  <v-text-field v-model="form.phone" label="Téléphone portable" :rules="[rules.required, rules.phone]"
                    required></v-text-field>
                </v-card-text>
              </v-card>
            </template>

            <!-- Step 4 : Missions -->
            <template v-slot:item.4>
              <v-card>
                <v-card-title>Missions souhaitées</v-card-title>
                <v-card-text>
                  <v-checkbox 
                    v-for="mission in missions" 
                    :key="mission" 
                    v-model="form.missions" 
                    :label="mission"
                    :value="mission" 
                    color="primary"
                    hide-details
                    class="mission-checkbox"
                    >
                  </v-checkbox>
                </v-card-text>
              </v-card>
            </template>
          </v-stepper>
        </v-form>

        <div class="d-flex mt-4">
          <v-btn v-if="step > 1" @click="prevStep" color="grey" class="me-2">
            Précédent
          </v-btn>

          <v-btn v-if="step < 4" :disabled="!isValid" @click="nextStep" color="primary" class="me-2">
            Suivant
          </v-btn>

          <v-btn v-if="step === 4" color="success" @click="submitForm">
            Valider
          </v-btn>
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref } from 'vue';

const step = ref(1);
const isValid = ref(false);
const formRef = ref(null);

const form = ref({
  firstName: '',
  lastName: '',
  school: '',
  class: '',
  email: '',
  schoolEmail: '',
  phone: '',
  missions: [],
});

const schools = [
  'AFTEC',
  'Ipac Bachelor Factory',
  'MBway',
  'WIN Sport School',
  'MyDigitalSchool',
  'IHECF',
  "L'École internationale TUNON"
];

const missions = [
  'Communiquer sur les RS',
  'Poster des avis',
  'Participer à des TikTok',
  'Livrer votre témoignage',
  'Participer à un shooting photos',
  'Intervenir dans votre ancien établissement',
  'Participer à des événements',
  'Parrainer des futurs étudiants'
];


const rules = {
  required: (v) => !!v || 'Ce champ est requis',
  email: (v) => /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(v) || 'Adresse e-mail invalide',
  phone: (v) => /^[0-9]{10}$/.test(v) || 'Le numéro doit contenir 10 chiffres',
};


function nextStep() {
  formRef.value.validate().then((valid) => {
    if (valid) {
      step.value++;
    }
  });
}


function prevStep() {
  if (step.value > 1) {
    step.value--;
  }
}


function submitForm() {
  formRef.value.validate().then((valid) => {
    if (valid) {
      console.log('Formulaire soumis avec :', form.value);
      alert('Formulaire validé avec succès !');
    }
  });
}
</script>

<style scoped>
.mission-checkbox {
  margin-bottom: 8px;
}

:deep(.v-checkbox__control) {
  opacity: 1;
  visibility: visible;
}

:deep(.v-selection-control) {
  opacity: 1;
  min-height: 40px;
}
</style>