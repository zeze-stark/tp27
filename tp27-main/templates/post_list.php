<!DOCTYPE html>
<html>
<head>
    <title>Listado de Publicaciones</title>
    <link rel="stylesheet" type="text/css" href="/javaYcss/styles.css">
</head>
<body>
    <h1>Listado de Publicaciones</h1>
    <ul>
        <?php
        // $posts es un arreglo de publicaciones obtenido desde PHP
        foreach ($posts as $post) {
            echo '<li>';
            echo '<h2><a href="view_post.php?id=' . $post['id'] . '">' . $post['title'] . '</a></h2>';
            echo '<p>' . substr($post['content'], 0, 200) . '...</p>'; // Muestra un resumen de la publicación
            echo '</li>';
        }
        ?>
    </ul>
</body>
</html>