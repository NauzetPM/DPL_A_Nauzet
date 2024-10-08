## Menu
### php
Codigo para hacer el menu
Se usaran los metodos usados en el index.md (tarea anterior)
```php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['insert'])) {
        $nombre = $_POST['nombre'];
        $gmail = $_POST['gmail'];
        insertUser($nombre, $gmail);
    } elseif (isset($_POST['select'])) {
        selectUsers();
    } elseif (isset($_POST['update'])) {
        $id = intval($_POST['id']);
        $nuevoNombre = $_POST['nuevo_nombre'];
        $nuevoGmail = $_POST['nuevo_gmail'];
        updateUser($id, $nuevoNombre, $nuevoGmail);
    } elseif (isset($_POST['delete'])) {
        $id = intval($_POST['id']);
        deleteUser($id);
    }
}
```

### html
Codigo para hacer el menu
```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
</head>
<body>
    <h1>Gestión de Usuarios</h1>

    <h2>Insertar Usuario</h2>
    <form method="post">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="email" name="gmail" placeholder="Gmail" required>
        <button type="submit" name="insert">Insertar</button>
    </form>

    <h2>Mostrar Usuarios</h2>
    <form method="post">
        <button type="submit" name="select">Mostrar Usuarios</button>
    </form>

    <h2>Actualizar Usuario</h2>
    <form method="post">
        <input type="number" name="id" placeholder="ID del Usuario" required>
        <input type="text" name="nuevo_nombre" placeholder="Nuevo Nombre" required>
        <input type="email" name="nuevo_gmail" placeholder="Nuevo Gmail" required>
        <button type="submit" name="update">Actualizar</button>
    </form>

    <h2>Eliminar Usuario</h2>
    <form method="post">
        <input type="number" name="id" placeholder="ID del Usuario" required>
        <button type="submit" name="delete">Eliminar</button>
    </form>
</body>
</html>

```
