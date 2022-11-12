<?php 
function t_tambah() {
    if(isset($_POST["kirim"])) {
        if(tambah($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambahkan');
                document.location.href='index.php';
                </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambahkan');
                document.location.href='index.php';
                </script>";
        }
    }
}

function t_edit() {
    if(isset($_POST["kirim"])) {
        if(edit($_POST) > 0) {
            echo "<script>
                alert('Data berhasil diubah');
                document.location.href='index.php';
                </script>";
        } else {
            echo "<script>
                alert('Data gagal diubah');
                document.location.href='index.php';
                </script>";
        }
    }
    
}
?>