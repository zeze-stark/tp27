<?php
class User
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function register($username, $password, $email)
    {
        // Hashear la contraseña antes de almacenarla en la base de datos.
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashedPassword', '$email')";
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute()) {
            return array("message" => "Registrado correctamente");
        } else {
            return array("message" => "Error al registrarte");
        }
    }

    public function login($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user[0]['password'])) {
            // Iniciar la sesión del usuario.
            $arrResponse['id'] = $user[0]['id'];
            $arrResponse['username'] = $user[0]['username'];
            $arrResponse['email'] = $user[0]['email'];

            return array("message" => "Inicio de sesion con exito", "user" => $arrResponse);
        } else {
            return array("message" => "Error");
        }
    }

    public function isAuthenticated()
    {
        // Verificar si el usuario está autenticado.
        return isset($_SESSION['user_id']);
    }
}
