# Configuración de usuarios y servidor FTP con vsftpd en Ubuntu

Este documento explica cómo configurar un servidor **vsftpd** en Ubuntu para gestionar varios usuarios con distintas condiciones de acceso, seguridad y cifrado.

## Paso 1: Crear los usuarios en el servidor

Primero, crea los usuarios con los siguientes comandos:

```bash
# Crear usuario1 y usuario6 (con jaula en su directorio de trabajo)
sudo useradd -m usuario1
sudo useradd -m usuario6

# Crear usuario2 y usuario5 (sin jaula en su directorio de trabajo)
sudo useradd -m usuario2
sudo useradd -m usuario5

# Crear usuario3 y usuario4 (denegados en el servidor FTP)
sudo useradd -m usuario3
sudo useradd -m usuario4
```

# Paso 2: Configurar la jaula (chroot) para los usuarios

Los usuarios usuario1 y usuario6 deberán estar enjaulados en su directorio de trabajo. Esto significa que solo podrán acceder a sus propios directorios y no a otras partes del sistema.

Edita el archivo de configuración de vsftpd:
```bash
sudo nano /etc/vsftpd.conf
```
Asegúrate de que las siguientes líneas estén configuradas como se indica:
```bash
# Habilitar la jaula para los usuarios
chroot_local_user=YES
```
# No permitir acceso a los usuarios denegados (usuario3 y usuario4)
```bash
user_sub_token=$USER
local_root=/home/$USER/ftp

# Restricciones adicionales
allow_writeable_chroot=YES
```
Luego, asegúrate de que los usuarios usuario1 y usuario6 tengan su directorio de trabajo correcto, por ejemplo, en /home/usuario1/ftp y /home/usuario6/ftp. Si el directorio no existe, crea uno:
```bash
sudo mkdir /home/usuario1/ftp
sudo mkdir /home/usuario6/ftp
```
Asegúrate de cambiar los permisos de estos directorios para que solo el usuario correspondiente tenga acceso:
```bash
sudo chown root:root /home/usuario1
sudo chmod 755 /home/usuario1

sudo chown root:root /home/usuario6
sudo chmod 755 /home/usuario6
```
Luego, crea los subdirectorios dentro de cada uno para que los usuarios puedan escribir en ellos (si es necesario):
```bash
sudo mkdir /home/usuario1/ftp/uploads
sudo mkdir /home/usuario6/ftp/uploads
sudo chown usuario1:usuario1 /home/usuario1/ftp/uploads
sudo chown usuario6:usuario6 /home/usuario6/ftp/uploads
```
# Paso 3: Denegar el acceso de los usuarios usuario3 y usuario4

Para denegar el acceso al servidor a los usuarios usuario3 y usuario4, agrega las siguientes líneas al archivo de configuración vsftpd.conf:
```bash
# Denegar acceso a los usuarios especificados
user_list_file=/etc/vsftpd.user_list
```
Luego, edita el archivo /etc/vsftpd.user_list y agrega los nombres de los usuarios que no deben tener acceso al servidor FTP:
```bash
sudo nano /etc/vsftpd.user_list
```
Agrega los siguientes usuarios a este archivo:
```bash
usuario3
usuario4
```
# Paso 4: Activar el log de usuarios

Para activar el registro de los usuarios que se conectan al servidor FTP, habilita la opción de logging en vsftpd.conf:
```bash
sudo nano /etc/vsftpd.conf
```
Asegúrate de que las siguientes líneas estén presentes y no comentadas:
```bash
# Activar el log de usuarios

xferlog_enable=YES
xferlog_file=/var/log/vsftpd.log
log_ftp_protocol=YES
```
Esto guardará los registros de las transferencias de archivos y otros detalles en el archivo /var/log/vsftpd.log.

# Paso 5: Configurar el tiempo de desconexión por inactividad

Para desconectar automáticamente a los usuarios después de 5 minutos de inactividad, agrega la siguiente configuración en el archivo vsftpd.conf:
```bash
sudo nano /etc/vsftpd.conf
```
Agrega esta línea:
```bash
# Desconectar usuarios después de 5 minutos de inactividad
idle_session_timeout=300
```
Esto desconectará a los usuarios después de 300 segundos (5 minutos) de inactividad.
# Paso 6: Habilitar conexiones cifradas (SSL/TLS)

Para cifrar las conexiones FTP con SSL/TLS, necesitas configurar vsftpd para que acepte conexiones seguras. En el archivo vsftpd.conf, agrega las siguientes líneas:
```bash
sudo nano /etc/vsftpd.conf
```
Agrega o descomenta las siguientes líneas:
```bash
# Activar SSL/TLS

ssl_enable=YES

# Usar un certificado SSL
rsa_cert_file=/etc/ssl/certs/vsftpd.pem
rsa_private_key_file=/etc/ssl/private/vsftpd.key

# Forzar el uso de SSL para las transferencias de datos
force_local_data_ssl=YES
force_local_logins_ssl=YES

# Configurar la versión de TLS (opcional)
ssl_tlsv1_2=YES

# Deshabilitar conexiones anónimas
anonymous_enable=NO
```
Si no tienes un certificado SSL, puedes generar uno auto-firmado con los siguientes comandos:
```bash
# Crear el directorio para almacenar los certificados
sudo mkdir -p /etc/ssl/private /etc/ssl/certs

# Crear un certificado auto-firmado
sudo openssl req -new -x509 -days 365 -nodes -out /etc/ssl/certs/vsftpd.pem -keyout /etc/ssl/private/vsftpd.key
```
Sigue las indicaciones para completar la creación del certificado SSL.

# Paso 7: Reiniciar el servicio de vsftpd

Una vez que hayas realizado todos los cambios, reinicia el servicio vsftpd para aplicar la configuración:
```bash
sudo systemctl restart vsftpd
```
# Paso 8: Verificación

    Puedes verificar que el servidor FTP está funcionando correctamente mediante un cliente FTP (como FileZilla o ftp desde la terminal).
    Asegúrate de que los usuarios usuario1 y usuario6 estén correctamente enjaulados.
    Los usuarios usuario2 y usuario5 deberían poder acceder normalmente.
    Los usuarios usuario3 y usuario4 deberían ser rechazados.

Con esta configuración, tu servidor FTP vsftpd debería estar preparado según las condiciones que mencionaste, incluyendo la seguridad con SSL y las restricciones para cada usuario.