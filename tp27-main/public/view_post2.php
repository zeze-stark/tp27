<?php
include 'config.php'; // Incluye el archivo de configuración de la base de datos
include 'classes/Post.php'; // Incluye la clase Post
include 'classes/Comment.php'; // Incluye la clase Comment

// Comprueba si se proporciona un ID de publicación válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $post_id = $_GET['id'];

    // Obtén la publicación por su ID
    $post = new Post($db);
    $postDetails = $post->getPostById($post_id);

    // Verifica si la publicación existe
    if ($postDetails) {
        $comment = new Comment($db);
        $comments = $comment->getCommentsForPost($post_id);

    } else {
        echo "La publicación no existe.";
        exit;
    }
} else {
    echo "ID de publicación no válido.";
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Detalles de la Publicación</title>
</head>
<body>
    <h1><?php echo $postDetails['title']; ?></h1>
    <p><?php echo $postDetails['content']; ?></p>

    <h2>Comentarios</h2>
    <ul>
        <?php if (empty($comments)) : ?>
            <li>No hay comentarios aún.</li>
        <?php else: ?>
            <?php foreach ($comments as $comment) : ?>
                <li><?php echo $comment['content']; ?></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</body>
</html>
