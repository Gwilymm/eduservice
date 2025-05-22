# Eduservice Challenge Ambassadeur

Ce dépôt contient la plateforme de gestion des missions, points et classements des étudiants ambassadeurs Eduservices.

👉 **La documentation technique complète est disponible dans [`docs/README.md`](docs/README.md)**

## Démarrage rapide backend

```sh
docker exec -it backend-web-1 bash
composer install
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

## Convention de nommage des branches

- `front-` ou `back-` suivi du nom de la feature
- Exemple : `back-db-setup`