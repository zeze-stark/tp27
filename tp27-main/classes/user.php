<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($username, $password, $email) {
        // Hashear la contraseña antes de almacenarla en la base de datos.
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username, $hashedPassword, $email]);
    }

    public function login($username, $password) {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Iniciar la sesión del usuario.
            $_SESSION['user_id'] = $user['id'];
            return true;
        }

        return false;
    }

    public function isAuthenticated() {
        // Verificar si el usuario está autenticado.
        return isset($_SESSION['user_id']);
    }
}

?>
