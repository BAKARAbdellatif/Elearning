<?php
require_once 'config/Database.php';
require_once 'classes/User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$user = $user->getById(1);
var_dump($user);
$user->setNom("Alice");
$user->setPrenom("Smith");
$user->setEmail("alice@gmail.com");
$user->update();
