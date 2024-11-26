# Configuración de Usuarios, Logs y SSL en vsftpd

Este documento explica cómo configurar **vsftpd** para gestionar usuarios, habilitar el registro de actividad y activar conexiones seguras utilizando SSL/TLS en un servidor Ubuntu.

## Paso 1: Instalación de vsftpd

Si aún no tienes instalado **vsftpd**, comienza por instalarlo en tu servidor Ubuntu:

```bash
sudo apt update
sudo apt install vsftpd
```
Verifica que el servicio vsftpd se esté ejecutando:
```bash
sudo systemctl status vsftpd
```
Si no está activo, puedes iniciarlo y habilitarlo para que se inicie automáticamente al arrancar el sistema:
```bash
sudo systemctl start vsftpd
sudo systemctl enable vsftpd
```
# Paso 2: Configuración de los Usuarios
Crear usuarios en el servidor

Puedes crear usuarios para el acceso FTP mediante los siguientes comandos:
```bash
# Crear usuario1
sudo useradd -m usuario1
sudo passwd usuario1

# Crear usuario2
sudo useradd -m usuario2
sudo passwd usuario2
```
Configurar Jaula (chroot) para los usuarios

Para asegurar que los usuarios estén "enjaulados" en sus directorios de trabajo, edita el archivo de configuración de vsftpd:
```bash
sudo nano /etc/vsftpd.conf
```
Agrega las siguientes configuraciones para habilitar la jaula:
```bash
# Habilitar la jaula para todos los usuarios locales
chroot_local_user=YES

# Asegurarse de que los usuarios puedan escribir en su directorio (si es necesario)
allow_writeable_chroot=YES
```
Si deseas permitir acceso solo a usuarios específicos o excluir algunos, puedes usar user_list_file. Edita el archivo /etc/vsftpd.user_list y agrega los usuarios a los que no se les permitirá el acceso:
```bash
# Crear lista de usuarios no permitidos
sudo nano /etc/vsftpd.user_list
```
Agrega los usuarios a excluir (por ejemplo, usuario3 y usuario4):
```bash
usuario3
usuario4
```
Paso 3: Activar el Log de Actividad

Para habilitar el log de actividad de los usuarios en el servidor FTP, edita nuevamente el archivo de configuración vsftpd:
```bash
sudo nano /etc/vsftpd.conf
```
Agrega las siguientes configuraciones para activar los logs de las transferencias de archivos:
```bash
# Habilitar registro de actividad
xferlog_enable=YES
xferlog_file=/var/log/vsftpd.log
log_ftp_protocol=YES
```
Esto registrará todas las conexiones, transferencias y otros eventos en el archivo /var/log/vsftpd.log.

Para ver los registros, simplemente usa:
```bash
cat /var/log/vsftpd.log
```
O si prefieres un seguimiento en tiempo real:
```bash
tail -f /var/log/vsftpd.log
```
# Paso 4: Configuración de SSL/TLS para Conexiones Seguras
Habilitar SSL/TLS

Para cifrar las conexiones FTP, habilita SSL/TLS en el archivo de configuración vsftpd:
```bash
sudo nano /etc/vsftpd.conf
```
Descomenta o agrega las siguientes líneas:
```bash
# Habilitar SSL/TLS
ssl_enable=YES

# Usar un certificado SSL
rsa_cert_file=/etc/ssl/certs/vsftpd.pem
rsa_private_key_file=/etc/ssl/private/vsftpd.key

# Forzar el uso de SSL para los datos y logins
force_local_data_ssl=YES
force_local_logins_ssl=YES

# Configurar la versión de SSL/TLS (TLS 1.2 es recomendado)
ssl_tlsv1_2=YES

# Deshabilitar conexiones anónimas
anonymous_enable=NO
```
Crear un Certificado SSL Auto-firmado (si no tienes uno)

Si no tienes un certificado SSL válido, puedes generar uno auto-firmado con los siguientes comandos:
```bash
# Crear el directorio para los certificados si no existe
sudo mkdir -p /etc/ssl/private /etc/ssl/certs

# Crear un certificado SSL auto-firmado
sudo openssl req -new -x509 -days 365 -nodes -out /etc/ssl/certs/vsftpd.pem -keyout /etc/ssl/private/vsftpd.key
```
Durante la creación del certificado, te pedirá algunos datos como el nombre de la organización, etc. Puedes dejarlo en blanco o completar según tu preferencia.
Verificar Conexiones Seguras

Una vez que hayas configurado SSL/TLS, asegúrate de que el servidor esté escuchando en el puerto 21 para conexiones seguras. Puedes comprobarlo con el siguiente comando:
```bash
sudo netstat -tuln | grep :21
```
Además, asegúrate de que tu firewall permita conexiones en el puerto 21. Si estás usando ufw, habilita el puerto 21:
```bash
sudo ufw allow 21/tcp
```
# Paso 5: Reiniciar el Servicio de vsftpd

Una vez que hayas realizado todas las configuraciones, reinicia el servicio de vsftpd para aplicar los cambios:
```bash
sudo systemctl restart vsftpd
```
# Paso 6: Verificación

    Comprobar el acceso de los usuarios:
        Los usuarios locales (usuario1, usuario2, etc.) deberían poder acceder a sus directorios según la configuración de chroot.
        Los usuarios en el archivo /etc/vsftpd.user_list no deberían poder acceder.

    Comprobar los registros:
        Verifica que las conexiones y transferencias se estén registrando correctamente en /var/log/vsftpd.log.

    Comprobar la seguridad SSL:
        Asegúrate de que las conexiones FTP sean seguras utilizando un cliente FTP que soporte SSL/TLS (como FileZilla) y verifica que la conexión se establezca mediante SSL.