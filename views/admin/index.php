<?php
require_once '../../config/Database.php';
require_once '../../classes/Admin.php';

$database = new Database();
$db = $database->getConnection();
$admin = new Admin($db);
$resultats = $admin->getAll();
var_dump($resultats);
