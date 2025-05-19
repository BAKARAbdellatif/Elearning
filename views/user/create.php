<?php
require_once 'config/Database.php';
require_once 'classes/User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db, null, "John", "Doe", "John@gmail.com", " ");
$user->create();
