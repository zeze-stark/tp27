
<!DOCTYPE html>
<html>
<head>
    <title>Detalles de la Publicación</title>
</head>
<body>
    <?php
    include 'config.php'; // Incluye el archivo de configuración de la base de datos

    // Carga la clase Post y Comment
    include 'classes/Post.php';
    include 'classes/Comment.php';

    // Comprueba si se proporciona un ID de publicación válido en la URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $post_id = $_GET['id'];

        // Obtén la publicación por su ID
        $post = new Post($db);
        $postDetails = $post->getPostById($post_id);

        // Verifica si la publicación existe
        if ($postDetails) {
            echo "<h1>" . $postDetails['title'] . "</h1>";
            echo "<p>" . $postDetails['content'] . "</p>";

            // Muestra los comentarios para esta publicación
            $comment = new Comment($db);
            $comments = $comment->getCommentsForPost($post_id);

            echo "<h2>Comentarios</h2>";
            if (empty($comments)) {
                echo "<p>No hay comentarios aún.</p>";
            } else {
                echo "<ul>";
                foreach ($comments as $comment) {
                    echo "<li>" . $comment['content'] . "</li>";
                }
                echo "</ul>";
            }
        } else {
            echo "<p>La publicación no existe.</p>";
        }
    } else {
        echo "<p>ID de publicación no válido.</p>";
    }
    ?>
</body>
</html>
