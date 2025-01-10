# Guía para Crear un Servidor LAMP en Ubuntu

Esta guía describe los pasos necesarios para instalar y configurar un servidor LAMP (Linux, Apache, MySQL y PHP) en un sistema operativo basado en Linux, como Ubuntu.

## Requisitos previos

- Una máquina con Ubuntu o cualquier distribución basada en Debian.
- Acceso a una cuenta con privilegios de `sudo`.
- Conexión a internet.

## Paso 1: Actualizar los paquetes del sistema

Antes de comenzar, actualiza los paquetes del sistema para asegurarte de que tienes las últimas versiones.

```bash
sudo apt update && sudo apt upgrade -y
```
## Paso 2: Instalar Apache

Apache es el servidor web que gestionará las solicitudes HTTP.
```bash
sudo apt install apache2 -y
```
Verificar que Apache esté funcionando

Una vez instalado, puedes verificar que Apache esté corriendo accediendo a la dirección IP de tu servidor desde un navegador web. Deberías ver la página de bienvenida de Apache.

http://tu-direccion-ip/

También puedes verificar que el servicio Apache esté activo ejecutando:
```bash
sudo systemctl status apache2
```
## Paso 3: Instalar MySQL

MySQL es el sistema de gestión de bases de datos que usaremos para almacenar la información.
```bash
sudo apt install mysql-server -y
```
Configurar MySQL

Una vez instalado, ejecuta el siguiente comando para asegurar la instalación de MySQL:
```bash
sudo mysql_secure_installation
```
Este comando te guiará a través de la configuración inicial de MySQL, como la creación de una contraseña para el usuario root.
Verificar que MySQL esté funcionando

Puedes verificar el estado de MySQL con:
```bash
sudo systemctl status mysql
```
## Paso 4: Instalar PHP

PHP es el lenguaje de programación que se utilizará para ejecutar scripts en el servidor.
```bash
sudo apt install php libapache2-mod-php php-mysql -y
```
Verificar la instalación de PHP

Puedes crear un archivo phpinfo para verificar que PHP está funcionando correctamente. Primero, crea un archivo en el directorio raíz de Apache:
```bash
sudo nano /var/www/html/info.php
```
Dentro de este archivo, agrega el siguiente contenido:
```php
<?php
phpinfo();
?>
```
Ahora, visita en tu navegador:

http://tu-direccion-ip/info.php

Deberías ver una página con información sobre la configuración de PHP en tu servidor.
## Paso 5: Configuración de Firewall

Si tienes un firewall habilitado, asegúrate de permitir el tráfico HTTP y HTTPS. Puedes hacerlo con el siguiente comando:
```bash
sudo ufw allow in "Apache Full"
```
Verificar el estado del firewall

Para verificar que las reglas se aplicaron correctamente, puedes usar el siguiente comando:
```bash
sudo ufw status
```
## Paso 6: Reiniciar Apache

Finalmente, reinicia el servidor Apache para aplicar los cambios:
```bash
sudo systemctl restart apache2
```