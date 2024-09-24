## Redirecciones en paginas PHP
### Pasos
1. Crear un archivo php con estructura html y poner una referencia a un php con <a href="pagina2.php?name=alex">Redirección</a>
esto te redirige a una pagina php enviando por get en name el nombre alex

2. Crear un archivo pagina2.php para mostrar los datos que recives por get haces print_r($_GET) y para redirigir a otra pagina haces 
header("location: pagina3.php") y para mandar el parametro es 
header("location: pagina3.php?name= ".$_GET['name']);

3. Crear el archivo pagina3.php y mostrar los datos recividos con print_r($_GET)


