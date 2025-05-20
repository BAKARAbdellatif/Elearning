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
        <h1>Login Form</h1>
        <div id="error" class="alert alert-danger"></div>
        <form action="" method="POST" id="form">
            <div class="mb-é">
                <label>Nom</label>
                <input type="text" class="form-control form-control.sm" id="nom" name="nom">
            </div>
            <div class="mb-é">
                <label>Prénom</label>
                <input type="text" class="form-control form-control.sm" id="prenom" name="prenom">
            </div>
            <div class="mb-é">
                <label>Email</label>
                <input type="text" class="form-control form-control.sm" id="email" name="email">
            </div>
            <div class="mb-é">
                <label>Mot de passe</label>
                <input type="password" class="form-control form-control.sm" id="password" name="password">
            </div>
            <div class="mb-é">
                <label>Confirmation du mot de passe</label>
                <input type="password" class="form-control form-control.sm" id="password_confirm" name="password_confirm">
            </div>
            <button class="btn btn-primary btn-sm" type="submit" id="validateBtn">S'inscrire</button>
            <button class="btn btn-secondary btn-sm mx-2" type="button" onclick="alert('hello')">Annuler</button>
        </form>
    </div>
</div>
<script src="../../assets/bootstrap/js/bootstrap.bundle.min.js" ></script>
</html>

<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    require_once '../../config/Database.php';
    require_once '../../classes/User.php';

    $database = new Database();
    $db = $database->getConnection();
    $nom = (isset($_POST['nom']) && trim($_POST['nom'])!='') ? trim($_POST['nom']) : null;
    $prenom = (isset($_POST['prenom']) && trim($_POST['prenom'])!='') ? trim($_POST['prenom']) : null;
    $email = (isset($_POST['email']) && trim($_POST['email'])!='') ? trim($_POST['email']) : null;
    $password = (isset($_POST['password']) && trim($_POST['password'])!='') ? trim($_POST['password']) : null;
    $password_confirm = (isset($_POST['password_confirm'])  && trim($_POST['password_confirm'])!='') ? trim($_POST['password_confirm']) : null;

    if($password === $password_confirm && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $user = new User($db, null, $nom, $prenom, $email, $password);
        $user->create();
        header('Location: /elearning/index.php');
    }


}
