<?php
include 'auth.php';
include 'dbKoneksi.php';

// Ambil data dari tabel
$query = "SELECT * FROM fungsi_keanggotaan_gridk3 WHERE jenis='Produksi' ORDER BY batas_atas ASC;";
$result = mysqli_query($conn, $query);

$Exists = mysqli_num_rows($result) > 0;
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
                        <li><a href="javascript:void(0);">Fungsi Keanggotaan Fuzzy Grid Partition (K=3)</a></li>
                        <li class="active">Variabel Produksi</li>
                    </ol>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Fungsi Keanggotaan Fuzzy Grid Partition K3 - Variabel Produksi
                            </h2>
                        </div>
                        <div class="body">
                            <?php if (!$Exists): ?>
                                <a class="btn btn-primary" href="inputProduksiGridK3.php" role="button">Tambah Fungsi Keanggotaan</a>
                            <?php else: ?>
                                <button class="btn btn-primary" disabled>Tambah Fungsi Keanggotaan (Sudah ada data)</button>
                            <?php endif; ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Jenis</th>
                                        <th>Nama Fungsi</th>
                                        <th>Tipe</th>
                                        <th>Batas Bawah</th>
                                        <th>Batas Tengah</th>
                                        <th>Batas Atas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $nomor = 1;
                                    while ($row = mysqli_fetch_assoc($result)) :
                                    ?>
                                        <tr>
                                            <td><?php echo $nomor++ . '.'; ?></td>
                                            <td><?php echo $row['jenis']; ?></td>
                                            <td><?php echo $row['nama_fungsi']; ?></td>
                                            <td><?php echo $row['tipe']; ?></td>
                                            <td><?php echo $row['batas_bawah']; ?></td>
                                            <td><?php echo $row['batas_tengah']; ?></td>
                                            <td><?php echo $row['batas_atas']; ?></td>
                                            <td>
                                                <a href="editVProduksiGridK3.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                                                <a href="hapusVProduksiGridK3.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                            <canvas id="membershipChart" width="400" height="200"></canvas>
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
        fetch('getVProduksiGridK3.php')
            .then(response => response.json())
            .then(membershipData => {
                var datasets = [];
                membershipData.forEach(function(fungsi) {
                    var dataPoints = [];
                    if (fungsi.tipe === 'Menurun') {
                        dataPoints = [{
                                x: fungsi.batas_bawah,
                                y: 1
                            },
                            {
                                x: fungsi.batas_tengah || fungsi.batas_atas,
                                y: 0
                            },
                            {
                                x: fungsi.batas_atas,
                                y: 0
                            }
                        ];
                    } else if (fungsi.tipe === 'Menaik') {
                        dataPoints = [{
                                x: fungsi.batas_bawah,
                                y: 0
                            },
                            {
                                x: fungsi.batas_tengah || fungsi.batas_atas,
                                y: 1
                            },
                            {
                                x: fungsi.batas_atas,
                                y: 1
                            }
                        ];
                    } else { // Segitiga
                        dataPoints = [{
                                x: fungsi.batas_bawah,
                                y: 0
                            },
                            {
                                x: fungsi.batas_tengah,
                                y: 1
                            },
                            {
                                x: fungsi.batas_atas,
                                y: 0
                            }
                        ];
                    }

                    datasets.push({
                        label: fungsi.nama_fungsi,
                        data: dataPoints,
                        fill: false,
                        borderColor: getRandomColor(),
                        borderWidth: 2,
                        lineTension: 0.1,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    });
                });

                var ctx = document.getElementById('membershipChart').getContext('2d');
                var membershipChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: membershipData.map(f => f.nama_fungsi),
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        scales: {
                            xAxes: [{
                                type: 'linear',
                                position: 'bottom',
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Nilai'
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    max: 1,
                                    min: 0,
                                    stepSize: 0.1
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Keanggotaan'
                                }
                            }]
                        },
                        legend: {
                            display: true
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));

        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>

</body>

</html>