<?php

function check_login($pdo){

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];

        $query = "select * from users where user_id = :user_id";

        $stmt = $pdo->prepare($query);

        $stmt->execute(['user_id' => $user_id]);

        if($stmt->rowCount() > 0){
            $user_info = $stmt->fetch();
            return $user_info;
        }
    }
    //redirect to login page
    header("Location: login.php");
    die();
}

function sanitize_data($data) {
    
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function generate_user_id($length){
    $text = "";
    if($length < 5){
        $length = 5;
    }
    $len = rand(4, $length);

    for($i=0; $i<$len; $i++){
        $text .= rand(0,9);
    }
    return $text;
}

function validate_user_inputs($request){

    $validationErr = [];

    if (isset($request['name'])){
        if ($request['name'] == "") {
            $validationErr[] = "Name field must not be empty.";
        }
    }

    //email address
    if ($request['email'] == "") {
        $validationErr[] = "Email field must not be empty.";
    } else if (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
        $validationErr[] = "{$request['email']} is not a valid email address";
    }
    //password
    if ($request['password'] == "") {
        $validationErr[] = "Password field must not be empty.";
    } else if (strlen($request['password']) < 8) {
        $validationErr[] = "Password must contain atleast 8 characters";
    }

    return $validationErr;

}


function redirect_to($location){
    header("Location: $location");
    exit();
}

function dd($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}