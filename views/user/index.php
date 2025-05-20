<?php
require_once '../../config/Database.php';
require_once '../../classes/User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$users = $user->getAll();

?>
<html>
<head>
    <title>My E-learning Platform</title>
    <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body>
    <div class="container">
        <h1>liste des utilisateurs</h1>
        <table class="table table-striped-columns">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach ($users as $u): ?>
                    <tr>
                        <td><?php echo $u->getNom(); ?></td>
                        <td><?= $u->getPrenom(); ?></td>
                        <td><?= $u->getEmail(); ?></td>
                        <td>
                            <a href="./update.php?id=<?= $u->getId();?>" class="btn btn-success btn-sm">Modifier</a>
                            <button class="btn btn-danger btn-sm" id="btn-<?= $u->getId();?>">Supprimer</button>
                        </td>
                    </tr>
            <?php
                endforeach;
            ?>
            </tbody>
        </table>
    </div>
<script src="../../assets/bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</html>
