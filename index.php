﻿<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Masuk | Fuzzy Tsukamoto - Fuzzy Grid Partition</title>
    <!-- Favicon -->
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

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        .login-page .judul {
            padding: 10px;
            border-radius: 12px;
        }
    </style>
</head>

<body class="login-page">
    <?php
    session_start();
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger mt-4 mb-3">' . htmlspecialchars($_SESSION['error']) . '</div>';
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success mt-4 mb-3">' . htmlspecialchars($_SESSION['success']) . '</div>';
        unset($_SESSION['success']);
    }
    $username = isset($_SESSION['input_username']) ? htmlspecialchars($_SESSION['input_username']) : '';
    if (isset($_SESSION['input_username'])) {
        unset($_SESSION['input_username']);
    }
    ?>
    <div class="login-box">
        <div class="logo judul bg-pink">
            <a href="javascript:void(0);">Sistem Optimalisasi Produksi<br>Berdasarkan Permintaan dan Stok<br><b>Menuju Ekonomi Digital dengan<br>Pendekatan Fuzzy Grid Partition</b></a>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="prosesLogin.php" autocomplete="off">
                    <div class="msg">Login untuk memulai</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $username; ?>" autocomplete="off" required autofocus aria-label="Username">
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="new-password" required aria-label="Password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="tampilPass" id="tampilPass" class="filled-in chk-col-pink" onclick="togglePassword()">
                            <label for="tampilPass">Tampilkan Password</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>

    <script>
        // Toggle Password Form Login
        function togglePassword() {
            var passwordField = document.getElementById("password");
            passwordField.type = (passwordField.type === "password") ? "text" : "password";
        }
    </script>
</body>

</html>