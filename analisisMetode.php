<?php
include 'auth.php';
include 'dbKoneksi.php'; // Koneksi ke database

// Fungsi untuk menghitung derajat keanggotaan
function hitungKeanggotaan($x, $a, $b, $c, $tipe)
{
    // Menangani tipe fungsi menurun
    if (strtolower($tipe) == 'menurun') {
        if ($x <= $a) {
            return 1;  // Nilai keanggotaan penuh untuk x <= batas bawah
        } elseif ($x >= $c) {
            return 0;  // Tidak ada keanggotaan untuk x >= batas atas
        } else {
            return ($c - $x) / ($c - $a);  // Kurva menurun
        }
        // Menangani tipe fungsi segitiga
    } elseif (strtolower($tipe) == 'segitiga') {
        if ($x <= $a || $x >= $c) {
            return 0;  // Nilai keanggotaan 0 di luar batas bawah dan atas
        } elseif ($x >= $a && $x <= $b) {
            return ($x - $a) / ($b - $a);  // Bagian menaik segitiga
        } elseif ($x >= $b && $x <= $c) {
            return ($c - $x) / ($c - $b);  // Bagian menurun segitiga
        }
        // Menangani tipe fungsi menaik
    } elseif (strtolower($tipe) == 'menaik') {
        if ($x <= $a) {
            return 0;  // Tidak ada keanggotaan untuk x <= batas bawah
        } elseif ($x >= $c) {
            return 1;  // Nilai keanggotaan penuh untuk x >= batas atas
        } else {
            return ($x - $a) / ($c - $a);  // Kurva menaik
        }
    }

    return 0;  // Jika tipe tidak sesuai, kembalikan 0
}

// Fungsi untuk perhitungan dari setiap metode
function hitungFuzzy($result_fungsi_permintaan, $result_fungsi_stok, $result_fungsi_produksi, $result_rule, $table_name, &$derajat_keanggotaan_permintaan, &$derajat_keanggotaan_stok, $permintaan, $stok)
{
    global $conn;
    $sum_alpha_z = 0;
    $sum_alpha = 0;
    $rules_with_values = [];

    // Hitung derajat keanggotaan permintaan dan stok
    $derajat_keanggotaan_permintaan_k3 = [];
    $derajat_keanggotaan_stok_k3 = [];
    $derajat_keanggotaan_permintaan_k2 = [];
    $derajat_keanggotaan_stok_k2 = [];
    $derajat_keanggotaan_permintaan_tsukamoto = [];
    $derajat_keanggotaan_stok_tsukamoto = [];
    $tipe_keanggotaan = [];

    // Hitung derajat keanggotaan permintaan dan stok
    mysqli_data_seek($result_fungsi_permintaan, 0);
    while ($row_fungsi = mysqli_fetch_assoc($result_fungsi_permintaan)) {
        $nilai_keanggotaan_permintaan = hitungKeanggotaan($permintaan, $row_fungsi['batas_bawah'], $row_fungsi['batas_tengah'], $row_fungsi['batas_atas'], $row_fungsi['tipe']);
        $nilai_keanggotaan_permintaan = round($nilai_keanggotaan_permintaan, 3); // Membatasi menjadi tiga angka di belakang koma
        $derajat_keanggotaan_permintaan[$row_fungsi['nama_fungsi']] = $nilai_keanggotaan_permintaan;
    }

    mysqli_data_seek($result_fungsi_stok, 0);
    while ($row_fungsi = mysqli_fetch_assoc($result_fungsi_stok)) {
        $nilai_keanggotaan_stok = hitungKeanggotaan($stok, $row_fungsi['batas_bawah'], $row_fungsi['batas_tengah'], $row_fungsi['batas_atas'], $row_fungsi['tipe']);
        $nilai_keanggotaan_stok = round($nilai_keanggotaan_stok, 3);
        $derajat_keanggotaan_stok[$row_fungsi['nama_fungsi']] = $nilai_keanggotaan_stok;
    }

    // Loop setiap rule dan hitung alpha_predikat dan z
    $ExistsRule = mysqli_num_rows($result_rule) > 0;
    if ($ExistsRule) {
        mysqli_data_seek($result_rule, 0);
        while ($row_rule = mysqli_fetch_assoc($result_rule)) {
            $permintaan_fungsi = $row_rule['permintaan'];
            $stok_fungsi = $row_rule['stok'];
            $produksi_fungsi = $row_rule['produksi'];

            if (isset($derajat_keanggotaan_permintaan[$permintaan_fungsi]) && isset($derajat_keanggotaan_stok[$stok_fungsi])) {
                $alpha_predikat = min($derajat_keanggotaan_permintaan[$permintaan_fungsi], $derajat_keanggotaan_stok[$stok_fungsi]);
                $alpha_predikat = round($alpha_predikat, 3);

                if ($alpha_predikat > 0) {
                    // Ambil data batas dari tabel fungsi_keanggotaan untuk produksi
                    $query_fungsi_produksi = "SELECT batas_bawah, batas_tengah, batas_atas, tipe FROM fungsi_keanggotaan_" . $table_name . " WHERE nama_fungsi='$produksi_fungsi' AND jenis='produksi'";
                    $result_fungsi_produksi = mysqli_query($conn, $query_fungsi_produksi);

                    // Pastikan data ditemukan sebelum akses array
                    if ($fungsi_produksi = mysqli_fetch_assoc($result_fungsi_produksi)) {
                        $a = $fungsi_produksi['batas_bawah'];
                        $b = $fungsi_produksi['batas_tengah'];
                        $c = $fungsi_produksi['batas_atas'];
                        $tipe = strtolower($fungsi_produksi['tipe']);

                        // Hitung z berdasarkan tipe
                        if ($tipe == 'menurun') {
                            $z1 = 0;  // Tidak ada z1 dan z2 untuk menurun
                            $z2 = 0;
                            $z = $c - $alpha_predikat * ($c - $a);
                            $z = round($z, 3);
                            $sum_alpha += $alpha_predikat;
                        } elseif ($tipe == 'menaik') {
                            $z1 = 0;  // Tidak ada z1 dan z2 untuk menaik
                            $z2 = 0;
                            $z = $a + $alpha_predikat * ($c - $a);
                            $z = round($z, 3);
                            $sum_alpha += $alpha_predikat;
                        } elseif ($tipe == 'segitiga') {
                            $z1 = $a + $alpha_predikat * ($b - $a);  // Sisi kiri
                            $z2 = $c - $alpha_predikat * ($c - $b);  // Sisi kanan
                            $z1 = round($z1, 3);
                            $z2 = round($z2, 3);
                            $z = $z1 + $z2;  // Menjumlahkan z1 dan z2 untuk pembilang
                            $sum_alpha += 2 * $alpha_predikat;  // Alpha predikat untuk segitiga ditambahkan dua kali
                        }

                        // Simpan hasil alpha_predikat dan z
                        $sum_alpha_z += $alpha_predikat * $z;

                        // Simpan hasilnya untuk ditampilkan
                        $rules_with_values[] = [
                            'id' => $row_rule['id'],
                            'permintaan' => $permintaan_fungsi,
                            'stok' => $stok_fungsi,
                            'produksi' => $produksi_fungsi,
                            'alpha_predikat' => $alpha_predikat,
                            'z' => $z,
                            'z1' => $z1,
                            'z2' => $z2,
                            'tipe' => $tipe
                        ];
                    } else {
                        echo "Error: Fungsi keanggotaan untuk produksi '$produksi_fungsi' tidak ditemukan.<br>";
                    }
                }
            }
        }
    }

    return ['rules' => $rules_with_values, 'produksi' => $sum_alpha_z / $sum_alpha];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Fuzzy Tsukamoto - Fuzzy Grid Partition</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />

    <style>
        .valign-middle {
            vertical-align: middle !important;
        }

        @media print {

            #barChartDiv,
            .resultSectionGridK2,
            .resultSectionGridK3 {
                page-break-before: always;
            }

            /* Sembunyikan elemen yang tidak ingin dicetak */
            #printSection,
            #fuzzyForm,
            .search-bar {
                display: none;
            }

            /* Lebarkan elemen content saat mencetak */
            .print {
                padding: 0;
            }
        }
    </style>
</head>

<body class="theme-red"><!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="dashboard.php">Fuzzy Tsukamoto - Fuzzy Grid Partition</a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section id="aside">
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <?php include 'header.php'; ?>
            <!-- #User Info -->
            <!-- Menu -->
            <?php include 'sidebar.php'; ?>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2024 - STMIK Pelita Nusantara<br><a target="_blank" href="https://scholar.google.co.id/citations?user=zFJHYacAAAAJ&hl=id">Dr. Murni Marbun, S.Si., M.M., M.Kom.</a>
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content print">
        <div class="container-fluid">
            <div class="block-header">
                <h2>ANALISIS SELURUH METODE</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Analisis Seluruh Metode (Fuzzy Tsukamoto, Fuzzy Grid Partition K=2 & K=3)
                            </h2>
                        </div>
                        <div class="body">
                            <form id="fuzzyForm" method="post" class="form-horizontal">
                                <div class="form-group">
                                    <label for="permintaan" class="col-sm-2 control-label">Permintaan</label>
                                    <div class="col-sm-10">
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="permintaan" name="permintaan" placeholder="Masukkan Permintaan (Opsional)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="stok" class="col-sm-2 control-label">Stok</label>
                                    <div class="col-sm-10">
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan Stok (Opsional)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" id="submitButton" name="btn_submit" class="btn btn-primary">Hitung</button>
                                    </div>
                                </div>
                            </form>

                            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
                                <?php

                                // Query untuk mendapatkan nilai stok maksimum, permintaan, dan stok dari tabel pengaturan_variabel
                                $kueri = "SELECT nama_variabel, nilai_variabel FROM pengaturan_variabel WHERE nama_variabel IN ('stok_maksimum', 'permintaan', 'stok')";
                                $q1 = mysqli_query($conn, $kueri);

                                // Inisialisasi variabel dengan nilai default dari database
                                $stok_maksimum = 590; // Nilai default jika tidak ada data di database
                                $permintaan = 3900; // Nilai default jika tidak ada data di database
                                $stok = 310; // Nilai default jika tidak ada data di database

                                if ($q1 && mysqli_num_rows($q1) > 0) {
                                    while ($row = mysqli_fetch_assoc($q1)) {
                                        // Memasukkan nilai dari database berdasarkan nama_variabel
                                        if ($row['nama_variabel'] == 'stok_maksimum') {
                                            $stok_maksimum = $row['nilai_variabel'];
                                        } elseif ($row['nama_variabel'] == 'permintaan') {
                                            $permintaan = $row['nilai_variabel'];
                                        } elseif ($row['nama_variabel'] == 'stok') {
                                            $stok = $row['nilai_variabel'];
                                        }
                                    }
                                }

                                // Cek apakah form disubmit
                                if (isset($_POST['btn_submit'])) {
                                    // Ambil nilai dari form jika ada input, atau gunakan nilai default
                                    $permintaan = !empty($_POST['permintaan']) ? floatval($_POST['permintaan']) : $permintaan;
                                    $stok = !empty($_POST['stok']) ? floatval($_POST['stok']) : $stok;
                                }

                                // Ambil data dari tabel fungsi keanggotaan untuk K3, K2, dan Tsukamoto
                                $result_fungsi_permintaan_k3 = mysqli_query($conn, "SELECT * FROM fungsi_keanggotaan_gridk3 WHERE jenis='Permintaan' ORDER BY batas_atas ASC;");
                                $result_fungsi_stok_k3 = mysqli_query($conn, "SELECT * FROM fungsi_keanggotaan_gridk3 WHERE jenis='Stok' ORDER BY batas_atas ASC;");
                                $result_fungsi_produksi_k3 = mysqli_query($conn, "SELECT * FROM fungsi_keanggotaan_gridk3 WHERE jenis='Produksi' ORDER BY batas_atas ASC;");
                                $result_rule_k3 = mysqli_query($conn, "SELECT * FROM rule_gridk3;");

                                $result_fungsi_permintaan_k2 = mysqli_query($conn, "SELECT * FROM fungsi_keanggotaan_gridk2 WHERE jenis='Permintaan' ORDER BY batas_atas ASC;");
                                $result_fungsi_stok_k2 = mysqli_query($conn, "SELECT * FROM fungsi_keanggotaan_gridk2 WHERE jenis='Stok' ORDER BY batas_atas ASC;");
                                $result_fungsi_produksi_k2 = mysqli_query($conn, "SELECT * FROM fungsi_keanggotaan_gridk2 WHERE jenis='Produksi' ORDER BY batas_atas ASC;");
                                $result_rule_k2 = mysqli_query($conn, "SELECT * FROM rule_gridk2;");

                                $result_fungsi_permintaan_tsukamoto = mysqli_query($conn, "SELECT * FROM fungsi_keanggotaan_tsukamoto WHERE jenis='Permintaan' ORDER BY batas_atas ASC;");
                                $result_fungsi_stok_tsukamoto = mysqli_query($conn, "SELECT * FROM fungsi_keanggotaan_tsukamoto WHERE jenis='Stok' ORDER BY batas_atas ASC;");
                                $result_fungsi_produksi_tsukamoto = mysqli_query($conn, "SELECT * FROM fungsi_keanggotaan_tsukamoto WHERE jenis='Produksi' ORDER BY batas_atas ASC;");
                                $result_rule_tsukamoto = mysqli_query($conn, "SELECT * FROM rule_tsukamoto;");

                                // Perhitungan Fuzzy Grid Partition K3
                                $result_k3 = hitungFuzzy($result_fungsi_permintaan_k3, $result_fungsi_stok_k3, $result_fungsi_produksi_k3, $result_rule_k3, 'gridk3', $derajat_keanggotaan_permintaan_k3, $derajat_keanggotaan_stok_k3, $permintaan, $stok);
                                $rules_with_values_k3 = $result_k3['rules'];
                                $produksi_k3 = $result_k3['produksi'];

                                // Perhitungan Fuzzy Grid Partition K2
                                $result_k2 = hitungFuzzy($result_fungsi_permintaan_k2, $result_fungsi_stok_k2, $result_fungsi_produksi_k2, $result_rule_k2, 'gridk2', $derajat_keanggotaan_permintaan_k2, $derajat_keanggotaan_stok_k2, $permintaan, $stok);
                                $rules_with_values_k2 = $result_k2['rules'];
                                $produksi_k2 = $result_k2['produksi'];

                                // Perhitungan Fuzzy Tsukamoto
                                $result_tsukamoto = hitungFuzzy($result_fungsi_permintaan_tsukamoto, $result_fungsi_stok_tsukamoto, $result_fungsi_produksi_tsukamoto, $result_rule_tsukamoto, 'tsukamoto', $derajat_keanggotaan_permintaan_tsukamoto, $derajat_keanggotaan_stok_tsukamoto, $permintaan, $stok);
                                $rules_with_values_tsukamoto = $result_tsukamoto['rules'];
                                $produksi_tsukamoto = $result_tsukamoto['produksi'];

                                // UPDATE SEMUA TABEL RULE
                                $table_names = ['rule_tsukamoto', 'rule_gridk2', 'rule_gridk3'];
                                $namaTabel = ['tsukamoto', 'gridk2', 'gridk3'];

                                foreach ($table_names as $index => $table_name) {
                                    // Ambil elemen yang sesuai dari $namaTabel
                                    $nT = $namaTabel[$index];

                                    // Ambil data fungsi dan rule
                                    $result_fungsi_permintaan = mysqli_query($conn, "SELECT * FROM fungsi_keanggotaan_$nT WHERE jenis='Permintaan' ORDER BY batas_atas ASC;");
                                    $result_fungsi_stok = mysqli_query($conn, "SELECT * FROM fungsi_keanggotaan_$nT WHERE jenis='Stok' ORDER BY batas_atas ASC;");
                                    $result_fungsi_produksi = mysqli_query($conn, "SELECT * FROM fungsi_keanggotaan_$nT WHERE jenis='Produksi' ORDER BY batas_atas ASC;");
                                    $result_rule = mysqli_query($conn, "SELECT * FROM $table_name;");

                                    // Perhitungan dan update data
                                    $result = hitungFuzzy($result_fungsi_permintaan, $result_fungsi_stok, $result_fungsi_produksi, $result_rule, $nT, $derajat_keanggotaan_permintaan, $derajat_keanggotaan_stok, $permintaan, $stok);
                                    $rules_with_values = $result['rules'];
                                    $produksi = $result['produksi'];

                                    foreach ($rules_with_values as $rule) {
                                        $update_query = "UPDATE $table_name SET alpha_predikat='{$rule['alpha_predikat']}', z1='{$rule['z1']}', z2='{$rule['z2']}', z='{$rule['z']}' WHERE id='{$rule['id']}'";
                                        if (mysqli_query($conn, $update_query)) {
                                            echo "Update berhasil untuk rule ID: {$rule['id']} di tabel $table_name<br>";
                                        } else {
                                            echo "Error saat mengupdate rule ID: {$rule['id']} di tabel $table_name - " . mysqli_error($conn) . "<br>";
                                        }
                                    }

                                    // Update rule yang tidak terpilih (nilai 0)
                                    $rule_ids = array_column($rules_with_values, 'id');
                                    $rule_ids_str = "'" . implode("','", $rule_ids) . "'";

                                    // Cari rule yang tidak ada di dalam hasil terpilih dan update ke 0
                                    $update_zeros_query = "UPDATE $table_name SET alpha_predikat='0', z1='0', z2='0', z='0' WHERE id NOT IN ($rule_ids_str)";
                                    if (mysqli_query($conn, $update_zeros_query)) {
                                        echo "Update berhasil untuk rule yang tidak terpilih di tabel $table_name<br>";
                                    } else {
                                        echo "Error saat mengupdate rule yang tidak terpilih di tabel $table_name - " . mysqli_error($conn) . "<br>";
                                    }
                                }
                                ?>

                                <!-- Menampilkan hasil perhitungan -->
                                <div id="resultSection">
                                    <h3>Hasil Perhitungan</h3>
                                    <p><strong>Permintaan:</strong> <?php echo $permintaan ?></p>
                                    <p><strong>Stok:</strong> <?php echo $stok ?></p>

                                    <div class="resultSectionTsukamoto">
                                        <!-- Tabel untuk Fuzzy Tsukamoto -->
                                        <h4>Hasil Fuzzy Tsukamoto</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr class="bg-blue-grey">
                                                        <th class="text-center valign-middle">Rule</th>
                                                        <th class="text-center valign-middle">Permintaan</th>
                                                        <th class="text-center valign-middle">Derajat Keanggotaan Permintaan</th>
                                                        <th class="text-center valign-middle">Stok</th>
                                                        <th class="text-center valign-middle">Derajat Keanggotaan Stok</th>
                                                        <th class="text-center valign-middle">Produksi</th>
                                                        <th class="text-center valign-middle">Tipe Kurva</th>
                                                        <th class="text-center valign-middle">Alpha Predikat</th>
                                                        <th class="text-center valign-middle">Nilai Z1</th>
                                                        <th class="text-center valign-middle">Nilai Z2</th>
                                                        <th class="text-center valign-middle">Nilai Z</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($rules_with_values_tsukamoto as $rule): ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $rule['id']; ?></td>
                                                            <td class="text-center"><?php echo $rule['permintaan']; ?></td>
                                                            <td class="text-center"><?php echo number_format($derajat_keanggotaan_permintaan_tsukamoto[$rule['permintaan']], 3); ?></td>
                                                            <td class="text-center"><?php echo $rule['stok']; ?></td>
                                                            <td class="text-center"><?php echo number_format($derajat_keanggotaan_stok_tsukamoto[$rule['stok']], 3); ?></td>
                                                            <td class="text-center"><?php echo $rule['produksi']; ?></td>
                                                            <td class="text-center"><?php echo ucfirst($rule['tipe']); ?></td>
                                                            <td class="text-center"><?php echo number_format($rule['alpha_predikat'], 4); ?></td>
                                                            <td class="text-center"><?php echo isset($rule['z1']) ? number_format($rule['z1'], 2) : '-'; ?></td>
                                                            <td class="text-center"><?php echo isset($rule['z2']) ? number_format($rule['z2'], 2) : '-'; ?></td>
                                                            <td class="text-center"><?php echo number_format($rule['z'], 2); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <?php
                                        // Hitung sisa stok
                                        $sisa_stok_tsukamoto = ($produksi_tsukamoto + $stok) - $permintaan;

                                        // Tentukan apakah produksi optimal atau tidak
                                        if ($sisa_stok_tsukamoto > $stok_maksimum) {
                                            $optimal_status = "Jumlah stok melebihi batas atas dari jumlah stok yang ditentukan sehingga produksi (" . number_format($produksi_tsukamoto, 2, ',', '.') . " paket/hari) tidaklah optimal.";
                                            $optimal_class = "alert-danger"; // Warna merah untuk tidak optimal
                                        } else {
                                            $optimal_status = "Jumlah stok tidak melebihi batas atas dari jumlah stok yang ditentukan sehingga produksi (" . number_format($produksi_tsukamoto, 0, ',', '.') . " paket/hari) adalah optimal.";
                                            $optimal_class = "alert-success"; // Warna hijau untuk optimal
                                        }
                                        ?>
                                        <!-- Hasil Defuzzifikasi dan Perhitungan Sisa Stok -->
                                        <div class="defuzzifikasi-result text-center">
                                            <div class="alert bg-indigo" role="alert" style="font-size: 1.3em; font-weight: bold; margin-bottom: 0px;">
                                                <p>Produksi yang dihasilkan: <?php echo number_format($produksi_tsukamoto, 2, ',', '.'); ?> paket/hari</p>
                                                <p>Sisa stok: <?php echo number_format($sisa_stok_tsukamoto, 0, ',', '.'); ?></p>
                                            </div>
                                        </div>

                                        <!-- Status Optimalitas -->
                                        <div class="alert <?php echo $optimal_class; ?> text-center" role="alert" style="font-size: 1em; font-weight: bold;">
                                            <p><?php echo $optimal_status; ?></p>
                                        </div>
                                    </div>
                                    <div class="resultSectionGridK2">
                                        <!-- Tabel untuk Fuzzy Grid Partition K2 -->
                                        <h4>Hasil Fuzzy Grid Partition K2</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr class="bg-blue-grey">
                                                        <th class="text-center valign-middle">Rule</th>
                                                        <th class="text-center valign-middle">Permintaan</th>
                                                        <th class="text-center valign-middle">Derajat Keanggotaan Permintaan</th>
                                                        <th class="text-center valign-middle">Stok</th>
                                                        <th class="text-center valign-middle">Derajat Keanggotaan Stok</th>
                                                        <th class="text-center valign-middle">Produksi</th>
                                                        <th class="text-center valign-middle">Tipe Kurva</th>
                                                        <th class="text-center valign-middle">Alpha Predikat</th>
                                                        <th class="text-center valign-middle">Nilai Z1</th>
                                                        <th class="text-center valign-middle">Nilai Z2</th>
                                                        <th class="text-center valign-middle">Nilai Z</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($rules_with_values_k2 as $rule): ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $rule['id']; ?></td>
                                                            <td class="text-center"><?php echo $rule['permintaan']; ?></td>
                                                            <td class="text-center"><?php echo number_format($derajat_keanggotaan_permintaan_k2[$rule['permintaan']], 3); ?></td>
                                                            <td class="text-center"><?php echo $rule['stok']; ?></td>
                                                            <td class="text-center"><?php echo number_format($derajat_keanggotaan_stok_k2[$rule['stok']], 3); ?></td>
                                                            <td class="text-center"><?php echo $rule['produksi']; ?></td>
                                                            <td class="text-center"><?php echo ucfirst($rule['tipe']); ?></td>
                                                            <td class="text-center"><?php echo number_format($rule['alpha_predikat'], 4); ?></td>
                                                            <td class="text-center"><?php echo isset($rule['z1']) ? number_format($rule['z1'], 2) : '-'; ?></td>
                                                            <td class="text-center"><?php echo isset($rule['z2']) ? number_format($rule['z2'], 2) : '-'; ?></td>
                                                            <td class="text-center"><?php echo number_format($rule['z'], 2); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <?php
                                        // Hitung sisa stok
                                        $sisa_stok_k2 = ($produksi_k2 + $stok) - $permintaan;

                                        // Tentukan apakah produksi optimal atau tidak
                                        if ($sisa_stok_k2 > $stok_maksimum) {
                                            $optimal_status = "Jumlah stok melebihi batas atas dari jumlah stok yang ditentukan sehingga produksi (" . number_format($produksi_k2, 2, ',', '.') . " paket/hari) tidaklah optimal.";
                                            $optimal_class = "alert-danger"; // Warna merah untuk tidak optimal
                                        } else {
                                            $optimal_status = "Jumlah stok tidak melebihi batas atas dari jumlah stok yang ditentukan sehingga produksi (" . number_format($produksi_k2, 0, ',', '.') . " paket/hari) adalah optimal.";
                                            $optimal_class = "alert-success"; // Warna hijau untuk optimal
                                        }
                                        ?>
                                        <!-- Hasil Defuzzifikasi dan Perhitungan Sisa Stok -->
                                        <div class="defuzzifikasi-result text-center">
                                            <div class="alert bg-indigo" role="alert" style="font-size: 1.3em; font-weight: bold; margin-bottom: 0px;">
                                                <p>Produksi yang dihasilkan: <?php echo number_format($produksi_k2, 2, ',', '.'); ?> paket/hari</p>
                                                <p>Sisa stok: <?php echo number_format($sisa_stok_k2, 0, ',', '.'); ?></p>
                                            </div>
                                        </div>

                                        <!-- Status Optimalitas -->
                                        <div class="alert <?php echo $optimal_class; ?> text-center" role="alert" style="font-size: 1em; font-weight: bold;">
                                            <p><?php echo $optimal_status; ?></p>
                                        </div>
                                    </div>
                                    <div class="resultSectionGridK3">
                                        <!-- Tabel untuk Fuzzy Grid Partition K3 -->
                                        <h4>Hasil Fuzzy Grid Partition K3</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr class="bg-blue-grey">
                                                        <th class="text-center valign-middle">Rule</th>
                                                        <th class="text-center valign-middle">Permintaan</th>
                                                        <th class="text-center valign-middle">Derajat Keanggotaan Permintaan</th>
                                                        <th class="text-center valign-middle">Stok</th>
                                                        <th class="text-center valign-middle">Derajat Keanggotaan Stok</th>
                                                        <th class="text-center valign-middle">Produksi</th>
                                                        <th class="text-center valign-middle">Tipe Kurva</th>
                                                        <th class="text-center valign-middle">Alpha Predikat</th>
                                                        <th class="text-center valign-middle">Nilai Z1</th>
                                                        <th class="text-center valign-middle">Nilai Z2</th>
                                                        <th class="text-center valign-middle">Nilai Z</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($rules_with_values_k3 as $rule): ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $rule['id']; ?></td>
                                                            <td class="text-center"><?php echo $rule['permintaan']; ?></td>
                                                            <td class="text-center"><?php echo number_format($derajat_keanggotaan_permintaan_k3[$rule['permintaan']], 3); ?></td>
                                                            <td class="text-center"><?php echo $rule['stok']; ?></td>
                                                            <td class="text-center"><?php echo number_format($derajat_keanggotaan_stok_k3[$rule['stok']], 3); ?></td>
                                                            <td class="text-center"><?php echo $rule['produksi']; ?></td>
                                                            <td class="text-center"><?php echo ucfirst($rule['tipe']); ?></td>
                                                            <td class="text-center"><?php echo number_format($rule['alpha_predikat'], 4); ?></td>
                                                            <td class="text-center"><?php echo isset($rule['z1']) ? number_format($rule['z1'], 2) : '-'; ?></td>
                                                            <td class="text-center"><?php echo isset($rule['z2']) ? number_format($rule['z2'], 2) : '-'; ?></td>
                                                            <td class="text-center"><?php echo number_format($rule['z'], 2); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <?php
                                        // Hitung sisa stok
                                        $sisa_stok_k3 = ($produksi_k3 + $stok) - $permintaan;

                                        // Tentukan apakah produksi optimal atau tidak
                                        if ($sisa_stok_k3 > $stok_maksimum) {
                                            $optimal_status = "Jumlah stok melebihi batas atas dari jumlah stok yang ditentukan sehingga produksi (" . number_format($produksi_k3, 2, ',', '.') . " paket/hari) tidaklah optimal.";
                                            $optimal_class = "alert-danger"; // Warna merah untuk tidak optimal
                                        } else {
                                            $optimal_status = "Jumlah stok tidak melebihi batas atas dari jumlah stok yang ditentukan sehingga produksi (" . number_format($produksi_k3, 0, ',', '.') . " paket/hari) adalah optimal.";
                                            $optimal_class = "alert-success"; // Warna hijau untuk optimal
                                        }
                                        ?>
                                        <!-- Hasil Defuzzifikasi dan Perhitungan Sisa Stok -->
                                        <div class="defuzzifikasi-result text-center">
                                            <div class="alert bg-indigo" role="alert" style="font-size: 1.3em; font-weight: bold; margin-bottom: 0px;">
                                                <p>Produksi yang dihasilkan: <?php echo number_format($produksi_k3, 2, ',', '.'); ?> paket/hari</p>
                                                <p>Sisa stok: <?php echo number_format($sisa_stok_k3, 0, ',', '.'); ?></p>
                                            </div>
                                        </div>

                                        <!-- Status Optimalitas -->
                                        <div class="alert <?php echo $optimal_class; ?> text-center" role="alert" style="font-size: 1em; font-weight: bold;">
                                            <p><?php echo $optimal_status; ?></p>
                                        </div>
                                    </div>

                                    <!-- Bar Chart -->
                                    <div id="barChartDiv">
                                        <h4>Diagram Batang</h4>
                                        <canvas id="barChart"></canvas>
                                    </div>
                                </div>

                                <!-- Print Button -->
                                <div id="printSection" class="text-center">
                                    <button onclick="printContent()" class="btn btn-success">Print Halaman</button>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="plugins/flot-charts/jquery.flot.js"></script>
    <script src="plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
    <script>
        // Bar chart
        var ctx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Permintaan', 'Stok', 'Produksi'],
                datasets: [{
                        label: 'Fuzzy Tsukamoto',
                        data: [<?php echo $permintaan; ?>, <?php echo $sisa_stok_tsukamoto; ?>, <?php echo $produksi_tsukamoto; ?>],
                        backgroundColor: '#e74c3c'
                    },
                    {
                        label: 'Fuzzy Grid Partition K2',
                        data: [<?php echo $permintaan; ?>, <?php echo $sisa_stok_k2; ?>, <?php echo $produksi_k2; ?>],
                        backgroundColor: '#2ecc71'
                    },
                    {
                        label: 'Fuzzy Grid Partition K3',
                        data: [<?php echo $permintaan; ?>, <?php echo $sisa_stok_k3; ?>, <?php echo $produksi_k3; ?>],
                        backgroundColor: '#3498db'
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
                    display: true
                }
            }
        });

        function printContent() {
            // Hapus kelas 'section'
            var sectionElement = document.querySelector('.content');
            if (sectionElement) {
                sectionElement.classList.remove('content');
            }

            // Hapus elemen dengan ID aside
            var asideElement = document.getElementById('aside');
            if (asideElement) {
                asideElement.style.display = 'none'; // Sembunyikan aside
            }

            // Lakukan print
            window.print();

            // Setelah print, tambahkan kembali kelas 'section' dan tampilkan aside
            if (sectionElement) {
                sectionElement.classList.add('content');
            }
            if (asideElement) {
                asideElement.style.display = ''; // Kembalikan aside ke tampilan semula
            }
        }
    </script>

</body>

</html>