<?php
require_once '../../config/Database.php';
require_once '../../classes/Admin.php';

$database = new Database();
$db = $database->getConnection();
$admin = new Admin($db);
$admin = $admin->getById(1);
var_dump($admin);
die;
$user->setNom("Alice");
$user->setPrenom("Smith");
$user->setEmail("alice@gmail.com");
$user->update();
