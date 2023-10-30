
<!DOCTYPE html>
<html>
<head>
    <title>Detalles de la Publicación</title>
    <link rel="stylesheet" type="text/css" href="../javaYcss/styles.css">
</head>
<body>
    <h1>Detalles de la Publicación</h1>
    <?php
    // $postDetails es un arreglo con los detalles de la publicación obtenidos desde PHP
    if ($postDetails) {
        echo '<h2>' . $postDetails['title'] . '</h2>';
        echo '<p>' . $postDetails['content'] . '</p>';
    } else {
        echo '<p>La publicación no existe.</p>';
    }
    ?>
    
    <h2>Comentarios</h2>
    <ul>
        <?php
        // $comments es un arreglo de comentarios obtenido desde PHP
        if (empty($comments)) {
            echo '<li>No hay comentarios aún.</li>';
        } else {
            foreach ($comments as $comment) {
                echo '<li>' . $comment['content'] . '</li>';
            }
        }
        ?>
    </ul>
</body>
</html>
