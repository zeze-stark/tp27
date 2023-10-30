<!DOCTYPE html>
<html>
<head>
    <title>Listado de Publicaciones</title>
</head>
<body>
    <h1>Listado de Publicaciones</h1>



    
    <?php
    include_once("../config/config.php"); // Incluye el archivo de configuración de la base de datos

    // Carga la clase Post
    include_once ("..//classes/Post.php");
    $post = new Post($db);

    // Obtén la lista de publicaciones
    $posts = $post->getPosts();

    if (empty($posts)) {
        echo "<p>No hay publicaciones disponibles.</p>";
    } else {
        echo "<ul>";
        foreach ($posts as $row) {
            echo "<li><a href='view_post.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></li>";
        }
        echo "</ul>";
    }
    ?>
</body>
</html>
