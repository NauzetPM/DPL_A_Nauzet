# Respuestas a las Preguntas

## 1. La arquitectura Web es un modelo compuesto de tres capas, ¿cuáles son y cuál es la función de cada una de ellas?

La arquitectura web suele estar compuesta por tres capas principales:

- **Capa de presentación (Frontend)**:
  - Función: Esta capa es la que interactúa directamente con el usuario. Es donde se encuentran las interfaces visuales, como las páginas web que se ven en el navegador. Se encarga de mostrar la información de manera interactiva y amigable, tomando datos de la capa de lógica de negocio o backend.

- **Capa de lógica de negocio (Backend)**:
  - Función: Esta capa maneja la lógica de procesamiento y la interacción con la base de datos. Es la encargada de recibir las solicitudes del usuario, procesarlas, realizar las operaciones necesarias y devolver los resultados al frontend.

- **Capa de datos (Base de datos)**:
  - Función: Esta capa se encarga de almacenar, organizar y gestionar los datos que la aplicación web utiliza. Se comunica con la capa de lógica de negocio para proporcionar los datos necesarios o recibir los datos a ser almacenados o modificados.

---

## 2. Una plataforma web es el entorno de desarrollo de software empleado para diseñar y ejecutar un sitio web; destacan dos plataformas web, LAMP y WISA. Explica en qué consiste cada una de ellas.

- **LAMP**:
  - LAMP es un acrónimo que hace referencia a un conjunto de tecnologías de código abierto utilizadas para desarrollar aplicaciones web dinámicas. Su composición es:
    - **L**: **Linux** como sistema operativo.
    - **A**: **Apache** como servidor web.
    - **M**: **MySQL** como sistema de gestión de bases de datos.
    - **P**: **PHP/Python/Perl** como lenguajes de programación para desarrollo de aplicaciones web.

- **WISA**:
  - WISA es similar a LAMP, pero basado en tecnologías de Microsoft. El acrónimo hace referencia a:
    - **W**: **Windows Server** como sistema operativo.
    - **I**: **IIS (Internet Information Services)** como servidor web.
    - **S**: **SQL Server** como sistema de gestión de bases de datos.
    - **A**: **ASP.NET** como framework de desarrollo para aplicaciones web.

---

## 3. Instalar y configurar el servidor web Apache en Ubuntu 10.04 LTS

### 3.1 Instalar el servidor web Apache desde terminal

1. **Actualizar los repositorios**:
```bash
   sudo apt-get update
```
# Instrucciones para instalar y configurar Apache y Tomcat en Ubuntu

## 1. Instalar Apache

Para instalar Apache en Ubuntu, utiliza el siguiente comando:

```bash
sudo apt-get install apache2
```
### Verificar la instalación

Apache debería comenzar a ejecutarse automáticamente. Para verificar que Apache está instalado correctamente, puedes comprobar el estado del servicio:
```bash
sudo service apache2 status
```
## 2. Comprobar que Apache está funcionando
### 2.1 Comprobar el estado del servicio

Para comprobar que el servicio de Apache está activo, utiliza el siguiente comando:

```bash
sudo service apache2 status
```

### 2.2 Verificar que el puerto 80 está en uso (puerto por defecto de Apache)

Para verificar que Apache está escuchando en el puerto 80, usa el siguiente comando:

```bash
sudo netstat -tuln | grep :80
```

## 3. Comprobar que Apache está funcionando desde el navegador

    Abre un navegador web y escribe la dirección IP del servidor o localhost:

```bash
http://localhost
```
Deberías ver la página predeterminada de Apache, lo que indica que el servidor está funcionando correctamente.

# 4. Cambiar el puerto por el cual está escuchando Apache
## 4.1 Editar el archivo de configuración de Apache

Edita el archivo ports.conf para cambiar el puerto en el que Apache escucha:

```bash
sudo nano /etc/apache2/ports.conf
```
Cambia la línea Listen 80 a Listen 82:

```
Listen 82
```

## 4.2 Editar el archivo de configuración del sitio

Edita el archivo de configuración del sitio para cambiar el puerto en el que Apache está escuchando:

```bash
sudo nano /etc/apache2/sites-available/000-default.conf
```
Modifica la línea VirtualHost *:80 a VirtualHost *:82:

```xml
<VirtualHost *:82>
```

## 4.3 Reiniciar Apache para aplicar los cambios

Para aplicar los cambios realizados, reinicia Apache:

```bash
sudo service apache2 restart
```
## 4.4 Verificar que Apache está escuchando en el puerto 82

Verifica que Apache está escuchando en el puerto 82:

```bash
sudo netstat -tuln | grep :82
```
## 4.5 Comprobar el cambio en el navegador

Abre el navegador y accede a la dirección:

```bash
http://localhost:82
```
# 5. Instalar el servidor de aplicaciones Tomcat
## 5.1 Instalar Tomcat

Para instalar Tomcat, utiliza el siguiente comando:

```bash
sudo apt-get install tomcat6
```
## 5.2 Verificar que Tomcat está funcionando

Tomcat debería iniciarse automáticamente después de la instalación. Verifica que está en funcionamiento:

```bash
sudo service tomcat6 status
```
## 5.3 Acceder a Tomcat desde el navegador

Para acceder a la interfaz de Tomcat desde el navegador, abre un navegador y escribe la siguiente URL:

```bash
http://localhost:8080
```
Deberías ver la página de inicio de Tomcat si está funcionando correctamente.
