<?php
include 'config.php'; // Incluye el archivo de configuración de la base de datos
include 'classes/User.php'; // Incluye la clase User

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Verifica si el nombre de usuario o el correo electrónico ya existen en la base de datos
    $user = new User($db);
    $existingUser = $user->getUserByUsernameOrEmail($username, $email);

    if ($existingUser) {
        echo "El nombre de usuario o el correo electrónico ya existen. Por favor, elige otro.";
    } else {
        // Registra al nuevo usuario
        $user->register($username, $password, $email);
        echo "¡Registro exitoso!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
</head>
<body>
    <h1>Registro de Usuario</h1>
    <form method="post">
        <input type="text" name="username" placeholder="Nombre de usuario" required><br>
        <input type="password" name="password" placeholder="Contraseña" required><br>
        <input type="email" name="email" placeholder="Correo electrónico" required><br>
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>
