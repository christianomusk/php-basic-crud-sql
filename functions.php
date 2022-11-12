<?php 
// connect to database
$conn = mysqli_connect("localhost","root","","phpLanjutan");
function tampil($query) {
    global $conn;
    $obj = mysqli_query($conn,$query);
    $rows = [];
    while($result = mysqli_fetch_assoc($obj)) {
        $rows[] = $result;
    }
    return $rows;
}

// upload gambar
function upload() {
    $name = $_FILES["gambar"]["name"];
    $size = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmp_name = $_FILES["gambar"]["tmp_name"];

    // cek gambar sudah diupload atau belum
    if( $error === 4 ) {
        echo "<script>
                alert('Silahkan pilih gambar terlebih dahulu!');
                </script>";
        return false;
    }

    // cek validasi ekstensi gambar
    $ekstensiValid = ['jpg','jpeg','png'];
    $namaEkstensi = explode('.',$name);
    $namaEkstensi = strtolower(end($namaEkstensi));
    if(!in_array($namaEkstensi,$ekstensiValid)) {
        echo "<script>
                alert('Mohon upload gambar!');
                </script>";
        return false;
    }

    // cek ukuran gambar yang diupload
    if($size > 1000000) {
        echo "<script>
                alert('Gambar harus dibawah 1mb!');
                </script>";
        return false;
    }

    // generate nama file random
    $newName = uniqid();
    $newName .= ".";
    $newName .= $namaEkstensi;

    // upload file ready dan return nama gambar ke database
    move_uploaded_file($tmp_name,"bg/".$newName);

    return $newName;
}

function tambah($data) {
    global $conn;
    $nama = htmlspecialchars($data['nama']);
    $nim = htmlspecialchars($data['nim']);
    $email = htmlspecialchars($data['email']);

    $gambar = upload();
    if(!$gambar) {
        return false;
    }

    // insert
    $query = "INSERT INTO mahasiswa VALUES ('','$nama','$nim','$email','$gambar')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);

    

}

function hapus($id) {
    global $conn;
    $hapus = "DELETE FROM mahasiswa WHERE id=$id";
    mysqli_query($conn,$hapus);

    return mysqli_affected_rows($conn);
}

function cari($data) {
    $query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$data%' OR nim LIKE   '%$data%' OR email LIKE '%$data%'";

    return tampil($query);
}

function edit($data) {
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data['nama']);
    $nim = htmlspecialchars($data['nim']);
    $email = htmlspecialchars($data['email']);
    $gambarLama = htmlspecialchars($data['gambarLama']);

    if($_FILES["gambar"]["error"] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE mahasiswa SET 
                nama = '$nama',
                nim = '$nim',
                email = '$email',
                gambar = '$gambar'
                WHERE id=$id";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function registrasi($data) {
    global $conn;

    $username = htmlspecialchars( strtolower(stripslashes($data["username"])) );
    $password = htmlspecialchars( mysqli_real_escape_string($conn,$data["password"]) );
    $password2 = htmlspecialchars( mysqli_real_escape_string($conn,$data["password2"]) );

    // cek apakah pass dan konfirmasi pass sama atau tidak
    if($password !== $password2) {
        echo "<script>
            alert('Konfirmasi password tidak sesuai!');
            </script>";
        return false; 
    }

    // cek apakah ada nama yang sama atau tidak
    $result = mysqli_query($conn, "SELECT username FROM registrasi WHERE username = '$username'");

    if($arr = mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Nama sudah terdaftar!');
            </script>";
        return false;
    }

    // enkripsi pass
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    // masukkan data
    $query = "INSERT INTO registrasi VALUES ('','$username','$password')";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}
?>