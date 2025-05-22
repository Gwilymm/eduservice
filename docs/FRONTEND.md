# Documentation technique Frontend (Vue.js)

## Sommaire
- [Contexte et objectifs](#contexte-et-objectifs)
- [Architecture générale](#architecture-générale)
- [Structure du code](#structure-du-code)
- [Organisation des vues, stores et API](#organisation-des-vues-stores-et-api)
- [Flux utilisateur et fonctionnement](#flux-utilisateur-et-fonctionnement)
- [Sécurité & RGPD côté front](#sécurité--rgpd-côté-front)
- [Installation & démarrage](#installation--démarrage)
- [Bonnes pratiques de développement](#bonnes-pratiques-de-développement)
- [Déploiement & CI/CD](#déploiement--cicd)

---

## Contexte et objectifs

Le frontend permet aux ambassadeurs, admins et super admins d’interagir avec la plateforme Challenge Ambassadeur : gestion des missions, dépôts de preuves, consultation du classement, notifications, etc.

---

## Architecture générale

- **Vue.js 3** (composition API)
- **Vite** pour le build et le hot-reload
- **Vuetify** pour le design system
- **Pinia** pour la gestion d’état
- **Axios** pour les appels API
- **Organisation modulaire** : vues, composants, stores, modèles, services API

---

## Structure du code

```
frontend/
├── src/
│   ├── api/              # Services d’appel à l’API backend (ex : userApi.js, missionApi.js)
│   ├── components/       # Composants Vue réutilisables (ex : MissionCard, RewardDialog)
│   ├── models/           # Modèles JS (Mission, Challenge, User, Reward, ...)
│   ├── stores/           # Pinia stores (userStore, missionStore, rankingStore, ...)
│   ├── views/            # Pages principales (Home, Missions, Classement, Admin, ...)
│   └── assets/           # Images, styles, ...
├── public/               # Fichiers statiques
├── README.md             # Documentation front spécifique
└── ...
```

---

## Organisation des vues, stores et API

- **Vues** : chaque page correspond à une vue (missions, classement, récompenses, admin, etc.)
- **Stores Pinia** : centralisent l’état utilisateur, missions, classement, notifications, etc.
- **Services API** : chaque ressource a un service dédié (ex : `userApi.js`, `missionApi.js`)
- **Modèles** : classes JS pour structurer les données (Mission, User, Reward...)
- **Composants** : réutilisables, découplés, typés via props

---

## Flux utilisateur et fonctionnement

- **Connexion** : formulaire, appel API `/login_check`, stockage du JWT (localStorage ou cookie sécurisé)
- **Navigation** : routes protégées selon le rôle (ambassadeur, admin, super admin)
- **Gestion des missions** : affichage, dépôt de preuve (upload), suivi du statut
- **Classement** : récupération en temps réel via l’API, affichage dynamique
- **Récompenses** : affichage conditionnel selon les points de l’utilisateur
- **Notifications** : via store, affichage contextuel
- **Déconnexion** : suppression du token, reset du store

---

## Sécurité & RGPD côté front

- **Stockage du JWT** : privilégier le cookie HttpOnly sécurisé ou localStorage avec précaution
- **Protection des routes** : guards selon le rôle utilisateur
- **Aucune donnée sensible stockée côté client**
- **Consentement** : affichage d’une bannière RGPD si besoin

---

## Installation & démarrage

```sh
cd frontend
npm install
npm run dev
```

Pour builder la version production :
```sh
npm run build
```

---

## Bonnes pratiques de développement

- Utiliser la composition API et les stores Pinia pour la logique métier
- Centraliser les appels API dans `/src/api/`
- Typage fort des modèles (classes JS)
- Séparer composants, vues et stores
- Utiliser les slots et props pour des composants réutilisables
- Linter et formatter le code avant chaque commit (`npm run lint`)
- Documenter chaque composant et store

---

## Déploiement & CI/CD

- **Build** : `npm run build` (dossier `dist/`)
- **Déploiement** : sur serveur statique ou via Docker
- **CI/CD** : lint, tests, build, déploiement automatisé
- **Environnements** : variables dans `.env` ou `.env.production`

---

Pour toute question, se référer à ce document ou contacter l’équipe technique référente.
