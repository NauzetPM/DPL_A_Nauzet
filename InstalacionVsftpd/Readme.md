# Instalación y configuración de un servidor FTP con vsftpd en Ubuntu

Este documento describe los pasos necesarios para instalar y configurar un servidor FTP utilizando **vsftpd** en un sistema Ubuntu.

## Paso 1: Actualizar el sistema

Antes de instalar cualquier software, es importante asegurarse de que el sistema esté actualizado. Abre una terminal y ejecuta los siguientes comandos:

```bash
sudo apt update
sudo apt upgrade
```
# Paso 2: Instalar vsftpd

## Instala el paquete vsftpd utilizando el siguiente comando:

```bash
sudo apt install vsftpd
```
Este comando instalará el servidor FTP en tu sistema.
# Paso 3: Verificar el estado del servicio

Una vez que la instalación haya finalizado, verifica que el servicio vsftpd se esté ejecutando correctamente:
```bash
sudo systemctl status vsftpd
```
Deberías ver algo como esto si el servicio está en funcionamiento:

● vsftpd.service - vsftpd FTP server
   Loaded: loaded (/lib/systemd/system/vsftpd.service; enabled; vendor preset: enabled)
   Active: active (running) since ...
   ...

Si el servicio no está activo, puedes iniciarlo con el siguiente comando:
```bash
sudo systemctl start vsftpd
```
Y para habilitarlo para que se inicie automáticamente en el arranque:
```bash
sudo systemctl enable vsftpd
```
# Paso 4: Configuración básica de vsftpd

El archivo de configuración principal de vsftpd es /etc/vsftpd.conf.

Para editar este archivo, abre una terminal y ejecuta:
```bash
sudo nano /etc/vsftpd.conf
```