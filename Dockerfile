# 1. Base Ubuntu 22.04
FROM ubuntu:22.04
ENV DEBIAN_FRONTEND=noninteractive

# 2. Installation de PHP 8.4, dépendances ET Node.js (pour compiler le CSS)
RUN apt-get update && apt-get install -y gnupg2 curl ca-certificates zip unzip git lsb-release \
    && curl -sSLo /usr/share/keyrings/deb.sury.org-php.gpg https://packages.sury.org/php/apt.gpg \
    && echo "deb [signed-by=/usr/share/keyrings/deb.sury.org-php.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update && apt-get install -y --no-install-recommends \
    apache2 php8.4 php8.4-cli php8.4-common php8.4-curl php8.4-mbstring php8.4-xml php8.4-zip php8.4-bcmath php8.4-intl php8.4-readline php8.4-sqlite3 libapache2-mod-php8.4 nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 3. Activation du module rewrite
RUN a2enmod rewrite

# 4. Modification du port d'écoute Apache (80 -> 8080)
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf

# 5. Configuration d'un VirtualHost pour Laravel
RUN echo "<VirtualHost *:8080>" > /etc/apache2/sites-available/000-default.conf \
    && echo "    DocumentRoot /var/www/html/public" >> /etc/apache2/sites-available/000-default.conf \
    && echo "    <Directory /var/www/html/public>" >> /etc/apache2/sites-available/000-default.conf \
    && echo "        AllowOverride All" >> /etc/apache2/sites-available/000-default.conf \
    && echo "        Require all granted" >> /etc/apache2/sites-available/000-default.conf \
    && echo "    </Directory>" >> /etc/apache2/sites-available/000-default.conf \
    && echo "</VirtualHost>" >> /etc/apache2/sites-available/000-default.conf

# 6. Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7. Copie des fichiers du projet
WORKDIR /var/www/html
COPY . .

# 8. LA MAGIE : Compilation du CSS/JS (Vite) directement sur le serveur
RUN npm install \
    && npm run build

# 9. Création du lien pour les images et ajustement des permissions
RUN php artisan storage:link \
    && mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database \
    && touch /var/www/html/database/database.sqlite \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database /var/www/html/public/build \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database /var/www/html/public/build

# 10. Exposition du port et lancement d'Apache
EXPOSE 8080
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
