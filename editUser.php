<?php
include 'auth.php';
checkRole(['admin', 'user']);
require 'dbKoneksi.php';

$id = intval($_GET['id']); // Sanitasi input
$currentUser = $_SESSION['user_id'];
$currentUserRole = $_SESSION['role'];
$isSelf = ($currentUser == $id); // Cek apakah yang mengakses adalah diri sendiri
$isSuperAdmin = ($currentUser == 1); // Cek apakah yang mengakses adalah admin utama

// Jika admin utama (id 1) sedang diedit oleh orang lain, blok aksesnya
if ($id == 1 && !$isSelf && !$isSuperAdmin) {
    $_SESSION['error'] = "Anda tidak diizinkan mengubah data admin utama.";
    header('Location: user.php');
    exit();
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = htmlspecialchars($_POST['nama']); // Sanitasi input

    // Jika yang mengakses adalah diri sendiri atau super admin, ambil username dari input form
    if ($isSelf || $isSuperAdmin) {
        $username = htmlspecialchars($_POST['username']); // Sanitasi input
    } else {
        $username = $user['username']; // Gunakan username yang lama
    }

    // Cek apakah username baru sudah ada di database (selain user yang sedang diedit)
    if ($username !== $user['username']) {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ? AND id != ?");
        $stmt->bind_param("si", $username, $id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            $_SESSION['error'] = "Username sudah digunakan oleh pengguna lain.";
            header('Location: editUser.php?id=' . $id);
            exit();
        }
    }

    // Jika role diubah oleh admin atau super admin, ambil dari input form
    if ($currentUserRole === 'admin' || $isSuperAdmin) {
        $role = htmlspecialchars($_POST['role']); // Sanitasi input
    } else {
        $role = $user['role']; // Gunakan role yang lama
    }

    // Persiapkan pernyataan SQL berdasarkan apakah password diubah atau tidak
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE users SET username = ?, nama = ?, password = ?, role = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $username, $nama, $password, $role, $id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET username = ?, nama = ?, role = ? WHERE id = ?");
        $stmt->bind_param("sssi", $username, $nama, $role, $id);
    }

    if ($stmt->execute()) {
        $_SESSION['success'] = "User berhasil diedit.";
    } else {
        $_SESSION['error'] = "Gagal mengedit user.";
    }

    $stmt->close();

    // Redirect berdasarkan siapa yang mengakses
    if ($isSelf) {
        header('Location: editUser.php?id=' . $id);
    } else {
        header('Location: users.php');
    }
    exit();
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
                <h2>KELOLA USERS</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <?php if (isset($_SESSION['error'])) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['success'])) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Edit User
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <form id="userForm" action="editUser.php?id=<?= $id ?>" method="POST">
                                    <div class="col-6 col-md-6">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" id="name" class="form-control" value="<?= htmlspecialchars($user['nama']) ?>" autocomplete="off" required style="margin-bottom: 15px;">

                                        <?php if ($isSelf || $isSuperAdmin): ?>
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" autocomplete="off" required style="margin-bottom: 15px;">
                                            <span id="usernameError" style="color: red; display: none; margin-bottom: 15px;">Username sudah digunakan.</span>
                                        <?php endif; ?>

                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" style="margin-bottom: 15px;">

                                        <div style="margin-top: 10px; margin-bottom: 15px;">
                                            <input type="checkbox" id="tampilPass" class="filled-in" onclick="togglePassword()">
                                            <label for="tampilPass">Tampilkan Password</label>
                                        </div>
                                        <?php if ($currentUserRole === 'admin' || $isSuperAdmin): ?>
                                            <label for="role">Role</label>
                                            <select name="role" id="role" class="form-control">
                                                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                                                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                            </select>
                                        <?php endif; ?>
                                    </div>
                            </div>
                            <?php if ($currentUserRole !== 'user'): ?>
                                <a href="users.php" class="btn bg-blue-grey">Kembali</a>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-primary">Simpan</button>
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
        function togglePassword() {
            var passwordField = document.getElementById("password");
            passwordField.type = (passwordField.type === "password") ? "text" : "password";
        }
    </script>

</body>

</html>