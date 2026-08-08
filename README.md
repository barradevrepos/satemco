# satemco

### Entorno

#### Contenedores

**Base de datos**

```
docker run -d \
--restart always \
--name satemco-mariadb \
--network satemco-network \
-v satemco-db:/var/lib/mysql \
-e MARIADB_ROOT_PASSWORD=clave_root \
-e MARIADB_DATABASE=satemco \
-e MARIADB_USER=satemco \
-e MARIADB_PASSWORD=clave_satemco \
mariadb
```

**php:8.3-apache**

```
docker run -d \
--restart always \
--name satemco-filament \
--network satemco-network \
-p 8000:80 \
-v satemco-app:/var/www/html \
php:8.3-apache
```

#### Extensiones php

```
apt update
apt install -y git unzip libzip-dev libicu-dev
docker-php-ext-install pdo_mysql zip intl
a2enmod rewrite
```

#### Composer

```
cd /tmp
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
rm composer-setup.php
```

#### Laravel

```
cd /var/www/html
composer create-project laravel/laravel .
```

#### Filament

id: dashboard

```
cd /var/www/html
composer require filament/filament:"^5.0"
php artisan filament:install --panels
```

#### apache2.conf

```
sed -i 's#DocumentRoot /var/www/html#DocumentRoot /var/www/html/public#' /etc/apache2/sites-available/000-default.conf
```



#### Crear imagen

```
docker commit satemco-filament satemco-filament:1.0
```

#### Permisos para escibir sobre app/

```
sudo setfacl -R -m u:$USER:rwX app/
sudo setfacl -R -d -m u:$USER:rwX app/
```



### Aplicación

#### .env

```
DB_CONNECTION=mysql
DB_HOST=satemco-mariadb
DB_PORT=3306
DB_DATABASE=satemco
DB_USERNAME=satemco
DB_PASSWORD=clave_satemco
```

#### Bases de datos

```
cd /var/www/html
php artisan migrate
```

