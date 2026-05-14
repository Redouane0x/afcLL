RUN apt-get update && apt-get install -y \
    apache2 \
    php8.3 \
    php8.3-cli \
    && apt-get clean && rm -rf /var/lib/apt/lists/*
