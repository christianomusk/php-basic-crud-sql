<?php 
session_start();

if(!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';
$datas = tampil("SELECT * FROM mahasiswa");

// buat searching
if(isset($_POST["cari"])) {
    $datas = cari($_POST["k_cari"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Data</title>
</head>
<body>
    <h1>Tabel Data Mahasiswa</h1>
    <a href="logout.php">Logout</a>
    <form action="" method="post">
        <input type="text" name="k_cari" size="60px" autofocus autocomplete="off">
        <button type="submit" name="cari">Cari</button>
    </form>
    <a href="tambah.php">Tambah Data</a>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Aksi</th>
            <th>Nama</th>
            <th>Nim</th>
            <th>Email</th>
            <th>Gambar</th>
        </tr>
        <?php $i=1; ?>
        <?php foreach($datas as $data): ?>
            <tr>
                <td><?= $i ?></td>
                <td><a href="edit.php?id=<?= $data['id'] ?>">Edit</a> || <a href="hapus.php?id=<?= $data['id'] ?>" onclick="return confirm('Apakah anda ingin menghapus data ini?')">Hapus</a></td>
                <td><?= $data["nama"] ?></td>
                <td><?= $data["nim"] ?></td>
                <td><?= $data["email"] ?></td>
                <td><img style="width: 100px; height: 100px;" src="bg/<?= $data["gambar"] ?>"></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>