## PHPMYADMIN
### Creación de base de datos
Teniendo phpmyadmin abierto y estando logeado con una cuenta con permisos de creación en el menu en una columna a la izquierda arriba de la lista de bases de datos te sale Nueva al darle click te saldra un formulario para crear una base de datos si no vas a tocar alguna configuracion con poner el nombre y darle a crear sirve

![](/Fotos/baseDatos1.png)

![](/Fotos/baseDatos2.png)

### Creación de una tabla con sus campos
Si acabas de terminar la creacion de una base de datos te abrira un form para crear una tabla nueva ya que te saldra un warning de que no existen tablas y te saldra poner nombre y nº de columnas pero si no quieres crearla desde ahi despues te saldra otro form para poner el nombre de las columnas y el tipo para tantas columnas como pusieras en el form anterior y algunas opciones como longitud si epuede ser null clave primaria ,etc... Con esto darle a crear y ya tendrias la primera tabla creada

![](/Fotos/baseDatos3.png)

![](/Fotos/baseDatos4.png)

![](/Fotos/baseDatos5.png)


### Conexión de una base de datos
aqui un ejeplo de conexión a base de datos desde php
```
<?php
$conn = mysql_connect('localhost','dev','mysql','PRUEBAS')

echo "<pre>";
print_r($conn);

$insert  = "insert into users (name, email) values ('alex','alex@domingo.es')";

$return = mysql_query ($conn, $insert );

print_r(($return));

mysql_close($conn);

```