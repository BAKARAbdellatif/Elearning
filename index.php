<?php
require_once 'config/Database.php';
require_once 'classes/User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$resultats = $user->getAll();
var_dump($resultats);
