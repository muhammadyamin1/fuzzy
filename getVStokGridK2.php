<?php
include 'auth.php';
checkRole(['admin']);
include 'dbKoneksi.php';

// Mengambil data dari tabel
$sql = "SELECT nama_fungsi, batas_bawah, batas_tengah, batas_atas, tipe FROM fungsi_keanggotaan_gridk2 WHERE jenis='Stok'";
$result = $conn->query($sql);

$membershipData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $membershipData[] = $row;
    }
}

// Mengubah data menjadi format JSON
echo json_encode($membershipData);

$conn->close();
?>
