<?php
include 'auth.php';
checkRole(['admin']);
include 'dbKoneksi.php';

$id = $_GET['id'];

// Hapus data
$query = "DELETE FROM fungsi_keanggotaan_tsukamoto WHERE id = $id";
mysqli_query($conn, $query);

// Redirect ke halaman tampil
header("Location: vStokTsukamoto.php");
exit();
?>