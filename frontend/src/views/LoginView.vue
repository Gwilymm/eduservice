<template>
  <v-container>
    <div class="text-center my-8 pt-8">
      <h1 class="text-primary text-h3">CHALLENGE AMBASSADEUR</h1>
    </div>

    <v-row justify="center" class="mt-4">
      <!-- Section Connexion -->
      <v-col cols="12" md="5" lg="5" xl="4" class="d-flex">
        <v-card class="d-flex flex-column align-center pa-8 elevation-2 w-100">
          <h3 class="text-center mb-8 text-h5">Se connecter</h3>

          <v-alert
            v-if="loginError"
            type="error"
            variant="tonal"
            closable
            class="mb-4 w-100"
            @click:close="loginError = ''"
          >
            {{ loginError }}
          </v-alert>

          <v-form ref="form" v-model="isFormValid" class="w-100" @submit.prevent="login">
            <div class="relative mb-6">
              <label
                for="email"
                class="absolute left-4 top-2 text-gray-500 transition-all duration-200 pointer-events-none peer-placeholder-shown:top-4 peer-placeholder-shown:text-gray-400 peer-focus:opacity-0 peer-focus:top-2 peer-focus:text-gray-500"
              >
                Email
              </label>
              <v-text-field
                id="email"
                v-model="email"
                outlined
                class="peer text-field-large"
                :rules="emailRules"
                hide-details="auto"
                density="comfortable"
                variant="outlined"
                bg-color="white"
                type="email"
              ></v-text-field>
            </div>

            <div class="relative mb-6">
              <label
                for="password"
                class="absolute left-4 top-2 text-gray-500 transition-all duration-200 pointer-events-none peer-placeholder-shown:top-4 peer-placeholder-shown:text-gray-400 peer-focus:opacity-0 peer-focus:top-2 peer-focus:text-gray-500"
              >
                Mot de passe
              </label>
              <v-text-field
                id="password"
                v-model="password"
                outlined
                class="peer text-field-large"
                :rules="passwordRules"
                hide-details="auto"
                density="comfortable"
                variant="outlined"
                bg-color="white"
                type="password"
              ></v-text-field>
            </div>

            <v-btn
              color="primary"
              class="mt-6 py-4"
              block
              type="submit"
              size="x-large"
              height="56"
              :loading="loading"
              :disabled="loading"
            >
              OK
            </v-btn>
          </v-form>

          <v-btn
            text
            class="mt-6 text-decoration-underline text-body-1"
            @click="navigateToRegister"
          >
            Se créer un compte
          </v-btn>
        </v-card>
      </v-col>

      <!-- Espacement entre les cards -->
      <v-col cols="1" md="1"></v-col>

      <!-- Section Présentation -->
      <v-col cols="12" md="5" lg="5" xl="4" class="d-flex">
        <v-card class="d-flex flex-column align-center justify-center pa-8 elevation-2 w-100">
          <h3 class="text-center mb-8 text-h5">
            Consulter la présentation du Challenge Ambassadeur
          </h3>
          <v-btn text class="text-decoration-underline text-body-1" size="large"
            >Challenge Ambassadeur</v-btn
          >
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script setup>
import { useRouter } from 'vue-router'
import { ref, onMounted } from 'vue'
import loginService from '@/api/loginService'
import { useAuthStore } from '@/stores/auth'

const router = useRouter()
const form = ref(null)
const isFormValid = ref(false)
const email = ref('')
const password = ref('')
const loginError = ref('')
const loading = ref(false)
const auth = useAuthStore()

const emailRules = [
  (v) => !!v || "L'email est requis",
  (v) => /.+@.+\..+/.test(v) || "L'email doit être valide",
]

const passwordRules = [
  (v) => !!v || 'Le mot de passe est requis',
  (v) => (v && v.length >= 8) || 'Le mot de passe doit contenir au moins 8 caractères',
  (v) =>
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/.test(v) ||
    'Le mot de passe doit contenir au moins une majuscule, une minuscule et un chiffre',
]

function navigateToRegister() {
  router.push({ name: 'register' })
}

const login = async () => {
  loginError.value = ''

  const { valid } = await form.value.validate()

  if (!valid) {
    return
  }

  loading.value = true

  try {
    const response = await loginService.login({
      email: email.value,
      password: password.value,
    })
    auth.login(response.token)
  } catch (e) {
    console.error('Erreur de connexion:', e)
    if (!e.response) {
      loginError.value =
        'Erreur de connexion au serveur. Veuillez vérifier votre connexion internet.'
    } else if (e.response.status !== 200) {
      loginError.value = 'Email ou mot de passe incorrect'
    } else if (e.response.data && e.response.data.message) {
      loginError.value = e.response.data.message
    } else {
      loginError.value = 'Une erreur est survenue lors de la connexion. Veuillez réessayer.'
    }
  } finally {
    loading.value = false
  }
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
