<template>
    <v-container class="d-flex flex-column align-center justify-center fill-height">
      <h1 class="text-center text-primary mb-16 text-h3">CHALLENGE AMBASSADEUR</h1>
      <v-row justify="center" align="center" class="mt-8 gap-12">
        <!-- Section Connexion -->
        <v-col cols="12" md="4" class="d-flex flex-column align-center pa-8 rounded-lg bg-grey-lighten-3 elevation-2 mr-4">
          <h3 class="text-center mb-8 text-h5">Se connecter</h3>
          <v-text-field label="Identifiant" outlined class="mb-6 w-100" hide-details></v-text-field>
          <v-text-field label="Mot de passe" type="password" outlined class="mb-6 w-100" hide-details></v-text-field>
          <v-btn color="primary" class="mt-6 px-8 py-3" block x-large>OK</v-btn>
          <v-btn text class="mt-6 text-decoration-underline text-body-1" @click="navigateToRegister">Se créer un compte</v-btn>
        </v-col>
  
        <!-- Section Présentation -->
        <v-col cols="12" md="7" class="d-flex flex-column align-center pa-8 rounded-lg bg-grey-lighten-3 elevation-2">
          <h3 class="text-center mb-8 text-h5">Consulter la présentation du Challenge Ambassadeur</h3>
          <v-btn text class="text-decoration-underline text-body-1" x-large>Consulter la présentation du Challenge Ambassadeur</v-btn>
        </v-col>
      </v-row>
    </v-container>
  </template>
  
  <script setup>
  import { useRouter } from 'vue-router';

  const router = useRouter();
  
  function navigateToRegister() {
    router.push({ name: 'register' });
  }
  </script>