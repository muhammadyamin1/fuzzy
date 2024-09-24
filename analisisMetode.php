<?php
include 'auth.php';
include 'dbKoneksi.php'; // Koneksi ke database

// Ambil data dari tabel fungsi keanggotaan untuk permintaan, stok, dan produksi
$query_fungsi_permintaan = "SELECT * FROM fungsi_keanggotaan_gridk3 WHERE jenis='Permintaan' ORDER BY batas_atas ASC;";
$query_fungsi_stok = "SELECT * FROM fungsi_keanggotaan_gridk3 WHERE jenis='Stok' ORDER BY batas_atas ASC;";
$query_fungsi_produksi = "SELECT * FROM fungsi_keanggotaan_gridk3 WHERE jenis='Produksi' ORDER BY batas_atas ASC;";

$result_fungsi_permintaan = mysqli_query($conn, $query_fungsi_permintaan);
$result_fungsi_stok = mysqli_query($conn, $query_fungsi_stok);
$result_fungsi_produksi = mysqli_query($conn, $query_fungsi_produksi);

// Ambil data dari tabel rule
$query_rule = "SELECT * FROM rule_gridk3;";
$result_rule = mysqli_query($conn, $query_rule);

$ExistsFungsiPermintaan = mysqli_num_rows($result_fungsi_permintaan) > 0;
$ExistsFungsiStok = mysqli_num_rows($result_fungsi_stok) > 0;
$ExistsFungsiProduksi = mysqli_num_rows($result_fungsi_produksi) > 0;
$ExistsRule = mysqli_num_rows($result_rule) > 0;

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

// Ambil fungsi keanggotaan untuk produksi
$fungsi_produksi = [];
if ($ExistsFungsiProduksi) {
    while ($row_fungsi = mysqli_fetch_assoc($result_fungsi_produksi)) {
        $fungsi_produksi[$row_fungsi['nama_fungsi']] = $row_fungsi;
    }
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

            /* Sembunyikan elemen yang tidak ingin dicetak */
            #printSection, #fuzzyForm, .search-bar {
                display: none;
            }

            /* Lebarkan elemen content saat mencetak */
            .print {
                padding: 0;
            }
        }
    </style>
</head>

<body class="theme-red">
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
                                            <input type="number" class="form-control" id="permintaan" name="permintaan" placeholder="Masukkan Permintaan" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="stok" class="col-sm-2 control-label">Stok</label>
                                    <div class="col-sm-10">
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan Stok" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" id="submitButton" class="btn btn-primary">Hitung</button>
                                    </div>
                                </div>
                            </form>

                            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
                                <?php
                                // Ambil input dari form
                                $permintaan = $_POST['permintaan'];
                                $stok = $_POST['stok'];

                                // Inisialisasi
                                $sum_alpha_z = 0;
                                $sum_alpha = 0;

                                // Menghitung derajat keanggotaan dari permintaan dan stok
                                $derajat_keanggotaan_permintaan = [];
                                $derajat_keanggotaan_stok = [];

                                // Hitung derajat keanggotaan untuk permintaan
                                if ($ExistsFungsiPermintaan) {
                                    mysqli_data_seek($result_fungsi_permintaan, 0);
                                    while ($row_fungsi = mysqli_fetch_assoc($result_fungsi_permintaan)) {
                                        $tipe = strtolower($row_fungsi['tipe']);
                                        $a = $row_fungsi['batas_bawah'];
                                        $b = $row_fungsi['batas_tengah'];
                                        $c = $row_fungsi['batas_atas'];

                                        $derajat = hitungKeanggotaan($permintaan, $a, $b, $c, $tipe);
                                        $derajat_keanggotaan_permintaan[$row_fungsi['nama_fungsi']] = $derajat;
                                    }
                                }

                                // Hitung derajat keanggotaan untuk stok
                                if ($ExistsFungsiStok) {
                                    mysqli_data_seek($result_fungsi_stok, 0);
                                    while ($row_fungsi = mysqli_fetch_assoc($result_fungsi_stok)) {
                                        $tipe = strtolower($row_fungsi['tipe']);
                                        $a = $row_fungsi['batas_bawah'];
                                        $b = $row_fungsi['batas_tengah'];
                                        $c = $row_fungsi['batas_atas'];

                                        $derajat = hitungKeanggotaan($stok, $a, $b, $c, $tipe);
                                        $derajat_keanggotaan_stok[$row_fungsi['nama_fungsi']] = $derajat;
                                    }
                                }

                                // Loop through each rule and calculate alpha_predikat and z
                                $rules_with_values = []; // Array untuk menyimpan nilai alpha_predikat dan z

                                if ($ExistsRule) {
                                    mysqli_data_seek($result_rule, 0);
                                    while ($row_rule = mysqli_fetch_assoc($result_rule)) {
                                        $permintaan_fungsi = $row_rule['permintaan'];
                                        $stok_fungsi = $row_rule['stok'];
                                        $produksi_fungsi = $row_rule['produksi'];

                                        if (isset($derajat_keanggotaan_permintaan[$permintaan_fungsi]) && isset($derajat_keanggotaan_stok[$stok_fungsi])) {
                                            $alpha_predikat = min($derajat_keanggotaan_permintaan[$permintaan_fungsi], $derajat_keanggotaan_stok[$stok_fungsi]);

                                            if ($alpha_predikat > 0) {
                                                // Dapatkan fungsi keanggotaan untuk produksi
                                                if (isset($fungsi_produksi[$produksi_fungsi])) {
                                                    $fungsi = $fungsi_produksi[$produksi_fungsi];
                                                    $tipe = strtolower($fungsi['tipe']);
                                                    $a = $fungsi['batas_bawah'];
                                                    $b = $fungsi['batas_tengah'];
                                                    $c = $fungsi['batas_atas'];

                                                    // Hitung z berdasarkan tipe
                                                    if ($tipe == 'menurun') {
                                                        $z1 = 0; // Tidak ada z1 dan z2 untuk menurun
                                                        $z2 = 0;
                                                        $z = $c - $alpha_predikat * ($c - $a);
                                                        // Alpha predikat untuk menurun ditambahkan sekali
                                                        $sum_alpha += $alpha_predikat;
                                                    } elseif ($tipe == 'menaik') {
                                                        $z1 = 0; // Tidak ada z1 dan z2 untuk menaik
                                                        $z2 = 0;
                                                        $z = $a + $alpha_predikat * ($c - $a);
                                                        // Alpha predikat untuk menaik ditambahkan sekali
                                                        $sum_alpha += $alpha_predikat;
                                                    } elseif ($tipe == 'segitiga') {
                                                        // Untuk segitiga, hitung z1 (sisi kiri) dan z2 (sisi kanan)
                                                        $z1 = $a + $alpha_predikat * ($b - $a);  // Sisi kiri
                                                        $z2 = $c - $alpha_predikat * ($c - $b);  // Sisi kanan
                                                        $z = $z1 + $z2;  // Menjumlahkan z1 dan z2 untuk pembilang

                                                        // Alpha predikat untuk segitiga ditambahkan dua kali
                                                        $sum_alpha += 2 * $alpha_predikat;
                                                    }

                                                    // Update alpha_predikat dan z ke dalam database
                                                    echo "Alpha Predikat: $alpha_predikat untuk rule ID: " . $row_rule['id'] . "<br>"; // Debugging tambahan

                                                    if ($alpha_predikat > 0) { // Pastikan kondisi ini benar
                                                        // Update alpha_predikat, z, z1, dan z2 ke dalam database
                                                        $update_query = "UPDATE rule_gridk3 SET alpha_predikat='$alpha_predikat', z1='$z1', z2='$z2', z='$z' WHERE id='{$row_rule['id']}'";
                                                        if (mysqli_query($conn, $update_query)) {
                                                            echo "Update berhasil untuk rule ID: " . $row_rule['id'] . "<br>";
                                                        } else {
                                                            echo "Error saat mengupdate rule ID: " . $row_rule['id'] . " - " . mysqli_error($conn) . "<br>";
                                                        }
                                                    } else {
                                                        echo "Alpha Predikat 0 atau tidak valid untuk rule ID: " . $row_rule['id'] . "<br>";
                                                    }

                                                    // Simpan untuk perhitungan defuzzifikasi
                                                    $sum_alpha_z += $alpha_predikat * $z;

                                                    $rules_with_values[] = [
                                                        'id' => $row_rule['id'],
                                                        'permintaan' => $permintaan_fungsi,
                                                        'stok' => $stok_fungsi,
                                                        'produksi' => $produksi_fungsi,
                                                        'alpha_predikat' => $alpha_predikat,
                                                        'z' => $z,
                                                        'z1' => isset($z1) ? $z1 : null,  // Jika ada z1 (segitiga)
                                                        'z2' => isset($z2) ? $z2 : null,  // Jika ada z2 (segitiga)
                                                        'tipe' => $tipe  // Simpan tipe kurva
                                                    ];
                                                }
                                            }
                                        }
                                    }
                                }

                                // Untuk rule yang tidak ada, set alpha_predikat, z, z1, dan z2 ke 0
                                $all_rules_query = "SELECT id FROM rule_gridk3";
                                $all_rules_result = mysqli_query($conn, $all_rules_query);

                                while ($row_all_rule = mysqli_fetch_assoc($all_rules_result)) {
                                    if (!in_array($row_all_rule['id'], array_column($rules_with_values, 'id'))) {
                                        $update_query = "UPDATE rule_gridk3 SET alpha_predikat='0', z1='0', z2='0', z='0' WHERE id='{$row_all_rule['id']}'";
                                        if (!mysqli_query($conn, $update_query)) {
                                            echo "Error saat mengupdate rule ID: " . $row_all_rule['id'] . " - " . mysqli_error($conn) . "<br>";
                                        }
                                    }
                                }

                                // Defuzzifikasi
                                if ($sum_alpha > 0) {
                                    $produksi = $sum_alpha_z / $sum_alpha;
                                } else {
                                    $produksi = 0;
                                    echo "<p>Error: Tidak ada alpha predikat yang valid.</p>";
                                }
                                ?>

                                <!-- Menampilkan hasil perhitungan -->
                                <div id="resultSection">
                                    <h3>Hasil Perhitungan</h3>
                                    <p><strong>Permintaan:</strong> <?php echo $permintaan; ?></p>
                                    <p><strong>Stok:</strong> <?php echo $stok; ?></p>
                                    <p><strong>Produksi (Hasil Defuzzifikasi):</strong> <?php echo number_format($produksi, 2); ?></p>

                                    <!-- Tabel Nilai Fungsi Implikasi -->
                                    <h4>Tabel Nilai Fungsi Implikasi</h4>
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
                                                <?php foreach ($rules_with_values as $rule): ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $rule['id']; ?></td>
                                                        <td class="text-center"><?php echo $rule['permintaan']; ?></td>
                                                        <td class="text-center"><?php echo number_format($derajat_keanggotaan_permintaan[$rule['permintaan']], 4); ?></td>
                                                        <td class="text-center"><?php echo $rule['stok']; ?></td>
                                                        <td class="text-center"><?php echo number_format($derajat_keanggotaan_stok[$rule['stok']], 4); ?></td>
                                                        <td class="text-center"><?php echo $rule['produksi']; ?></td>
                                                        <td class="text-center"><?php echo ucfirst($rule['tipe']); ?></td> <!-- Menampilkan tipe kurva -->
                                                        <td class="text-center"><?php echo number_format($rule['alpha_predikat'], 4); ?></td>
                                                        <td class="text-center"><?php echo isset($rule['z1']) ? number_format($rule['z1'], 2) : '-'; ?></td> <!-- Nilai Z1 untuk segitiga -->
                                                        <td class="text-center"><?php echo isset($rule['z2']) ? number_format($rule['z2'], 2) : '-'; ?></td> <!-- Nilai Z2 untuk segitiga -->
                                                        <td class="text-center"><?php echo number_format($rule['z'], 2); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Bar Chart -->
                                    <h4>Diagram Batang</h4>
                                    <canvas id="barChart"></canvas>
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
                    label: 'Jumlah',
                    data: [<?php echo $permintaan; ?>, <?php echo $stok; ?>, <?php echo $produksi; ?>],
                    backgroundColor: ['#3498db', '#2ecc71', '#e74c3c']
                }]
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