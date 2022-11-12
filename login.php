<?php 
session_start();

if(isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

require 'functions.php';

if(isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = mysqli_query($conn,"SELECT * FROM registrasi WHERE username = '$username'");

    if(mysqli_num_rows($query) === 1) {
        $result = mysqli_fetch_assoc($query);
        if( password_verify($password, $result["password"]) ) {
            // set session
            $_SESSION["login"] = true;
            header("Location: index.php"); exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en-ID">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>
</body>
</html>