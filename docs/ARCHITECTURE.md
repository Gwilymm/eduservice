Ce document regroupe plusieurs schémas Mermaid pour illustrer le fonctionnement général du projet **Challenge Ambassadeur**.

## Vue d'ensemble du système

```mermaid
flowchart LR
    user[Utilisateur]
    vue[Vue 3 / Vite]
    api[API Platform / Symfony]
    db[(MariaDB)]
    admin[EasyAdmin]
    jwt[JWT]

    user -->|Interactions UI| vue
    vue -->|Appels Axios| api
    api --> db
    api --> admin
    api --> jwt
```

## Modèle de données simplifié

```mermaid
erDiagram
    User ||--o{ Mission : "crée"
    User ||--o{ MissionSubmission : "soumet"
    Mission ||--o{ MissionSubmission : "reçoit"
    User ||--o{ Ranking : "cumule"
    Ranking }o--|| Challenge : "pour"
    User }o--|| School : "appartient"
    Reward ||--o{ Challenge : "attribué"
```

## Flux d'authentification

```mermaid
sequenceDiagram
    participant U as Utilisateur
    participant F as Frontend
    participant B as Backend
    U->>F: saisie des identifiants
    F->>B: POST /api/login
    B-->>F: JWT
    F->>F: stocke le token
    F->>B: appels protégés avec JWT
```

## Architecture Frontend (simplifiée)

```mermaid
flowchart LR
    Router --> Views
    Views --> Components
    Views --> Stores
    Stores --> Views
    Views --> ApiServices
    ApiServices -->|Axios| API[(Backend)]
```

## Diagramme de base de données complet

```mermaid
erDiagram
    User {
        int id
        string email
        string[] roles
        string password
        string plainPassword    
        string firstName
        string lastName
        string phoneNumber      
        int schoolId
    }
    School {
        int id
        string name
    }
    Challenge {
        int id
        string academicYear
        datetime missionEnd
        datetime sponsorshipEnd
    }
    Mission {
        int id
        string name
        string description
        int points
        bool repeatable
        bool requiresProof
        int maxRepetitions     
        enum status
        int challengeId
        int adminId
    }
    MissionSubmission {
        int id
        int ambassadorId
        int missionId
        string proofPath       
        enum status
        string rejectionReason 
        int adminId            
        datetime submissionDate
        datetime validationDate 
    }
    Ranking {
        int id
        int ambassadorId
        int challengeId
        int points
    }
    Reward {
        int id
        int minPoints
        string title
        string description     
        bool isUniqueReward
    }

    User ||--o{ Mission : "admin"
    User ||--o{ MissionSubmission : "ambassador"
    User ||--o{ Ranking : "ambassador"
    User }o--|| School : "school"
    School ||--o{ User : "users"
    Challenge ||--o{ Mission : "missions"
    Challenge ||--o{ Ranking : "rankings"
    Mission ||--o{ MissionSubmission : "mission"
    Mission }o--|| Challenge : "challenge"
    MissionSubmission }o--|| Mission : "mission"
    MissionSubmission }o--|| User : "admin"
    Ranking }o--|| Challenge : "challenge"
    Reward ||--o{ Challenge : "attribué (logique métier)"
```