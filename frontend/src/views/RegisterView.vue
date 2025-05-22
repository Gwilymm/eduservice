<template>
  <v-container>
    <v-row>
      <v-col>
        <v-form ref="formRef" v-model="isValid" lazy-validation>
          <v-stepper
            v-model="step"
            :items="['Informations', 'École', 'Coordonnées', 'Missions']"
            hide-actions
          >
            <!-- Step 1 : personal informations -->
            <template v-slot:item.1>
              <v-card>
                <v-card-title>Informations personnelles</v-card-title>
                <v-card-text>
                  <v-text-field
                    v-model="localForm.firstName"
                    label="Prénom"
                    :rules="[rules.required]"
                    required
                  ></v-text-field>
                  <v-text-field
                    v-model="localForm.lastName"
                    label="Nom"
                    :rules="[rules.required]"
                    required
                  ></v-text-field>
                </v-card-text>
              </v-card>
            </template>

            <!-- Step 2 : school & classe -->
            <template v-slot:item.2>
              <v-card>
                <v-card-title>École & Classe</v-card-title>
                <v-card-text>
                  <v-select
                    v-model="localForm.school"
                    label="École"
                    :items="schools"
                    item-title="name"
                    item-value="id"
                    :rules="[rules.required]"
                    :loading="loadingSchools"
                    required
                  ></v-select>
                  <v-text-field
                    v-model="localForm.class"
                    label="Classe"
                    :rules="[rules.required]"
                    required
                  ></v-text-field>
                </v-card-text>
              </v-card>
            </template>

            <!-- Step 3 : contact details -->
            <template v-slot:item.3>
              <v-card>
                <v-card-title>Coordonnées</v-card-title>
                <v-card-text>
                  <v-text-field
                    v-model="localForm.email"
                    label="Mail personnel"
                    :rules="[rules.required, rules.email]"
                    required
                  ></v-text-field>
                  <v-text-field
                    v-model="localForm.schoolEmail"
                    label="Mail école"
                    :rules="[rules.required, rules.email]"
                    required
                  ></v-text-field>
                  <v-text-field
                    v-model="localForm.phoneNumber"
                    label="Téléphone portable"
                    :rules="[rules.required, rules.phoneNumber]"
                    required
                  ></v-text-field>
                  <v-text-field
                    v-model="localForm.password"
                    label="Mot de passe"
                    :rules="[rules.required, rules.password]"
                    :type="showPassword ? 'text' : 'password'"
                    class="full-width-input"
                    required
                  >
                    <template v-slot:append>
                      <v-icon @click="showPassword = !showPassword">
                        {{ showPassword ? 'mdi-eye-off' : 'mdi-eye' }}
                      </v-icon>
                    </template>
                  </v-text-field>

                  <v-text-field
                    v-model="localForm.confirmPassword"
                    label="Confirmer le mot de passe"
                    :rules="[rules.required, rules.confirmPassword]"
                    :type="showConfirmPassword ? 'text' : 'password'"
                    class="full-width-input"
                    required
                  >
                    <template v-slot:append>
                      <v-icon @click="showConfirmPassword = !showConfirmPassword">
                        {{ showConfirmPassword ? 'mdi-eye-off' : 'mdi-eye' }}
                      </v-icon>
                    </template>
                  </v-text-field>
                </v-card-text>
              </v-card>
            </template>

            <!-- Step 4 : Missions -->
            <template v-slot:item.4>
              <v-card>
                <v-card-title>Missions souhaitées</v-card-title>
                <v-card-text>
                  <div v-for="mission in localForm.selectedMissions" :key="mission.id">
                    <v-checkbox
                      v-model="mission.isCompleted"
                      :label="mission.title"
                      color="primary"
                      @change="updateSelectedMissions"
                    ></v-checkbox>
                  </div>
                </v-card-text>
              </v-card>
            </template>
          </v-stepper>
        </v-form>

        <div class="d-flex mt-4">
          <v-btn v-if="step > 1" @click="prevStep" color="grey" class="me-2"> Précédent </v-btn>

          <v-btn
            v-if="step < 4"
            :disabled="!isValid"
            @click="nextStep"
            color="primary"
            class="me-2"
          >
            Suivant
          </v-btn>

          <v-btn v-if="step === 4" color="success" @click="submitForm"> Valider </v-btn>
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue'
import { useRegisterStore } from '@/stores/registerStore.js'
import { useRouter } from 'vue-router'
import schoolService from '@/api/schoolService.js'
import { createUser } from '@/api/userService'

const router = useRouter()
const formStore = useRegisterStore()
const step = ref(formStore.step)
const isValid = ref(false)
const formRef = ref(null)
const loadingSchools = ref(true)

const localForm = ref({
  firstName: formStore.form.firstName,
  lastName: formStore.form.lastName,
  school: formStore.form.school,
  class: formStore.form.class,
  email: formStore.form.email,
  schoolEmail: formStore.form.schoolEmail,
  phoneNumber: formStore.form.phoneNumber,
  password: formStore.form.password || '',
  confirmPassword: formStore.form.confirmPassword || '',
  selectedMissions: formStore.form.selectedMissions.map((mission) => ({ ...mission })),
})

watch(step, (newStep) => {
  formStore.updateStep(newStep)
})

watch(
  localForm,
  (newValue) => {
    formStore.saveForm(newValue)
  },
  { deep: true },
)

const schools = ref([])

// Charger les écoles depuis l'API lors du chargement du composant
onMounted(async () => {
  try {
    loadingSchools.value = true
    // Récupérer les écoles complètes avec leur id et name
    const fetchedSchools = await schoolService.getAllSchools()

    if (fetchedSchools && fetchedSchools.length > 0) {
      schools.value = fetchedSchools
    } else {
      // Écoles de secours en cas d'échec
    }
  } catch (error) {
    console.error('Erreur lors du chargement des écoles:', error)
    // Même en cas d'erreur, avoir quelques écoles pour que l'interface fonctionne
  } finally {
    loadingSchools.value = false
  }
})

const showPassword = ref(false)
const showConfirmPassword = ref(false)

const rules = {
  required: (v) => !!v || 'Ce champ est requis',
  email: (v) =>
    /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(v) || 'Adresse e-mail invalide',
  phoneNumber: (v) => /^[0-9]{10}$/.test(v) || 'Le numéro doit contenir 10 chiffres',
  password: (v) =>
    /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(v) ||
    'Le mot de passe doit contenir au moins 8 caractères dont 1 lettre et 1 chiffre',
  confirmPassword: (v) =>
    v === localForm.value.password || 'Les mots de passe ne correspondent pas',
}

function nextStep() {
  if (step.value < 4) {
    step.value += 1
  }
}

function prevStep() {
  if (step.value > 1) {
    step.value -= 1
  }
}

function updateSelectedMissions() {}

const submitForm = async() => {
  if (!formRef.value.validate()) {
    return
  }
  await createUser(localForm.value)
  formStore.resetForm()
  router.push('/')
}
</script>
