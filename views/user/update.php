<html>
<head>
    <title>My E-learning Platform</title>
    <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <script src="../../assets/jquery/jquery-3.7.1.min.js"></script>
</head>
<script src="../../assets/jquery/user/validateForm.js">
</script>
<body>
<div class="container">
    <div class="card col-7 mx-auto">
<?php
require_once '../../config/Database.php';
require_once '../../classes/User.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);
    $id = (isset($_GET['id']) && trim($_GET['id']) != '') ? trim($_GET['id']) : null;
    if($id) {
        $user = $user->getById($id);
        $user->setNom("Alice");
        $user->setPrenom("Smith");
        $user->setEmail("alice@gmail.com");
        $user->update();

        ?>
        <h1>Login Form</h1>
        <div id="error" class="alert alert-danger" style="display: none;"></div>
        <form action="" method="POST" id="form">
            <div class="mb-2">
                <label>Nom</label>
                <input type="text" class="form-control form-control.sm" id="nom" name="nom" value="<?= $user->getNom() ?>">
            </div>
            <div class="mb-2">
                <label>Prénom</label>
                <input type="text" class="form-control form-control.sm" id="prenom" name="prenom" value="<?= $user->getPrenom() ?>">
            </div>
            <div class="mb-2">
                <label>Email</label>
                <input type="text" class="form-control form-control.sm" id="email" name="email" value="<?= $user->getEmail() ?>">
            </div>
            <div class="mb-2">
                <label>Mot de passe</label>
                <input type="password" class="form-control form-control.sm" id="password" name="password">
            </div>
            <div class="mb-2">
                <label>Confirmation du mot de passe</label>
                <input type="password" class="form-control form-control.sm" id="password_confirm" name="password_confirm">
            </div>
            <button class="btn btn-primary btn-sm" type="submit" id="validateBtn">Modifier</button>
            <button class="btn btn-secondary btn-sm mx-2" type="button" onclick="alert('hello')">Annuler</button>
        </form>
<?php
    } else {
        echo "User not found";
    }
}

if($_SERVER['REQUEST_URI']=="POST") {
    var_dump($user);
}
?>
    </div>
    <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js" ></script>
</html>
