<?php
session_start();
include 'connection.php';
include 'functions.php';

$user = check_login($pdo);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
</head>
<body>

<a href="logout.php">Logout</a>

<h1><?= "Hello its my world!" ?></h1>
<p><?= "Hello there, {$user['name']}!" ?></p>
</body>
</html>