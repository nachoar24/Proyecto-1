[<- Regresar](../entregable01.md)

# Episodio 02: Set Up Your Development Environment

## Resumen

En este episodio se preparó el entorno de desarrollo necesario para trabajar con Laravel. El proyecto se ejecuta dentro de una máquina virtual Debian administrada mediante Vagrant y VirtualBox, utilizando Apache como servidor web y MariaDB como sistema gestor de base de datos.

El proyecto oficial utilizado para este entregable se encuentra en la carpeta compartida:

```text
C:\Users\nacho\ISW811\VMs\webserver\sites\lfs.isw811.xyz
```

Dentro de Debian, el proyecto se trabaja desde:

```text
/home/vagrant/sites/lfs.isw811.xyz
```

También puede accederse mediante:

```text
/vagrant/sites/lfs.isw811.xyz
```

## Comandos utilizados

Para iniciar la máquina virtual desde Git Bash en Windows se utilizaron los siguientes comandos:

```bash
cd ~/ISW811/VMs/webserver
vagrant up
vagrant ssh
```

Dentro de la máquina virtual se verificó el acceso al proyecto:

```bash
cd ~/sites/lfs.isw811.xyz
pwd
```

También se configuró la base de datos `lfs` en MariaDB y se validó el acceso del usuario `larauser`.

```sql
CREATE DATABASE IF NOT EXISTS lfs;

CREATE USER IF NOT EXISTS 'larauser'@'localhost' IDENTIFIED BY 'secret';

GRANT ALL PRIVILEGES ON lfs.* TO 'larauser'@'localhost';

FLUSH PRIVILEGES;
```

Después se verificó la conexión con:

```bash
mariadb -u larauser -p lfs
```

Además, se instalaron las dependencias del proyecto con Composer:

```bash
composer install --no-progress
```

Finalmente, se ejecutaron las migraciones iniciales de Laravel:

```bash
php artisan config:clear
php artisan migrate
php artisan key:generate
```

## Archivos modificados o creados

* `.env.example`
* `composer.json`
* `composer.lock`
* `database/migrations/0001_01_01_000000_create_users_table.php`
* `database/migrations/0001_01_01_000001_create_cache_table.php`
* `database/migrations/0001_01_01_000002_create_jobs_table.php`
* `docs/files/lfs.isw811.xyz.conf`

## Evidencia

Como evidencia del entorno se creó y mantuvo el proyecto Laravel `lfs.isw811.xyz`, se configuró la base de datos `lfs`, se instalaron dependencias con Composer y se ejecutaron las migraciones iniciales.

También se incluyó el archivo de configuración de Apache en:

```text
docs/files/lfs.isw811.xyz.conf
```

## Problemas encontrados y solución

Durante la configuración inicial, al ejecutar comandos de Laravel se presentó el error de que no existía el archivo:

```text
vendor/autoload.php
```

Esto ocurrió porque las dependencias de Composer no estaban completamente instaladas. La solución fue ejecutar:

```bash
composer install --no-progress
```

Luego, al intentar migrar, Laravel intentó conectarse inicialmente con valores incorrectos de base de datos, mostrando un error de acceso para el usuario `root`. La solución fue limpiar la configuración cacheada con:

```bash
php artisan config:clear
```

Después de esto, las migraciones se ejecutaron correctamente.

## Comentarios personales

Este episodio permitió dejar listo el entorno base para trabajar con Laravel dentro de Debian, utilizando Apache y MariaDB en lugar de depender únicamente del servidor de desarrollo de Laravel.
