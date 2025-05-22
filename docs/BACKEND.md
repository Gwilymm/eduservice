# Documentation technique Backend (Symfony)

## Sommaire
- [Contexte et objectifs](#contexte-et-objectifs)
- [Architecture générale](#architecture-générale)
- [Structure du code](#structure-du-code)
- [Principales entités et logique métier](#principales-entités-et-logique-métier)
- [API et flux principaux](#api-et-flux-principaux)
- [Sécurité & RGPD](#sécurité--rgpd)
- [Installation & démarrage](#installation--démarrage)
- [Bonnes pratiques de développement](#bonnes-pratiques-de-développement)
- [Déploiement & CI/CD](#déploiement--cicd)

---

## Contexte et objectifs

La plateforme Challenge Ambassadeur gère les missions, points, classements et récompenses des étudiants ambassadeurs Eduservices. Elle centralise la gestion multi-utilisateurs (ambassadeur, admin, super admin), l’automatisation des flux, la sécurité et la conformité RGPD.

---

## Architecture générale

- **Symfony 7** (API Platform) expose une API RESTful.
- **Doctrine ORM** pour la persistance (MariaDB).
- **JWT** pour l’authentification.
- **EasyAdmin** pour l’admin.
- **Découpage** : entités métier, DTO, Processors, contrôleurs, fixtures.

---

## Structure du code

```
backend/
├── src/
│   ├── Entity/           # Entités Doctrine (User, Mission, Reward, ...)
│   ├── Repository/       # Requêtes personnalisées
│   ├── Controller/       # Contrôleurs API et Admin
│   ├── DataFixtures/     # Données de test
│   ├── Dto/              # Objets de transfert (UserInput, ...)
│   └── State/            # Processors API Platform
├── migrations/           # Migrations Doctrine
├── public/               # Entrée HTTP
├── config/               # Config Symfony
└── ...
```

---

## Principales entités et logique métier

### Utilisateur (`User`)
- Trois rôles : ambassadeur, admin, super admin (champ `roles`)
- Champs : email, mot de passe (hashé), prénom, nom, téléphone, école (relation), missions, classements, submissions, etc.
- Gestion du mot de passe en clair via `plainPassword` (non persisté)
- Méthodes utilitaires : `getFullName()`, `getSchoolName()`, etc.
- Sécurité : chaque utilisateur a au moins `ROLE_USER`.

### Mission (`Mission`)
- Attribuée à un admin, soumise par un ambassadeur.
- Statut, description, points, date de création, etc.

### MissionSubmission
- Dépôt de preuve par l’ambassadeur, validation par l’admin.
- Statut, fichier, date, commentaire, etc.

### Classement (`Ranking`)
- Calculé par challenge, lié à un ambassadeur.

### Récompense (`Reward`)
- Attribuée selon le nombre de points (`minPoints`)
- Peut être unique (`isUniqueReward`)
- Champs : titre, description, etc.

### School, Challenge
- Gestion des écoles et des années scolaires.

---

## API et flux principaux

- **Inscription** : POST `/register` (UserInput DTO, mot de passe hashé, école associée)
- **Connexion** : JWT, endpoint `/login_check`
- **Gestion des missions** : CRUD missions, soumission de preuves, validation admin
- **Classement** : endpoint pour récupérer le classement en temps réel
- **Récompenses** : endpoint pour lister les récompenses accessibles selon les points
- **Sécurité** : accès restreint par rôle (annotations `security` sur les ressources)

---

## Sécurité & RGPD

- **JWT** : chaque requête API nécessite un token
- **Rôles** : accès différencié (ambassadeur, admin, super admin)
- **Validation** : entités validées par Symfony Validator
- **Données personnelles** : suppression sur demande, archivage 3 ans
- **Logs** : journalisation des actions critiques
- **Fichiers** : upload sécurisé, contrôle du type et de la taille

---

## Installation & démarrage

```sh
cd backend
composer install
cp .env .env.local # puis adapter les variables
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
symfony server:start
```

---

## Bonnes pratiques de développement

- Utiliser les groupes de sérialisation pour exposer les bons champs
- Protéger les routes sensibles avec les annotations `security`
- Ne jamais stocker le mot de passe en clair
- Versionner les migrations, ne pas les modifier après application
- Utiliser les DTO pour séparer l’API du modèle interne
- Tester avec des fixtures et des jeux de données réalistes

---

## Déploiement & CI/CD

- **Docker** recommandé pour la prod et le dev
- **CI/CD** : lint, tests, build, migration, déploiement automatisé
- **Environnements** : `.env.local` pour le dev, variables d’environnement pour la prod
- **Commandes utiles** :
```sh
docker-compose up -d
docker exec -it backend-web-1 bash
composer install
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

---

Pour toute question, se référer à ce document ou contacter l’équipe technique référente.
