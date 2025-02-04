<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

if (isset($_POST['numArt'])) {
    $numArt = ctrlSaisies($_POST['numArt']);
    $article = sql_select('ARTICLE', 'urlPhotArt', "numArt = $numArt");

    if (!empty($article) && isset($article[0]['urlPhotArt'])) {
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/' . $article[0]['urlPhotArt'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    sql_delete('ARTICLE', "numArt = $numArt");
    header('Location: ../../views/backend/articles/list.php?delete=success');
    exit();
} else {
    header('Location: ../../views/backend/articles/list.php?delete=error');
    exit();
}
?>
