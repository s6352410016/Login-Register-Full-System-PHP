<?php

    session_start();
    include("server.php");  
    $errors = array();

    if(isset($_POST['login_user'])){
        $username = mysqli_real_escape_string($conn , $_POST['username']);
        $password = mysqli_real_escape_string($conn , $_POST['password']);

        if(empty($_POST['username'])){
            array_push($errors , "Username is required");
            $_SESSION['error'] = "Username is required";
        }else if(empty($_POST['password'])){
            array_push($errors , "Password is required");
            $_SESSION['error'] = "Password is required";
        }

        if(count($errors) == 0){
            $password = md5($_POST['password']);
            $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($conn , $query);

            if(mysqli_num_rows($result) == 1){
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header("location: index.php");
            }else{
                array_push($errors , "Username or password invalid");
                $_SESSION['error'] = "Username or password invalid";
                header("location: login.php");
            }
        }
    }

?>