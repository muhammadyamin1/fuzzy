<?php
include 'auth.php';
checkRole(['admin']);
require 'dbKoneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $currentUserId = $_SESSION['user_id'];

    // Cek apakah admin mencoba menghapus dirinya sendiri
    if ($id == $currentUserId) {
        $_SESSION['error'] = "Anda tidak dapat menghapus diri sendiri.";
        header("Location: users.php");
        exit();
    }

    // Cek apakah mencoba menghapus Super Admin dengan id 1
    if ($id == 1) {
        $_SESSION['error'] = "Anda tidak dapat menghapus Super Admin.";
        header("Location: users.php");
        exit();
    }

    // Lanjutkan proses penghapusan
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Pengguna berhasil dihapus.";
    } else {
        $_SESSION['error'] = "Gagal menghapus pengguna.";
    }

    $stmt->close();
    $conn->close();

    header("Location: users.php");
}

exit();