<?php
include 'auth.php';
include 'dbKoneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stok_maksimum = $_POST['stok_maksimum'];
    $permintaan = $_POST['permintaan'];
    $stok = $_POST['stok'];

    // Update atau Insert stok_maksimum
    $sql_check = "SELECT * FROM pengaturan_variabel WHERE nama_variabel = 'stok_maksimum'";
    $result_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($result_check) > 0) {
        // Jika stok_maksimum ada, lakukan update
        $sql_update = "UPDATE pengaturan_variabel SET nilai_variabel = '$stok_maksimum' WHERE nama_variabel = 'stok_maksimum'";
        mysqli_query($conn, $sql_update);
    } else {
        // Jika stok_maksimum tidak ada, lakukan insert
        $sql_insert = "INSERT INTO pengaturan_variabel (nama_variabel, nilai_variabel) VALUES ('stok_maksimum', '$stok_maksimum')";
        mysqli_query($conn, $sql_insert);
    }

    // Update atau Insert permintaan
    $sql_check = "SELECT * FROM pengaturan_variabel WHERE nama_variabel = 'permintaan'";
    $result_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($result_check) > 0) {
        $sql_update = "UPDATE pengaturan_variabel SET nilai_variabel = '$permintaan' WHERE nama_variabel = 'permintaan'";
        mysqli_query($conn, $sql_update);
    } else {
        $sql_insert = "INSERT INTO pengaturan_variabel (nama_variabel, nilai_variabel) VALUES ('permintaan', '$permintaan')";
        mysqli_query($conn, $sql_insert);
    }

    // Update atau Insert stok
    $sql_check = "SELECT * FROM pengaturan_variabel WHERE nama_variabel = 'stok'";
    $result_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($result_check) > 0) {
        $sql_update = "UPDATE pengaturan_variabel SET nilai_variabel = '$stok' WHERE nama_variabel = 'stok'";
        mysqli_query($conn, $sql_update);
    } else {
        $sql_insert = "INSERT INTO pengaturan_variabel (nama_variabel, nilai_variabel) VALUES ('stok', '$stok')";
        mysqli_query($conn, $sql_insert);
    }
}

mysqli_close($conn);

// Redirect kembali ke form setelah update/insert
header("Location: variabel.php");
exit;