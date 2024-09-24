<?php

//Ejemplo recoger datos GET

//Linea para que se vea mas bonito
echo"<pre>";
//recoge todo lo que envies por peticiones get
print_r($_GET);
echo"<br>";
//recoge los datos que enviaste que tenian id Usuario
print_r($_GET['Usuario']);


//Ejemplo recoger datos POST

//Linea para que se vea mas bonito
echo"<pre>";
//recoge todo lo que envies por peticiones post
print_r($_POST);
echo"<br>";

//recoge todos los ficheros que envies 
print_r($_FILES);
echo "<br>";
//recoge el nombre del fichero con id Fichero
print_r($_FILES['Fichero']['name']);