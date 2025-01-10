# Guía para Importar una Base de Datos en phpMyAdmin y Usar un Proyecto PHP

Esta guía te llevará a través de los pasos para importar una base de datos en phpMyAdmin y configurar un proyecto PHP que utilice dicha base de datos.

## Requisitos previos

- Tener un servidor LAMP (Linux, Apache, MySQL, PHP) funcionando.
- Tener acceso a **phpMyAdmin**.
- Tener una base de datos MySQL en formato `.sql`.
- Un proyecto PHP listo para conectarse a la base de datos.

## Paso 1: Acceder a phpMyAdmin

1. **Abrir phpMyAdmin**: 
   Abre tu navegador y accede a phpMyAdmin usando la dirección IP de tu servidor, por ejemplo:
http://localhost/phpmyadmin


2. **Iniciar sesión**:
Inicia sesión con el usuario `root` o cualquier otro usuario que tenga privilegios para gestionar bases de datos.

## Paso 2: Importar la Base de Datos

1. **Seleccionar la base de datos**:
Si ya tienes una base de datos creada, selecciona la base de datos en el panel izquierdo. Si no tienes una base de datos, crea una nueva:
- Haz clic en el botón "Nuevo" en la barra lateral izquierda.
- Escribe el nombre de la base de datos y selecciona el cotejamiento adecuado (por ejemplo, `utf8_general_ci`).
- Haz clic en **Crear**.

2. **Importar el archivo `.sql`**:
- Una vez que hayas seleccionado o creado la base de datos, haz clic en la pestaña **Importar** en la parte superior.
- Haz clic en **Seleccionar archivo** y selecciona el archivo `.sql` en tu computadora que deseas importar.
- Asegúrate de que el formato sea **SQL** y haz clic en **Ejecutar**.

3. **Verificar la importación**:
Una vez que se complete la importación, deberías ver las tablas y los datos de la base de datos en la columna de la izquierda.

## Paso 3: Configuración del Proyecto PHP

Ahora que la base de datos está importada, vamos a configurar un proyecto PHP para conectarse a esta base de datos.

### 3.1: Subir el Proyecto PHP a `/var/www/html`

1. **Crear un directorio para tu proyecto**:
Si no tienes tu proyecto en el directorio `/var/www/html`, debes moverlo allí. Por ejemplo:
```bash
sudo mv /ruta/del/proyecto /var/www/html/mi_proyecto
```
2. **Dar permisos al directorio: Si el proyecto necesita permisos de escritura, otórgales permisos con el siguiente comando**:
```bash
sudo chown -R www-data:www-data /var/www/html/mi_proyecto
sudo chmod -R 755 /var/www/html/mi_proyecto
```
### 3.2: Configurar la Conexión a la Base de Datos en PHP

En tu proyecto PHP, necesitas configurar la conexión a la base de datos MySQL. Crea o edita un archivo PHP (por ejemplo, config.php) con los siguientes datos:
```php
<?php
$servername = "localhost"; 
$username = "root";
$password = "tu_contraseña";
$dbname = "nombre_de_base_de_datos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conectado exitosamente a la base de datos";
?>
```
### 3.3: Usar la Conexión en tu Proyecto PHP

Una vez que la conexión esté configurada, puedes empezar a usarla en cualquier archivo PHP de tu proyecto. Por ejemplo, en el archivo index.php, puedes incluir la conexión y ejecutar consultas SQL:
```php
<?php
include('config.php');

// Ejemplo de consulta
$sql = "SELECT * FROM usuarios"; // Cambia esto por una tabla de tu base de datos
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Nombre: " . $row["nombre"]. "<br>";
    }
} else {
    echo "0 resultados";
}

$conn->close();
?>
```
### 3.4: Acceder al Proyecto en el Navegador

    Abrir el navegador: Abre un navegador web y ve a la URL:

    http://localhost/mi_proyecto/index.php

    Verificar la conexión: Si todo está bien configurado, deberías ver los resultados de la consulta en la página web.

## Paso 4: (Opcional) Configuración de Virtual Hosts

Si prefieres trabajar con un nombre de dominio local, puedes configurar un Virtual Host en Apache.

    Crear un archivo de configuración: Crea un archivo en /etc/apache2/sites-available/mi_proyecto.conf con el siguiente contenido:
```bash
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html/mi_proyecto
    ServerName mi_proyecto.local

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```
Habilitar el sitio:
```bash
sudo a2ensite mi_proyecto.conf
sudo systemctl reload apache2
```
Editar el archivo hosts para agregar un dominio local:
```bash
sudo nano /etc/hosts
```
Agrega la siguiente línea:
```bash
127.0.0.1   mi_proyecto.local
```
Acceder al proyecto: Ahora, podrás acceder a tu proyecto a través de:

http://mi_proyecto.local
