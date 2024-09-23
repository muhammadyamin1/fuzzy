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
    <section>
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

    <section class="content">
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
                                                        $z = $c - $alpha_predikat * ($c - $a);
                                                    } elseif ($tipe == 'menaik') {
                                                        $z = $a + $alpha_predikat * ($c - $a);
                                                    } elseif ($tipe == 'segitiga') {
                                                        if ($alpha_predikat <= 1) {
                                                            if ($b < $c) {
                                                                // Jika berada di sebelah kiri batas tengah
                                                                if ($alpha_predikat <= ($b - $a) / ($c - $a)) {
                                                                    $z = $a + $alpha_predikat * ($b - $a);
                                                                } else {
                                                                    $z = $c - $alpha_predikat * ($c - $b);
                                                                }
                                                            } else {
                                                                $z = $a + $alpha_predikat * ($b - $a);
                                                            }
                                                        }
                                                    } else {
                                                        $z = 0; // Default jika tipe tidak dikenali
                                                    }

                                                    // Update alpha_predikat dan z ke dalam database
                                                    $update_query = "UPDATE rule_gridk3 SET alpha_predikat='$alpha_predikat', z='$z' WHERE id='{$row_rule['id']}'";
                                                    mysqli_query($conn, $update_query);

                                                    // Simpan untuk perhitungan defuzzifikasi
                                                    $sum_alpha_z += $alpha_predikat * $z;
                                                    $sum_alpha += $alpha_predikat;

                                                    // Simpan nilai untuk ditampilkan
                                                    $rules_with_values[] = [
                                                        'id' => $row_rule['id'],
                                                        'permintaan' => $permintaan_fungsi,
                                                        'stok' => $stok_fungsi,
                                                        'alpha_predikat' => $alpha_predikat,
                                                        'z' => $z
                                                    ];
                                                }
                                            }
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
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Rule</th>
                                                <th>Permintaan</th>
                                                <th>Stok</th>
                                                <th>Alpha Predikat</th>
                                                <th>Nilai Z</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($rules_with_values as $rule): ?>
                                                <tr>
                                                    <td><?php echo $rule['id']; ?></td>
                                                    <td><?php echo $rule['permintaan']; ?></td>
                                                    <td><?php echo $rule['stok']; ?></td>
                                                    <td><?php echo number_format($rule['alpha_predikat'], 4); ?></td>
                                                    <td><?php echo number_format($rule['z'], 2); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                    <!-- Bar Chart -->
                                    <h4>Diagram Batang</h4>
                                    <canvas id="barChart"></canvas>
                                </div>

                                <!-- Print Button -->
                                <div id="printSection" class="text-center">
                                    <button onclick="window.print()" class="btn btn-success">Print Halaman</button>
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
    </script>

</body>

</html>