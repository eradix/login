<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'lebron');
define('DB_PASSWORD', '1234');
define('DB_NAME', 'login');


try {
    // DATA SOURCE NAME
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;

    // CREATE A PDO INSTANCE
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);

    //set attributes
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    exit("Connection failed: " . $e->getMessage());

}
