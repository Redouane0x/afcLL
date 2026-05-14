# On part d'une base Ubuntu stable
FROM ubuntu:22.04

# Éviter les questions interactives lors de l'installation
ENV DEBIAN_FRONTEND=noninteractive

# Installation des dépendances de base et du dépôt PHP d'Ondřej Surý
RUN apt-get update && apt-get install -y \
    gnupg2 \
    curl \
    ca-certificates \
    zip \
    unzip \
    git \
    lsb-release \
    && curl -sSLo /usr/share/keyrings/deb.sury.org-php.gpg https://packages.sury.org/php/apt.gpg \
    && echo "deb [signed-by=/usr/share/keyrings/deb.sury.org-php.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list \
    && apt-get update && apt-get install -y --no-install-recommends \
    apache2 \
    php8.3 \
    php8.3-cli \
    php8.3-common \
    php8.3-curl \
    php8.3-mbstring \
    php8.3-xml \
    php8.3-zip \
    php8.3-bcmath \
    php8.3-intl \
    php8.3-readline \
    libapache2-mod-php8.3 \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Activation du module rewrite d'Apache (nécessaire pour Laravel)
RUN a2enmod rewrite

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définition du répertoire de travail
WORKDIR /var/www/html

# Copie des fichiers du projet
COPY . .

# Ajustement des permissions pour Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/cache

# Exposition du port 8080 (standard pour Fly.io)
EXPOSE 8080

# Configuration d'Apache pour écouter sur le port 8080
RUN sed -i 's/80/8080/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Lancement d'Apache en premier plan
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
