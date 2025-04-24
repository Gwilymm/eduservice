<template>
  <v-container class="d-flex flex-column align-center justify-center fill-height">
    <h1 class="text-center text-primary mb-16 text-h3">CHALLENGE AMBASSADEUR</h1>
    <v-row justify="center" align="center" class="mt-8 gap-12">
      <!-- Section Connexion -->
      <v-col cols="12" md="6" class="d-flex flex-column align-center pa-8 rounded-lg bg-grey-lighten-3 elevation-2 mr-8">
        <h3 class="text-center mb-8 text-h5">Se connecter</h3>
        <v-form ref="form" v-model="isFormValid" @submit.prevent="login" class="w-100">
          <v-text-field 
            v-model="username"
            label="Identifiant" 
            outlined 
            class="mb-6 text-field-large" 
            :rules="usernameRules"
            hide-details="auto"
            density="comfortable"
            variant="outlined"
            bg-color="white"
          ></v-text-field>
          <v-text-field 
            v-model="password"
            label="Mot de passe" 
            type="password" 
            outlined 
            class="mb-6 text-field-large" 
            :rules="passwordRules"
            hide-details="auto"
            density="comfortable"
            variant="outlined"
            bg-color="white"
          ></v-text-field>
          <v-btn 
            color="primary" 
            class="mt-6 py-4" 
            block 
            type="submit"
            size="x-large"
            height="56"
            :disabled="!isFormValid"
          >OK</v-btn>
        </v-form>
        <v-btn text class="mt-6 text-decoration-underline text-body-1" @click="navigateToRegister">Se créer un compte</v-btn>
      </v-col>

      <!-- Section Présentation -->
      <v-col cols="12" md="5" class="d-flex flex-column align-center pa-8 rounded-lg bg-grey-lighten-3 elevation-2">
        <h3 class="text-center mb-8 text-h5">Consulter la présentation du Challenge Ambassadeur</h3>
        <v-btn text class="text-decoration-underline text-body-1" size="large">Challenge Ambassadeur</v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>
  
<script setup>
import { useRouter } from 'vue-router';
import { ref } from 'vue';

const router = useRouter();
const form = ref(null);
const isFormValid = ref(false);
const username = ref('');
const password = ref('');

const usernameRules = [
  v => !!v || 'L\'identifiant est requis',
  v => (v && v.length >= 3) || 'L\'identifiant doit contenir au moins 3 caractères',
  v => /^[a-zA-Z0-9._-]+$/.test(v) || 'L\'identifiant ne doit contenir que des caractères alphanumériques, points, tirets ou underscores'
];

const passwordRules = [
  v => !!v || 'Le mot de passe est requis',
  v => (v && v.length >= 8) || 'Le mot de passe doit contenir au moins 8 caractères',
  v => /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/.test(v) || 'Le mot de passe doit contenir au moins une majuscule, une minuscule et un chiffre'
];

function navigateToRegister() {
  router.push({ name: 'register' });
}

function login() {
  if (!form.value.validate()) return;
  
  console.log('Tentative de connexion avec:', {
    username: username.value,
    password: password.value
  });
}
</script>

<style scoped>
.text-field-large :deep(.v-field__input) {
  font-size: 1.1rem;
  padding: 12px 16px;
  min-height: 56px;
}

.text-field-large :deep(.v-field__outline) {
  border-width: 2px;
}

.text-field-large :deep(.v-label) {
  font-size: 1.1rem;
}
</style>