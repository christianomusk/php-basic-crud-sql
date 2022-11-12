<?php 
require 'functions.php';
if(isset($_POST["submit"])) {
    if(registrasi($_POST) > 0) {
        echo "<script>
            alert('Data berhasil ditambahkan');
            document.location.href='index.php';
            </script>";
    } else {
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        label {
            display: block;
        }
    </style>
    <title>Registrasi</title>
</head>
<body>
    <h1>Halaman Registrasi</h1>
    <form action="" method="post">
        <ul>
            <li><label for="username">Username :</label>
            <input type="text" name="username" id="username" required autocomplete="off" autofocus></li>

            <li><label for="password">Password :</label>
            <input type="password" name="password" id="password" required></li>

            <li><label for="password2">Re-Password :</label>
            <input type="password" name="password2" id="password2" required></li>

            <button type="submit" name="submit">Sign up</button>
        </ul>
        
    </form>
</body>
</html>