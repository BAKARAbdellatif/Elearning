<?php
require_once '../../config/Database.php';
require_once '../../classes/Admin.php';

$database = new Database();
$db = $database->getConnection();
$admin = new Admin($db, null, "BAKAR", "Abdellatif", "bakar.abdellatif@gmail.com", "123123");
$admin->createAdmin();
var_dump($admin);
