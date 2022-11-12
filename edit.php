<?php 
// values declaration
require 'functions.php';
$id = $_GET["id"];
$data = tampil("SELECT * FROM mahasiswa WHERE id='$id'")[0];

// trigger
include 'trigger.php';
t_edit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>
<body>
    <h1>Tambah Data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
            <input type="hidden" name="gambarLama" value="<?= $data['gambar'] ?>">
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" value="<?= $data['nama'] ?>">
            </li>
            <li>
                <label for="nim">Nim : </label>
                <input type="text" name="nim" id="nim" value="<?= $data['nim'] ?>">
            </li>
            <li>
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" value="<?= $data['email'] ?>">
            </li>
            <li>
                <label for="gambar">Gambar :</label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <button type="submit" name="kirim" style="width: 60px">Kirim</button>
        </ul>
    </form>
</body>
</html>