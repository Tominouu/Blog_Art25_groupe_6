<?php
include '../../../header.php';


// Vérifie si l'utilisateur est connecté, sinon redirige vers la page de login
if (!isset($_SESSION['pseudoMemb'])) {
    header("Location: " . ROOT_URL . "/views/backend/security/login.php");
    exit();
}

// Récupérer les tables
$articles = sql_select("article", "*");
$thematiques = sql_select('thematique', '*');
$allMotsCles = sql_select(
    "MOTCLEARTICLE MA INNER JOIN MOTCLE MC ON MA.numMotCle = MC.numMotCle",
    "MA.numArt, MC.libMotCle",
    "1"
);
?>


<link rel="stylesheet" href="/../../src/css/style.css">
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Articles</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Chapô</th>
                            <th>Accroche</th>
                            <th>Paragraphe1</th>
                            <th>Sous-titre 1</th>
                            <th>Paragraphe 2</th>
                            <th>Sous-titre 2</th>
                            <th>Paragraphe 3</th>
                            <th>Conclusion</th>
                            <th>Thématique</th>
                            <th> Mots clés </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- boucle foreach pour afficher les articles -->
                        <?php foreach($articles as $article){ ?>
                            <tr>
                                <td><?php echo(strlen($article['libTitrArt']) > 100 ? substr($article['libTitrArt'], 0, 100) . '[...]' : $article['libTitrArt']); ?></td>
                                <td><?php echo(strlen($article['libChapoArt']) > 100 ? substr($article['libChapoArt'], 0, 100) . '[...]' : $article['libChapoArt']); ?></td>
                                <td><?php echo(strlen($article['libAccrochArt']) > 100 ? substr($article['libAccrochArt'], 0, 100) . '[...]' : $article['libAccrochArt']); ?></td>
                                <td><?php echo(strlen($article['parag1Art']) > 100 ? substr($article['parag1Art'], 0, 100) . '[...]' : $article['parag1Art']); ?></td>
                                <td><?php echo(strlen($article['libSsTitr1Art']) > 100 ? substr($article['libSsTitr1Art'], 0, 100) . '[...]' : $article['libSsTitr1Art']); ?></td>
                                <td><?php echo(strlen($article['parag2Art']) > 100 ? substr($article['parag2Art'], 0, 100) . '[...]' : $article['parag2Art']); ?></td>
                                <td><?php echo(strlen($article['libSsTitr2Art']) > 100 ? substr($article['libSsTitr2Art'], 0, 100) . '[...]' : $article['libSsTitr2Art']); ?></td>
                                <td><?php echo(strlen($article['parag3Art']) > 100 ? substr($article['parag3Art'], 0, 100) . '[...]' : $article['parag3Art']); ?></td>
                                <td><?php echo(strlen($article['libConclArt']) > 100 ? substr($article['libConclArt'], 0, 100) . '[...]' : $article['libConclArt']); ?></td>
                                <td><?php echo $thematiques[array_search($article['numThem'], array_column($thematiques, 'numThem'))]['libThem']; ?></td>
                                <td>
                                    <?php 
                                    $motsClesArticle = array_filter($allMotsCles, function($mot) use ($article) {
                                        return $mot['numArt'] == $article['numArt'];
                                    });
                                    if (!empty($motsClesArticle)) {
                                        foreach ($motsClesArticle as $mot) {
                                            echo '<span class="badge bg-info text-dark mx-1">' . htmlspecialchars($mot['libMotCle']) . '</span>';
                                        }
                                    } else {
                                        echo '<span class="text-muted">Aucun</span>';
                                    }
                                    ?>
                                </td>
                                <!-- boutons redirection -->
                                <td>
                                    <a href="edit.php?numArt=<?php echo($article['numArt']); ?>" class="btn btn-primary">Edit</a>
                                    <a href="delete.php?numArt=<?php echo($article['numArt']); ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <a href="create.php" class="btn btn-success">Create</a>
            </div>
        </div>
    </div>
</body>

<?php
include '../../../footer.php';
