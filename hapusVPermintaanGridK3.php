<?php
include 'auth.php';
include 'dbKoneksi.php';

$id = $_GET['id'];

// Hapus data
$query = "DELETE FROM fungsi_keanggotaan_gridk3 WHERE id = $id";
mysqli_query($conn, $query);

// Redirect ke halaman tampil
header("Location: vPermintaanGridK3.php");
exit();
?>