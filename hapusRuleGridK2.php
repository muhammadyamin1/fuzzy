<?php
include 'auth.php';
checkRole(['admin']);
include 'dbKoneksi.php';

$id = $_GET['id'];

// Hapus data
$query = "DELETE FROM rule_gridk2 WHERE id = '$id'";
if ($conn->query($query) === TRUE) {
    $_SESSION['success'] = "Rule berhasil dihapus.";
} else {
    $_SESSION['error'] = "Error: " . $conn->error;
}

// Redirect ke halaman tampil
header("Location: ruleGrid-K2.php");
exit();
?>