<?php
include '../../../header.php'; // contains the header and call to config.php

// Vérifie si l'utilisateur est connecté, sinon redirige vers la page de login
if (!isset($_SESSION['pseudoMemb'])) {
    header("Location: " . ROOT_URL . "/views/backend/security/login.php");
    exit();
}
//Load all statuts
$membres = sql_select("membre", "*");
?>

<!-- Bootstrap default layout to display all statuts in foreach -->
<link rel="stylesheet" href="/../../src/css/style.css">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Membres</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Pseudo</th>
                        <th>Mot de Passe</th>
                        <th>Email</th>
                        <th>Statut</th>
                        <th>Date de Création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($membres as $membre){ ?>
                        <tr>
                            <td><?php echo $membre['numMemb']; ?></td>
                            <td><?php echo $membre['nomMemb']; ?></td>
                            <td><?php echo $membre['prenomMemb']; ?></td>
                            <td><?php echo $membre['pseudoMemb']; ?></td>
                            <td><?php echo $membre['passMemb']; ?></td>
                            <td><?php echo $membre['eMailMemb']; ?></td>
                            <td><?php echo $membre['numStat']; ?></td>
                            <td><?php echo $membre['dtCreaMemb']; ?></td>
                            <td>
                                <a href="edit.php?numMemb=<?php echo $membre['numMemb']; ?>" class="btn btn-primary">Edit</a>
                                <a href="delete.php?numMemb=<?php echo $membre['numMemb']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="create.php" class="btn btn-success">Create</a>
        </div>
    </div>
</div>
<?php
include '../../../footer.php'; // contains the footer
