<?php
include 'auth.php';
include 'dbKoneksi.php';

// Menyimpan data rule fuzzy ke dalam tabel
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rule_id = $_POST['rule_id']; // ID manual dari form (Number)
    $rule_id_prefiks = "R" . $rule_id; // Menambahkan "R" di depan angka
    $permintaan = $_POST['permintaan'];
    $stok = $_POST['stok'];
    $produksi = $_POST['produksi'];

    // Validasi: cek apakah rule dengan ID yang sama sudah ada
    $sql_check_id = "SELECT id FROM rule_gridk2 WHERE id = '$rule_id_prefiks'";
    $result_check_id = $conn->query($sql_check_id);

    if ($result_check_id && $result_check_id->num_rows > 0) {
        // Jika ada ID yang sama
        $_SESSION['error'] = "Rule dengan ID '$rule_id_prefiks' sudah ada. Silakan masukkan ID yang berbeda.";
    } else {
        // Validasi: cek apakah kombinasi permintaan, stok, dan produksi sudah ada
        $sql_check_combination = "SELECT id FROM rule_gridk2 WHERE permintaan = '$permintaan' AND stok = '$stok' AND produksi = '$produksi'";
        $result_check_combination = $conn->query($sql_check_combination);

        if ($result_check_combination && $result_check_combination->num_rows > 0) {
            // Jika ada kombinasi yang sama
            $existing_rule = $result_check_combination->fetch_assoc();
            $existing_rule_id = $existing_rule['id']; // Ambil ID rule yang sudah ada
            $_SESSION['error'] = "Kombinasi permintaan, stok, dan produksi sudah ada di Rule ID '$existing_rule_id'. Silakan masukkan kombinasi lain.";
        } else {
            // Insert jika tidak ada ID atau kombinasi yang sama
            $sql = "INSERT INTO rule_gridk2 (id, permintaan, stok, produksi) VALUES ('$rule_id_prefiks', '$permintaan', '$stok', '$produksi')";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['success'] = "Rule berhasil disimpan.";
            } else {
                $_SESSION['error'] = "Error: " . $conn->error;
            }
        }
    }

    // Redirect kembali ke halaman rule
    header("Location: ruleGrid-K2.php");
    exit;
}

// Tutup koneksi
$conn->close();
?>
