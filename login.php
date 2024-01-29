<?php
    session_start();
    include 'connection.php';
    include 'functions.php';


    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $request_data = [
            'email' => sanitize_data($_POST['email']),
            'password' => sanitize_data($_POST['password']),

        ];
        $validationErrors = validate_user_inputs($request_data);

        if(count($validationErrors) == 0){
            
            $query = "SELECT * FROM users where email = :email";

            $stmt = $pdo->prepare($query);

            $stmt->execute(['email' => $request_data['email']]);

            $user = $stmt->fetch();

            if($user){
                if (password_verify($request_data['password'], $user['password'])) {
                    $_SESSION['user_id'] = $user['user_id'];
                    redirect_to('index.php');
                }         
            }

            $validationErrors[] = "Invalid user credentials.";


        }

    }

?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="col-lg-6">
            <h1>LOGIN FORM</h1>

            <?php

                if(isset($validationErrors) && count($validationErrors) != 0){
                        echo '<div class="alert alert-danger" role="alert">';
                    
                        foreach($validationErrors as $error){
                            echo "<p>$error</p>";
                        }
                        echo '</div>';
                }
            ?>
            <form method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <p>Not yet registered? Register <a href="register.php">here.</a></p>
            </form>
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>