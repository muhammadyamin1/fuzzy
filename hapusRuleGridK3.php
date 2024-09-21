<?php
include 'auth.php';
include 'dbKoneksi.php';

$id = $_GET['id'];

// Hapus data
$query = "DELETE FROM rule_gridk3 WHERE id = '$id'";
if ($conn->query($query) === TRUE) {
    $_SESSION['success'] = "Rule berhasil dihapus.";
} else {
    $_SESSION['error'] = "Error: " . $conn->error;
}

// Redirect ke halaman tampil
header("Location: ruleGrid-K3.php");
exit();
?>