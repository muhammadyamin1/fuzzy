<?php
include 'auth.php';
checkRole(['admin']);
include 'dbKoneksi.php';
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

    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

    <style>
        .id-rule-width {
            width: 20%;
        }

        .equal-width {
            width: 20%;
            /* Kolom Permintaan, Stok, Produksi dibagi rata */
        }

        .action-center {
            text-align: center;
        }
    </style>
</head>

<body class="theme-red">
    <!-- Page Loader -->
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
                <div class="row clearfix">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);">Kelola Data</a></li>
                        <li class="active">Rule Fuzzy Grid Partition (K=3)</li>
                    </ol>
                </div>
            </div>
            <?php
            // Menampilkan pesan error
            if (isset($_SESSION['error'])) {
                echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
                unset($_SESSION['error']); // Hapus pesan setelah ditampilkan
            }

            // Menampilkan pesan sukses
            if (isset($_SESSION['success'])) {
                echo "
                <div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                " . $_SESSION['success'] . "</div>";
                unset($_SESSION['success']); // Hapus pesan setelah ditampilkan
            }
            ?>
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Perhatian!</strong> Pastikan tidak ada perubahan <b>Nama Fungsi</b> keanggotaan sebelum membuat Rule.
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Daftar Rule Fuzzy Grid Partition (K=3)
                            </h2>
                        </div>
                        <div class="body">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ruleModal">
                                Tambah Rule Fuzzy
                            </button>
                            <a href="inputRuleGridK3.php" class="btn btn-info" role="button">Tambah Rule Horizontal</a>

                            <!-- Modal Input Rule -->
                            <div class="modal fade" id="ruleModal" tabindex="-1" role="dialog" aria-labelledby="ruleModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title" id="ruleModalLabel">Input Rule Fuzzy</h4>
                                        </div>
                                        <form action="simpanRuleGridK3.php" method="POST">
                                            <div class="modal-body">
                                                <!-- Input manual untuk ID Rule -->
                                                <label for="rule_id" class="control-label">ID Rule (Number, contoh: 1, 2, 3):</label>
                                                <div class="form-group" style="margin-bottom: 12px;">
                                                    <div class="form-line">
                                                        <input type="number" name="rule_id" id="rule_id" class="form-control" required>
                                                    </div>
                                                </div>

                                                <!-- Menampilkan informasi tentang rule fuzzy menggunakan MathJax -->
                                                <p>Aturan fuzzy yang dimasukkan menggunakan format:</p>
                                                <p>\[
                                                    \text{If} \ D \ \text{and} \ S \ \text{then} \ P
                                                    \]</p>

                                                <!-- Select untuk Permintaan dengan notasi matematika -->
                                                <label for="permintaan" class="control-label">Permintaan \( D \):</label>
                                                <select name="permintaan" id="permintaan" class="form-control show-tick">
                                                    <?php
                                                    // Query untuk mengambil data Permintaan
                                                    $queryPermintaan = "SELECT nama_fungsi FROM fungsi_keanggotaan_gridk3 WHERE jenis = 'Permintaan'";
                                                    $resultPermintaan = $conn->query($queryPermintaan);
                                                    if ($resultPermintaan->num_rows > 0) {
                                                        while ($row = $resultPermintaan->fetch_assoc()) {
                                                            echo "<option value='" . $row['nama_fungsi'] . "'>" . $row['nama_fungsi'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>

                                                <!-- Select untuk Stok dengan notasi matematika -->
                                                <label for="stok" class="control-label" style="margin-top: 15px;">Stok \( S \):</label>
                                                <select name="stok" id="stok" class="form-control">
                                                    <?php
                                                    // Query untuk mengambil data Stok
                                                    $queryStok = "SELECT nama_fungsi FROM fungsi_keanggotaan_gridk3 WHERE jenis = 'Stok'";
                                                    $resultStok = $conn->query($queryStok);
                                                    if ($resultStok->num_rows > 0) {
                                                        while ($row = $resultStok->fetch_assoc()) {
                                                            echo "<option value='" . $row['nama_fungsi'] . "'>" . $row['nama_fungsi'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>

                                                <!-- Select untuk Produksi dengan notasi matematika -->
                                                <label for="produksi" class="control-label" style="margin-top: 15px;">Produksi \( P \):</label>
                                                <select name="produksi" id="produksi" class="form-control">
                                                    <?php
                                                    // Query untuk mengambil data Produksi
                                                    $queryProduksi = "SELECT nama_fungsi FROM fungsi_keanggotaan_gridk3 WHERE jenis = 'Produksi'";
                                                    $resultProduksi = $conn->query($queryProduksi);
                                                    if ($resultProduksi->num_rows > 0) {
                                                        while ($row = $resultProduksi->fetch_assoc()) {
                                                            echo "<option value='" . $row['nama_fungsi'] . "'>" . $row['nama_fungsi'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan Rule</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="id-rule-width">ID Rule</th>
                                            <th class="equal-width">Permintaan</th>
                                            <th class="equal-width">Stok</th>
                                            <th class="equal-width">Produksi</th>
                                            <th class="action-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Query untuk menampilkan data Rule yang ada
                                        $queryRule = "SELECT id, permintaan, stok, produksi FROM rule_gridk3 ORDER BY CAST(SUBSTRING(id, 2) AS UNSIGNED)";
                                        $resultRule = $conn->query($queryRule);
                                        if ($resultRule->num_rows > 0) {
                                            while ($row = $resultRule->fetch_assoc()) {
                                                echo "<tr>
                                                    <td>{$row['id']}</td>
                                                    <td>{$row['permintaan']}</td>
                                                    <td>{$row['stok']}</td>
                                                    <td>{$row['produksi']}</td>
                                                    <td class='action-center'>
                                                        <a href='hapusRuleGridK3.php?id={$row['id']}' class='btn btn-danger' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>
                                                    </td>
                                                </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>Belum ada data rule</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

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
        // Hilangkan notifikasi setelah 5 detik
        setTimeout(function() {
            $(".alert").alert('close');
        }, 20000);
    </script>

</body>

</html>

<?php
// Tutup koneksi
$conn->close();
?>