# /Dockerfile

# 1. Comece com a imagem oficial e estável do WordPress com FPM.
# Usar uma versão específica como '6.6-fpm' é mais seguro que 'latest'.
FROM wordpress:6.6-fpm

# 2. Execute os comandos para instalar o Xdebug
# PECL é o repositório de extensões do PHP.
RUN pecl install xdebug

# 3. Habilite a extensão Xdebug para que o PHP a carregue.
RUN docker-php-ext-enable xdebug
