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
        echo "Connection failed: " . $e->getMessage();
    }


    // PDO QUERY
    // $stmt = $pdo->query("SELECT * FROM users");

    //fetching rows -> assoc
    // while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    //     echo $row['id'] . "</br>";
    //     echo $row['name'] . "</br>";
    //     echo $row['email'] . "</br>";
    //     echo $row['user_id'] . "</br>";
    // }

    //obj
    // while($row = $stmt->fetch(PDO::FETCH_OBJ)){
    //     echo $row->created_at;
    // }


    // while($row = $stmt->fetch()){
    //     echo $row['id'];
    // }


    //prepared statements
    //POSITIONAL PARAMETERS
    // $name = "admin";
    // $query = "SELECT * FROM users where name = ?";
    // $stmt = $pdo->prepare($query);
    // $stmt->execute([$name]);
    // $users = $stmt->fetchAll();


    //named parameters
    // $name = "lebron";
    // $query = "SELECT * FROM users where name = :name";
    // $stmt = $pdo->prepare($query);
    // $stmt->execute(['name' => $name]);
    // $users = $stmt->fetchAll();

    // echo "<pre>";
    // print_r($users);


    //insert
    // $sql = "INSERT INTO  users (name, email, password, user_id) ";
    // $sql .= "VALUES (:name, :email, :password, :user_id)";
    
    // $stmt = $pdo->prepare($sql);

    // $stmt->execute([
    //     'name' => 'tank', 
    //     'email'=> 'tank@email.com',
    //     'password' => 'tankdavis',
    //     'user_id' => '312312434242'
    // ]);

    // echo $stmt->rowCount();

    //update
    // $name = "tank davis";
    // $id = 3;
    // $sql = "UPDATE users SET name = :name ";
    // $sql .= "WHERE id = :id";

    // $stmt = $pdo->prepare($sql);

    // $stmt->execute([
    //     'name' => $name,
    //     'id' => $id
    // ]);

    // echo $stmt->rowCount();


    //delete

    // $sql = "DELETE from users where id = :id";
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute(['id' => 3]);
    // echo $stmt->rowCount();

    //search
    $name = "%ad%";
    $sql = "select * from users where name like :name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name]);
    $users = $stmt->fetchAll();
    echo "<pre>";
    print_r($users);












