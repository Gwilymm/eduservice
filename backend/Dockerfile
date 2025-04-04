# Dockerfile pour FrankenPHP avec Symfony 7
FROM dunglas/frankenphp:latest

# Définir le répertoire de travail dans le conteneur
WORKDIR /app

# Copier uniquement les fichiers nécessaires pour installer les dépendances
COPY composer.json composer.lock symfony.lock ./

# Installer les dépendances PHP
RUN install-php-extensions \
	pdo_mysql \
	gd \
	intl \
	zip \
	opcache
# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Installer les dépendances PHP
RUN composer install --no-dev --no-scripts --no-progress --prefer-dist

# Copier le reste du projet dans le conteneur
COPY . /app/

