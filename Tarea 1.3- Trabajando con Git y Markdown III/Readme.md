## Trabajando con Git y Markdown 3
### 1º
Creo un directorio de trabajo llamado /bloggalpon/ en el directorio del usuario.
Inicializar el repositorio vacío.


![](/Fotos/Tarea1_3/init.png)

Crear el archivo index.htm
Añadir la estructura básica de una web.
Crear un commit indicando que se crea el esqueleto básico del index.htm
Añadir el contenido al head, entre `<head>` y `</head>`.
Crear un commit indicando que se añade la cabecera del index.htm


![](/Fotos/Tarea1_3/commit1.png)

Añadir el contenido al body, entre `<body>` y `</body>`
Crear un commit indicando que se añade la estructura básica del body.
Añadir el contenido de section, entre `<section>` y `</section>`
Crear un commit indicando que se añade toda la estructura de la zona de posts.


![](/Fotos/Tarea1_3/section_body.png)

Crear un archivo style.css.
Añadir la siguiente información.
Crear un commit indicando que se añaden las CSS de html y de body.
Añadir la siguiente información.
Crear un commit indicando que se añaden las CSS de varios elementos HTML5: header, section, article, aside y footer.


![](/Fotos/Tarea1_3/css.png)

Crear un commit indicando que se añaden las CSS de section.
Añadir la siguiente información.
Crear un commit indicando que se añaden las CSS del footer.
Añadir la siguiente información.
Crear un commit indicando que se añaden las CSS del H1 y de los enlaces.


![](/Fotos/Tarea1_3/sectioncss.png)


![](/Fotos/Tarea1_3/footercss.png)


![](/Fotos/Tarea1_3/h1css.png)

Crear una rama “desarrollo”. En esta rama de desarrollo vamos a realizar varias tareas:
    Crear un directorio de images y mover allí el logotipo logo.png.
    Crear un commit indicando que se mueve el logotipo a la carpeta images.
    Crear un directorio de CSS y mover allí las CSS style.css.
    Crear un commit indicando que se mueve la CSS a la carpeta CSS.
    Cambiar las referencias a la CSS en el index.htm y al logotipo logo.png en la CSS.
    Crear un commit indicando que se cambian las referencias a las CSS y a las imágenes al reorganizarlas en directorios.

![](/Fotos/Tarea1_3/ramaDesarrollo.png)

Crear una rama “bugfix” a partir de la “master” para resolver una serie de fallos.
    Quitar los comentarios en las CSS de los dos punteados (empiezan por //border ).
    Crear un commit indicando que introducen los punteados en la barra derecha y en el footer.
    Introducir como título “Galpon”.
    Crear un commit indicando que se introduce el título en la página.
    Cambiar 2012 por 2014 en el footer. Quitar (c).
    Crear un commit indicando que se realizan pequeños ajustes en el footer.
    Crear una etiqueta de v1.1
    Llevar estos cambios a la rama “master”.
    Borrar la rama “bugfix”.
    Llevar los cambios de la rama “desarrollo” a la rama “master”. Resolver los conflictos, si existen.
    Crear una etiqueta de v1.2

![](/Fotos/Tarea1_3/ramabugfix.png)