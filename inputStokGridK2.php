<?php
include 'auth.php';
checkRole(['admin']);
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
                        <li><a href="javascript:void(0);">Fungsi Keanggotaan Fuzzy Grid Partition (K=2)</a></li>
                        <li class="active">Variabel Stok</li>
                    </ol>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Tambah Fungsi Keanggotaan Fuzzy Grid Partition K2 - Variabel Stok
                            </h2>
                        </div>
                        <div class="body">
                            <form action="simpanVStokGridK2.php" method="POST">
                                <label for="namaFungsiMenurun" class="control-label">Nama Fungsi (Kurva Menurun):</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="namaFungsiMenurun" name="namaFungsiMenurun" class="form-control" required>
                                    </div>
                                </div>
                                
                                <label for="variabelFungsiMenurun" class="control-label">Ketik Variabel Fungsi (Kurva Menurun):</label>
                                <div class="row">
                                    <!-- Input untuk Huruf -->
                                    <div class="col-sm-3">
                                        <div class="form-line">
                                            <input type="text" id="fungsiHurufMenurun" name="fungsiHurufMenurun" class="form-control" placeholder="Huruf" maxlength="1" required>
                                        </div>
                                    </div>
                                    <!-- Input untuk Subscript (angka bawah) -->
                                    <div class="col-sm-3">
                                        <div class="form-line">
                                            <input type="number" id="fungsiSubscriptMenurun" name="fungsiSubscriptMenurun" class="form-control" placeholder="Subscript" required>
                                        </div>
                                    </div>
                                    <!-- Input untuk Superscript (angka atas) -->
                                    <div class="col-sm-3">
                                        <div class="form-line">
                                            <input type="number" id="fungsiSuperscriptMenurun" name="fungsiSuperscriptMenurun" class="form-control" placeholder="Superscript" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-line">
                                            <p id="previewFungsiMenurun" class="text-center">Variabel Fungsi akan tampil di sini</p>
                                        </div>
                                    </div>
                                </div>

                                <label for="kurvaMenurunBawah" class="control-label">Batas Bawah (Kurva Menurun):</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="kurvaMenurunBawah" name="kurvaMenurunBawah" class="form-control" required>
                                    </div>
                                </div>

                                <label for="kurvaMenurunAtas" class="control-label">Batas Atas (Kurva Menurun):</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="kurvaMenurunAtas" name="kurvaMenurunAtas" class="form-control" required>
                                    </div>
                                </div>

                                <h4 style="margin-bottom: 20px;">Kurva Segitiga</h4>
                                <div id="segitigaContainer"></div>
                                <div class="form-group">
                                    <div class="text-right">
                                        <button type="button" id="addSegitiga" class="btn btn-success">Tambah Segitiga</button>
                                    </div>
                                </div>

                                <label for="namaFungsiMenaik" class="control-label">Nama Fungsi (Kurva Menaik):</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="namaFungsiMenaik" name="namaFungsiMenaik" class="form-control" required>
                                    </div>
                                </div>

                                <label for="variabelFungsiMenaik" class="control-label">Ketik Variabel Fungsi (Kurva Menaik):</label>
                                <div class="row">
                                    <!-- Input untuk Huruf -->
                                    <div class="col-sm-3">
                                        <div class="form-line">
                                            <input type="text" id="fungsiHurufMenaik" name="fungsiHurufMenaik" class="form-control" placeholder="Huruf" maxlength="1" required>
                                        </div>
                                    </div>
                                    <!-- Input untuk Subscript (angka bawah) -->
                                    <div class="col-sm-3">
                                        <div class="form-line">
                                            <input type="number" id="fungsiSubscriptMenaik" name="fungsiSubscriptMenaik" class="form-control" placeholder="Subscript" required>
                                        </div>
                                    </div>
                                    <!-- Input untuk Superscript (angka atas) -->
                                    <div class="col-sm-3">
                                        <div class="form-line">
                                            <input type="number" id="fungsiSuperscriptMenaik" name="fungsiSuperscriptMenaik" class="form-control" placeholder="Superscript" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-line">
                                            <p id="previewFungsiMenaik" class="text-center">Variabel Fungsi akan tampil di sini</p>
                                        </div>
                                    </div>
                                </div>

                                <label for="kurvaMenaikBawah" class="control-label">Batas Bawah (Kurva Menaik):</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="kurvaMenaikBawah" name="kurvaMenaikBawah" class="form-control" required>
                                    </div>
                                </div>

                                <label for="kurvaMenaikAtas" class="control-label">Batas Atas (Kurva Menaik):</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="kurvaMenaikAtas" name="kurvaMenaikAtas" class="form-control" required>
                                    </div>
                                </div>

                                <input type="hidden" name="jenis" value="Stok">

                                <div class="form-group">
                                    <div class="text-right">
                                        <a class="btn bg-grey waves-effect" role="button" href="vStokGridK2.php">Kembali</a>
                                        <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
                                    </div>
                                </div>
                            </form>
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
        $(document).ready(function() {
            // Mencegah perubahan nilai saat scroll pada input type number
            $('input[type="number"]').on('wheel', function(e) {
                e.preventDefault();
            });

            let segitigaCount = 0;

            function updateNamaFungsiSegitiga(id) {
                const huruf = document.getElementById(`fungsiHurufSegitiga${id}`).value;
                const subscript = document.getElementById(`fungsiSubscriptSegitiga${id}`).value;
                const superscript = document.getElementById(`fungsiSuperscriptSegitiga${id}`).value;

                // Gabungkan menjadi format LaTeX
                const latexString = `${huruf}_{${subscript}}^{${superscript}}`;

                // Update MathJax preview
                document.getElementById(`previewFungsiSegitiga${id}`).innerHTML = `\\(${latexString}\\)`;
                MathJax.typeset(); // Render ulang MathJax agar LaTeX ditampilkan
            }

            function addSegitigaEventListeners(id) {
                document.getElementById(`fungsiHurufSegitiga${id}`).addEventListener('input', function() {
                    updateNamaFungsiSegitiga(id);
                });
                document.getElementById(`fungsiSubscriptSegitiga${id}`).addEventListener('input', function() {
                    updateNamaFungsiSegitiga(id);
                });
                document.getElementById(`fungsiSuperscriptSegitiga${id}`).addEventListener('input', function() {
                    updateNamaFungsiSegitiga(id);
                });
            }

            $('#addSegitiga').click(function() {
                segitigaCount++;
                $('#segitigaContainer').append(`
                    <div class="segitiga-form" id="segitiga${segitigaCount}">
                        <h5>Kurva Segitiga ${segitigaCount}</h5>
                        <label for="namaFungsiSegitiga${segitigaCount}" class="control-label">Nama Fungsi:</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="namaFungsiSegitiga${segitigaCount}" name="namaFungsiSegitiga[]" class="form-control" required>
                            </div>
                        </div>

                        <label for="variabelFungsiSegitiga${segitigaCount}" class="control-label">Ketik Variabel Fungsi (Segitiga ${segitigaCount}):</label>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-line">
                                    <input type="text" id="fungsiHurufSegitiga${segitigaCount}" name="fungsiHurufSegitiga[]" class="form-control" placeholder="Huruf" maxlength="1" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-line">
                                    <input type="number" id="fungsiSubscriptSegitiga${segitigaCount}" name="fungsiSubscriptSegitiga[]" class="form-control" placeholder="Subscript" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-line">
                                    <input type="number" id="fungsiSuperscriptSegitiga${segitigaCount}" name="fungsiSuperscriptSegitiga[]" class="form-control" placeholder="Superscript" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-line">
                                    <p id="previewFungsiSegitiga${segitigaCount}" class="text-center">Variabel Fungsi akan tampil di sini</p>
                                </div>
                            </div>
                        </div>

                        <label class="control-label">Titik Awal:</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="segitigaAwal[]" class="form-control" required>
                            </div>
                        </div>

                        <label class="control-label">Titik Puncak:</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="segitigaPuncak[]" class="form-control" required>
                            </div>
                        </div>

                        <label class="control-label">Titik Akhir:</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="segitigaAkhir[]" class="form-control" required>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger remove-segitiga" data-id="${segitigaCount}">Hapus Segitiga</button>
                        <hr>
                    </div>
                `);

                // Menambahkan event listener untuk input baru
                addFocusBlurEvent(`#segitiga${segitigaCount} input`);

                $(`#segitiga${segitigaCount} input[type="number"]`).on('wheel', function(e) {
                    e.preventDefault();
                });

                // Panggil fungsi untuk menambahkan event listener
                addSegitigaEventListeners(segitigaCount);
            });

            $(document).on('click', '.remove-segitiga', function() {
                const id = $(this).data('id');
                $(`#segitiga${id}`).remove();
            });

            function addFocusBlurEvent(selector) {
                $(selector).on('focus', function() {
                    $(this).closest('.form-line').addClass('focused');
                }).on('blur', function() {
                    if (!$(this).val()) {
                        $(this).closest('.form-line').removeClass('focused');
                    }
                });
            }
        });

        function updateNamaFungsiMenurun() {
            const huruf = document.getElementById('fungsiHurufMenurun').value;
            const subscript = document.getElementById('fungsiSubscriptMenurun').value;
            const superscript = document.getElementById('fungsiSuperscriptMenurun').value;

            // Gabungkan menjadi format LaTeX untuk MathJax (contoh: D_{1}^{6})
            const latexString = `${huruf}_{${subscript}}^{${superscript}}`;

            // Update MathJax preview
            document.getElementById('previewFungsiMenurun').innerHTML = `\\(${latexString}\\)`;
            MathJax.typeset(); // Render ulang MathJax agar LaTeX ditampilkan
        }

        // Event listener untuk setiap input perubahan
        document.getElementById('fungsiHurufMenurun').addEventListener('input', updateNamaFungsiMenurun);
        document.getElementById('fungsiSubscriptMenurun').addEventListener('input', updateNamaFungsiMenurun);
        document.getElementById('fungsiSuperscriptMenurun').addEventListener('input', updateNamaFungsiMenurun);

        function updateNamaFungsiMenaik() {
            const huruf = document.getElementById('fungsiHurufMenaik').value;
            const subscript = document.getElementById('fungsiSubscriptMenaik').value;
            const superscript = document.getElementById('fungsiSuperscriptMenaik').value;

            // Gabungkan menjadi format LaTeX untuk MathJax (contoh: D_{1}^{6})
            const latexString = `${huruf}_{${subscript}}^{${superscript}}`;

            // Update MathJax preview
            document.getElementById('previewFungsiMenaik').innerHTML = `\\(${latexString}\\)`;
            MathJax.typeset(); // Render ulang MathJax agar LaTeX ditampilkan
        }

        // Event listener untuk setiap input perubahan
        document.getElementById('fungsiHurufMenaik').addEventListener('input', updateNamaFungsiMenaik);
        document.getElementById('fungsiSubscriptMenaik').addEventListener('input', updateNamaFungsiMenaik);
        document.getElementById('fungsiSuperscriptMenaik').addEventListener('input', updateNamaFungsiMenaik);
    </script>
</body>

</html>