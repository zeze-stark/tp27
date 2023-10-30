<?php
session_start();

include 'config.php'; // Incluye el archivo de configuración de la base de datos
include 'classes/User.php'; // Incluye la clase User

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User($db);

    if ($user->login($username, $password)) {
        // Iniciar sesión y redirigir al usuario a la página de inicio, por ejemplo.
        $_SESSION['username'] = $username;
        header("Location: index.php");
    } else {
        echo "Nombre de usuario o contraseña incorrectos.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <form method="post">
        <input type="text" name="username" placeholder="Nombre de usuario" required><br>
        <input type="password" name="password" placeholder="Contraseña" required><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>
