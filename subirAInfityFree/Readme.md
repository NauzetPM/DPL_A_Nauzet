# Guía para crear un sitio en InfinityFree

Este documento proporciona los pasos necesarios para crear un sitio web utilizando InfinityFree, subir archivos mediante FileZilla y configurar una base de datos de pruebas.

## Requisitos previos

- Tener una cuenta de correo electrónico válida.
- Tener instalado FileZilla en tu computadora.
- Tener un navegador web.

## Paso 1: Crear una cuenta en InfinityFree

1. Visita [InfinityFree](https://www.infinityfree.net/).
2. Haz clic en el botón "Sign Up" o "Register" para crear una nueva cuenta.
3. Completa el formulario de registro con tu dirección de correo electrónico y una contraseña.
4. Verifica tu correo electrónico (InfinityFree enviará un correo de confirmación).
5. Inicia sesión en tu cuenta de InfinityFree.

## Paso 2: Crear un nuevo sitio web

1. En el panel de control de InfinityFree, selecciona "Create Account" o "New Account".
2. Elige un nombre de dominio gratuito proporcionado por InfinityFree o usa tu propio dominio.
3. Completa el proceso de creación del sitio.
4. Anota la información de tu cuenta FTP (servidor, nombre de usuario y contraseña) que se mostrará en el panel de control.

## Paso 3: Configurar FileZilla

1. Abre FileZilla.
2. Ve a `Archivo` -> `Gestor de sitios` (o presiona `Ctrl + S`).
3. Haz clic en "Nuevo sitio" y dale un nombre descriptivo (por ejemplo, "InfinityFree").
4. Completa los campos:
   - **Host**: [ftp.tudominio.com](ftp.tudominio.com) (el servidor FTP proporcionado por InfinityFree).
   - **Puerto**: 21
   - **Protocolo**: FTP - Protocolo de transferencia de archivos
   - **Cifrado**: Usar FTP explícito sobre TLS si está disponible.
   - **Método de acceso**: Normal
   - **Usuario**: Tu nombre de usuario FTP
   - **Contraseña**: Tu contraseña FTP
5. Haz clic en "Conectar".

## Paso 4: Subir archivos al servidor

1. Una vez conectado a tu servidor FTP en FileZilla, verás dos paneles: el izquierdo muestra tus archivos locales y el derecho muestra los archivos en el servidor.
2. Navega hasta la carpeta local donde tienes los archivos de tu sitio web.
3. Arrastra y suelta los archivos desde el panel izquierdo al panel derecho (servidor) para subirlos.

## Paso 5: Crear una base de datos en InfinityFree

1. En el panel de control de InfinityFree, busca la sección "MySQL Databases".
2. Crea una nueva base de datos:
   - Dale un nombre a la base de datos.
   - Crea un usuario para la base de datos y asigna una contraseña.
3. Anota la información de la base de datos, que necesitarás más adelante (nombre de la base de datos, usuario, contraseña, servidor MySQL).

## Paso 6: Conectar tu aplicación a la base de datos

1. Abre tu archivo de configuración de conexión a la base de datos en tu proyecto.
2. Completa la información de conexión:
   - **Servidor**: `sqlXXX.epizy.com` (el servidor MySQL proporcionado).
   - **Usuario**: Tu usuario de la base de datos.
   - **Contraseña**: Tu contraseña de la base de datos.
   - **Nombre de la base de datos**: El nombre que elegiste para la base de datos.
3. Guarda los cambios.

## Paso 7: Probar tu sitio

1. Abre tu navegador web.
2. Escribe la dirección de tu dominio (por ejemplo, `http://tudominio.epizy.com`) para ver tu sitio en línea.
3. Asegúrate de que todo funcione correctamente, incluida la conexión a la base de datos.
