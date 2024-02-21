# Usando a imagem oficial do PHP 8.2 CLI como base
FROM php:8.2-cli

# Instalando o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Atualizando os pacotes e instalando dependências
RUN apt-get update && apt-get install -y \
    git \
    zip \
    && rm -rf /var/lib/apt/lists/* # Limpa a lista de pacotes para manter o container limpo

# Instalando e habilitando o Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    # Configurando o Xdebug para cobertura de código e outras opções necessárias
    && echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Definindo o diretório de trabalho para /app
WORKDIR /app

# Copiando o código fonte da aplicação para o diretório de trabalho
COPY . /app
