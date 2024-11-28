# Configuración de SSL y Redirección de HTTP a HTTPS en Apache para el sitio `prueba1.com`

Este archivo te guiará a través de los pasos necesarios para configurar un **VirtualHost** en Apache2 con soporte para **SSL** (HTTPS) y redirigir todo el tráfico HTTP a HTTPS utilizando el módulo **`mod_rewrite`**.

## 1. Instalar los módulos necesarios para SSL y reescritura

Primero, asegúrate de que los módulos necesarios estén habilitados. Esto incluye el módulo **`ssl`** para SSL y **`mod_rewrite`** para las redirecciones.

1. **Habilitar el módulo `ssl`** para habilitar el soporte de SSL:

    ```bash
    sudo a2enmod ssl
    ```

2. **Habilitar el módulo `mod_rewrite`** para permitir redirecciones:

    ```bash
    sudo a2enmod rewrite
    ```

3. **Reiniciar Apache** para que los cambios tomen efecto:

    ```bash
    sudo systemctl restart apache2
    ```

## 2. Crear o obtener un certificado SSL

### Crear un certificado autofirmado

Si solo deseas usar SSL de forma local o para pruebas, puedes generar un certificado autofirmado.

1. Crea el directorio donde almacenarás el certificado y la clave privada:

    ```bash
    sudo mkdir /etc/apache2/ssl
    ```

2. Genera el certificado y la clave privada:

    ```bash
    sudo openssl req -x509 -newkey rsa:4096 -keyout /etc/apache2/ssl/prueba1.key -out /etc/apache2/ssl/prueba1.crt -days 365
    ```

3. Durante el proceso, te pedirá información como el nombre de tu país, estado, ciudad, etc. Completa estos campos según corresponda.

## 3. Configuración del VirtualHost para usar SSL y reescritura de HTTP a HTTPS

Ahora, configura el archivo de tu VirtualHost para habilitar SSL y forzar la redirección de HTTP a HTTPS.

1. **Editar el archivo de configuración del VirtualHost**:

    ```bash
    sudo nano /etc/apache2/sites-available/prueba1.conf
    ```

2. **Configuración del VirtualHost con SSL y reescritura**:

    Agrega la siguiente configuración al archivo **`prueba1.conf`**:

    ```apache
    <VirtualHost *:80>
        ServerAdmin webmaster@prueba1.com
        ServerName prueba1.com
        DocumentRoot /var/www/prueba1.com/public_html

        # Activar la reescritura de URLs
        RewriteEngine On
        RewriteCond %{SERVER_NAME} =prueba1.com [NC]
        RewriteRule ^ https://%{SERVER_NAME}%{REQUEST_URI} [L,R=301]

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
    </VirtualHost>

    <VirtualHost *:443>
        ServerAdmin webmaster@prueba1.com
        ServerName prueba1.com
        DocumentRoot /var/www/prueba1.com/public_html

        # Activar SSL
        SSLEngine on
        SSLCertificateFile /etc/apache2/ssl/prueba1.crt
        SSLCertificateKeyFile /etc/apache2/ssl/prueba1.key

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
    </VirtualHost>
    ```

    - **`RewriteEngine On`**: Activa el motor de reescritura de Apache.
    - **`RewriteCond`**: La condición asegura que la reescritura solo se aplique al dominio **`prueba1.com`**.
    - **`RewriteRule`**: Redirige todo el tráfico HTTP a HTTPS.
    - **`SSLEngine on`**: Habilita SSL en el VirtualHost de HTTPS.
    - **`SSLCertificateFile`** y **`SSLCertificateKeyFile`**: Apuntan a los archivos del certificado SSL y la clave privada.

3. **Habilitar el sitio** y reiniciar Apache para aplicar la configuración:

    ```bash
    sudo a2ensite prueba1.conf
    sudo systemctl restart apache2
    ```

## 4. Verificar que el sitio esté funcionando con SSL

1. Abre tu navegador y ve a **`https://prueba1.com`**.
    - Si configuraste correctamente SSL, tu sitio debe cargarse con el protocolo **HTTPS**.
    - Si estás usando un certificado autofirmado, el navegador puede mostrar un aviso de seguridad. Puedes ignorarlo para probarlo en un entorno de desarrollo.

2. Verifica que el tráfico HTTP se redirige automáticamente a HTTPS. Si accedes a **`http://prueba1.com`**, deberías ser redirigido a **`https://prueba1.com`**.

### Verificación con `curl` (opcional)

Para verificar la respuesta del servidor desde la terminal, puedes usar `curl`:

```bash
curl -I https://prueba1.com
