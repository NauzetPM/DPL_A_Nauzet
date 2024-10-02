## Insertar, leer, modificar y borrar registros de la base de datos
### Insertar
Ejemplo de codigo:
```
// Función para insertar un usuario
function insertUser($nombre) {
    $conn = dbConnect();
    $insert = "INSERT INTO users (nombre) VALUES (?)";
    $stmt = $conn->prepare($insert);
    $stmt->bind_param("s", $nombre);

    if ($stmt->execute()) {
        echo "Registro insertado correctamente.<br>";
    } else {
        echo "Error al insertar: " . $stmt->error . "<br>";
    }

    $stmt->close();
    $conn->close();
}
```

![](/Fotos/Insert.png)

![](/Fotos/Insert2.png)

### Leer

Ejemplo de codigo:
```
// Función para seleccionar y mostrar usuarios
function selectUsers() {
    $conn = dbConnect();
    $select = "SELECT * FROM users";
    $result = $conn->query($select);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row['id'] . " - Nombre: " . $row['nombre'] . "<br>";
        }
    } else {
        echo "No se encontraron registros.<br>";
    }

    $conn->close();
}
```

![](/Fotos/leer.png)


### Modificar

Ejemplo de codigo:
```
// Función para actualizar un usuario
function updateUser($id, $nuevoNombre) {
    $conn = dbConnect();
    $update = "UPDATE users SET nombre = ? WHERE id = ?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("si", $nuevoNombre, $id);

    if ($stmt->execute()) {
        echo "Registro actualizado correctamente.<br>";
    } else {
        echo "Error al actualizar: " . $stmt->error . "<br>";
    }

    $stmt->close();
    $conn->close();
}
```

![](/Fotos/Update.png)

![](/Fotos/Update2.png)

### Borrar

Ejemplo de codigo:
```
// Función para eliminar un usuario
function deleteUser($id) {
    $conn = dbConnect();
    $delete = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($delete);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Registro eliminado correctamente.<br>";
    } else {
        echo "Error al eliminar: " . $stmt->error . "<br>";
    }

    $stmt->close();
    $conn->close();
}
```

![](/Fotos/borrar.png)

![](/Fotos/borrar2.png)