<?php
include 'auth.php';
checkRole(['admin']);
include 'dbKoneksi.php';

/// Menyimpan semua rule ke dalam tabel
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rule_ids = $_POST['rule_id'];
    $permintaan_list = $_POST['permintaan'];
    $stok_list = $_POST['stok'];
    $produksi_list = $_POST['produksi'];

    // Array untuk menyimpan rule yang ganda
    $duplicate_key_rules = [];
    $duplicate_combination_rules = [];

    for ($i = 0; $i < count($rule_ids); $i++) {
        $rule_id = "R" . $rule_ids[$i]; // Tambahkan "R" ke ID
        $permintaan = $permintaan_list[$i];
        $stok = $stok_list[$i];
        $produksi = $produksi_list[$i];

        // Cek apakah ID Rule sudah ada (validasi duplikat key)
        $sql_check_key = "SELECT * FROM rule_gridk2 WHERE id = '$rule_id'";
        $result_check_key = $conn->query($sql_check_key);

        if ($result_check_key->num_rows > 0) {
            // Jika ID sudah ada, masukkan ke array duplikat key
            $duplicate_key_rules[] = $rule_id;
        } else {
            // Cek apakah kombinasi Permintaan, Stok, dan Produksi sudah ada (validasi kombinasi)
            $sql_check_combination = "SELECT * FROM rule_gridk2 WHERE permintaan = '$permintaan' AND stok = '$stok' AND produksi = '$produksi'";
            $result_check_combination = $conn->query($sql_check_combination);

            if ($result_check_combination->num_rows > 0) {
                // Jika kombinasi sama, masukkan ke array duplikat kombinasi
                $existing_rule = $result_check_combination->fetch_assoc();
                $duplicate_combination_rules[] = "ID Rule: " . $existing_rule['id'] . " - Permintaan: $permintaan, Stok: $stok, Produksi: $produksi";
            } else {
                // Simpan rule baru jika tidak ada duplikasi
                $sql = "INSERT INTO rule_gridk2 (id, permintaan, stok, produksi) VALUES ('$rule_id', '$permintaan', '$stok', '$produksi')";
                if ($conn->query($sql) !== TRUE) {
                    $_SESSION['error'] = "Error: " . $sql . "<br>" . $conn->error;
                    header("Location: ruleGrid-K2.php");
                }
            }
        }
    }

    // Jika ada duplikat key, buat session error dan arahkan kembali ke halaman input
    if (!empty($duplicate_key_rules)) {
        $_SESSION['error'] = "ID Rule berikut sudah ada: " . implode(", ", $duplicate_key_rules);
    }

    // Jika ada duplikat kombinasi, buat session error dan arahkan kembali ke halaman input
    if (!empty($duplicate_combination_rules)) {
        $_SESSION['error'] = "Kombinasi berikut sudah ada: <br>" . implode("<br>", $duplicate_combination_rules);
    }

    // Redirect kembali ke halaman input jika ada error
    if (!empty($duplicate_key_rules) || !empty($duplicate_combination_rules)) {
        $conn->close();
        header("Location: ruleGrid-K2.php");
        exit();
    } else {
        $conn->close();
        $_SESSION['success'] = "Semua rule berhasil disimpan.";
        header("Location: ruleGrid-K2.php");
        exit();
    }
}
