<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!--Importante poner en el action el ruta del archivo que va a procezar los datos -->
    <form action="Ejemplo.php" method="get">
         <!--Importante poner el id al input que sera lo que utilizaremos para recoger el dato-->
        Nombre: <input type="text" name="Usuario">
        <input type="submit" value="enviar Nombre">
    </form>
    <br>
    <!--Importante poner el enctype="multipart/form-data" para enviar archivos-->
    <form action="Ejemplo.php" method="post" enctype="multipart/form-data">
        Fichero: <input type="file" name="Fichero" id="Fichero">
        <br>
        Fichero2: <input type="file" name="Fichero2" id="Fichero2">
        <input type="submit" value="enviar Ficheros">
    </form>
</body>
</html>