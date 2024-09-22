<?php
include 'auth.php';
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
                                Tambah Rule Fuzzy Grid Partition (K=3)
                            </h2>
                        </div>
                        <div class="body">
                            <form action="simpanRuleGridK3Horizontal.php" method="POST" id="ruleForm">

                                <!-- Tempat untuk menambahkan rule baru -->
                                <div id="ruleContainer">
                                    <!-- Rule pertama -->
                                    <div class="row rule-row">
                                        <div class="col-md-3">
                                            <label for="rule_id">ID Rule:</label>
                                            <input type="number" name="rule_id[]" class="form-control" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="permintaan">Permintaan:</label>
                                            <select name="permintaan[]" class="form-control">
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
                                        </div>
                                        <div class="col-md-3">
                                            <label for="stok">Stok:</label>
                                            <select name="stok[]" class="form-control">
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
                                        </div>
                                        <div class="col-md-3">
                                            <label for="produksi">Produksi:</label>
                                            <select name="produksi[]" class="form-control">
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
                                    </div>
                                </div>

                                <!-- Tombol untuk menambahkan rule baru -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" id="addRule" class="btn btn-success">Tambah Rule Baru</button>
                                    </div>
                                </div>

                                <!-- Tombol untuk menyimpan semua rule -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <a class="btn bg-grey waves-effect" role="button" href="ruleGrid-K3.php">Kembali</a>
                                        <button type="submit" class="btn btn-primary waves-effect">Simpan Semua Rule</button>
                                    </div>
                                </div>
                            </form>
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

    <script>
        $(document).ready(function() {
            // Fungsi untuk menambahkan DOM baru (input rule)
            $('#addRule').click(function() {
                var newRule = `
                <div class="row rule-row">
                    <div class="col-md-3">
                        <label for="rule_id">ID Rule:</label>
                        <input type="number" name="rule_id[]" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="permintaan">Permintaan:</label>
                        <select name="permintaan[]" class="form-control">
                            <?php
                            $queryPermintaan = "SELECT nama_fungsi FROM fungsi_keanggotaan_gridk3 WHERE jenis = 'Permintaan'";
                            $resultPermintaan = $conn->query($queryPermintaan);
                            if ($resultPermintaan->num_rows > 0) {
                                while ($row = $resultPermintaan->fetch_assoc()) {
                                    echo "<option value='" . $row['nama_fungsi'] . "'>" . $row['nama_fungsi'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="stok">Stok:</label>
                        <select name="stok[]" class="form-control">
                            <?php
                            $queryStok = "SELECT nama_fungsi FROM fungsi_keanggotaan_gridk3 WHERE jenis = 'Stok'";
                            $resultStok = $conn->query($queryStok);
                            if ($resultStok->num_rows > 0) {
                                while ($row = $resultStok->fetch_assoc()) {
                                    echo "<option value='" . $row['nama_fungsi'] . "'>" . $row['nama_fungsi'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="produksi">Produksi:</label>
                        <select name="produksi[]" class="form-control">
                            <?php
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
                </div>
            `;
                $('#ruleContainer').append(newRule);
            });
        });
    </script>

</body>

</html>