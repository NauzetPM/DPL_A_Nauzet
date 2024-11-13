# Instalación y configuración de servidor FTP con ProFTPD

## 1. Actualización del sistema y instalación de ProFTPD

```bash
sudo -i
apt-get update
apt-get install proftpd
```

Si aparece un entorno gráfico, elige "independiente" y presiona "Aceptar".

## 2. Verificación del servicio ProFTPD

```bash
service proftpd status
```

Debería mostrar "activo" y "funcionando".

## 3. Verificación de la versión de ProFTPD

```bash
proftpd -v
```

## 4. Comprobación de usuarios creados durante la instalación

```bash
cat /etc/passwd
```

Los dos últimos usuarios son los creados por la instalación.

## 5. Verificación de los archivos creados en la instalación

```bash
ls /etc/proftpd
```

El archivo más importante es `proftpd.conf`, que es el principal archivo de configuración.

## 6. Realizar copia de seguridad de `proftpd.conf`

```bash
cp /etc/proftpd/proftpd.conf /etc/proftpd/proftpd.conf.copia
```

## 7. Edición de la configuración de ProFTPD

```bash
nano /etc/proftpd/proftpd.conf
```

El archivo es muy largo, lleno de comentarios y líneas en blanco. Para limpiarlo:

### Usar `vi` para eliminar comentarios y líneas en blanco:

```bash
vi /etc/proftpd/proftpd.conf
```

- Eliminar comentarios: `:g/^\s*#/d`
- Eliminar líneas en blanco: `:g/^$/d`
- Guardar y salir: `:w:q`


Ahora el archivo está listo para trabajar. Salimos del editor.

## 8. Verificación de usuarios restringidos en el archivo `/etc/ftpusers`

```bash
ftp ip_del_servidor_FTP
```
- Nombre de usuario: `usuario_local_sistema`
- Contraseña: `password_usuario_local_sistema`

Comandos dentro de FTP:

```bash
ftp> ls # Listar directorios 
ftp> ? # Listar comandos disponibles 
ftp> pwd # Ver directorio actual 
ftp> quit # Salir
```

### Conexión desde FileZilla:

```bash
apt-get install filezilla
filezilla
```
En FileZilla:
- Servidor: `ip_servidor`
- Nombre de usuario: `nombre_usuario`
- Contraseña: `password_usuario`
- Puerto: 21

## 10. Modificación de la configuración por defecto en `proftpd.conf`

```bash
nano /etc/proftpd/proftpd.conf
```

Realiza las siguientes modificaciones:
ServerName "Mi servidor FTP" 
DeferWelcome off 
TimeoutIdle 1200 
Port 21 
MaxInstances 30 
ShowSymlinks 
User proftpd 
Group nogroup 
Umask 022 022 
TransferLog /var/log/proftpd/xferlog 
SystemLog /var/log/proftpd/proftpd.log

Guarda los cambios y sal de `nano`.

## 11. Ver los últimos accesos al servidor FTP

```bash
tail -n 15 /var/log/proftpd/proftpd.log
```


## 12. Verificar posibles problemas de conexión

```bash
tail -n 15 /var/log/proftpd/xfer.log
```

Estará vacío si no hay problemas de conexión.

## 13. Personalización de los mensajes de acceso

Modifica `proftpd.conf` para agregar los siguientes mensajes:

```bash
nano /etc/proftpd/proftpd.conf
```

Añadir las siguientes líneas:
AccessGrantMSG "Bienvenido al servidor FTP de (mi_nombre)" AccessDenyMSG "Error de entrada a mi servidor FTP"

Guarda y cierra el archivo.

### En la máquina cliente:

```bash
service proftpd reload
```

Prueba la conexión desde la máquina cliente:

- Con usuario correcto: Verás el mensaje de bienvenida.
- Con usuario incorrecto: Verás el mensaje de error.

## 14. Restringir al usuario a su directorio home (`DefaultRoot`)

```bash
nano /etc/proftpd/proftpd.conf
```

Añadir o modificar la línea:

DefaultRoot ~

Guarda y sal de `nano`.

### En la máquina cliente, refrescamos:

```bash
service proftpd reload
```

Ahora al conectarte desde el cliente, el usuario solo podrá acceder a su directorio home.

## 15. Cambiar el `Umask` para permisos de archivos y directorios

Para cambiar los permisos por defecto:

```bash
nano /etc/proftpd/proftpd.conf
```

Modifica la línea `Umask 022 022` de acuerdo a lo siguiente:

- Para archivos con permisos `rw-------` (644): Umask `0777`
- Para directorios con permisos `drwx------` (755): Umask `0777`

Guarda los cambios y sal de `nano`.

## 16. Crear usuarios virtuales

### 1. Editar proftpd.conf:

```bash
nano /etc/proftpd/proftpd.conf
```

Añadir las siguientes líneas al principio del archivo:

```bash
Include /etc/proftpd/modules.conf
RequireValidShell off
AuthUserFile /etc/proftpd/ftpd.passwd
```
### 2. Crear la carpeta home:

```bash
cd /var
mkdir ftp
mkdir /var/ftp/carpetauser1JSR
```
### 3. Crear un archivo vacío:
```bash
touch /etc/proftpd/ftpd.passwd
```

### 4. Crear el usuario user1JSR:
```bash
ftpasswd --passwd --name=user1JSR --uid=3000 --gid=3000 --home=/var/ftp/carpetauser1JSR --shell=/bin/false
```

### 5. Desbloquear al usuario:
```bash
ftpasswd --passwd --name=user1JSR --unlock
```
### 6. Crear un archivo de prueba en la carpeta:
```bash
cd /var/ftp/carpetauser1JSR
nano pn.txt
```
### 7. Conectar a través de FileZilla:
Servidor: ip_servidor(LOCAL:127.0.0.1)
Nombre de usuario: user1JSR
Contraseña: la que le pusiste