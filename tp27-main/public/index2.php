<?php
include 'config.php'; // Incluye el archivo de configuración de la base de datos
include 'classes/Post.php'; // Incluye la clase Post

// Obtén la lista de publicaciones
$post = new Post($db);
$posts = $post->getPosts();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Listado de Publicaciones</title>
</head>
<body>
    <h1>Listado de Publicaciones</h1>
    
    <ul>
        <?php foreach ($posts as $row) : ?>
            <li><a href="view_post.php?id=
            <?php echo $row['id']; ?>">
            <?php echo $row['title']; ?>   </a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>