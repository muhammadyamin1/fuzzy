<?php
include 'auth.php';
checkRole(['admin']);
include 'dbKoneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM fungsi_keanggotaan_gridk2 WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menangkap data dari form
    $namaFungsi = $_POST['nama_fungsi'];
    $batasBawah = $_POST['batas_bawah'];
    $tipe = $_POST['tipe']; // Ambil tipe dari form
    $batasTengah = ($tipe === 'Menurun' || $tipe === 'Menaik') ? null : $_POST['batas_tengah'];
    $batasAtas = $_POST['batas_atas'];

    // Update data
    $updateQuery = "UPDATE fungsi_keanggotaan_gridk2 SET 
                    nama_fungsi = '$namaFungsi', 
                    batas_bawah = '$batasBawah', 
                    batas_tengah = " . ($batasTengah === null ? 'NULL' : $batasTengah) . ", 
                    batas_atas = '$batasAtas' 
                    WHERE id = $id";

    mysqli_query($conn, $updateQuery);
    header("Location: vStokGridK2.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Fungsi Keanggotaan</title>
    <link href="https://fonts.googleapis/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2>Edit Fungsi Keanggotaan</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label>Nama Fungsi:</label>
                <input type="text" name="nama_fungsi" class="form-control" value="<?php echo $row['nama_fungsi']; ?>" required>
            </div>
            <div class="form-group">
                <label>Batas Bawah:</label>
                <input type="number" name="batas_bawah" class="form-control" value="<?php echo $row['batas_bawah']; ?>" required>
            </div>
            <div class="form-group">
                <label>Batas Tengah:</label>
                <input type="number" name="batas_tengah" class="form-control" value="<?php echo $row['batas_tengah']; ?>">
            </div>
            <div class="form-group">
                <label>Batas Atas:</label>
                <input type="number" name="batas_atas" class="form-control" value="<?php echo $row['batas_atas']; ?>" required>
            </div>
            <input type="hidden" name="tipe" value="<?php echo $row['tipe']; ?>"> <!-- Menyimpan tipe -->
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="vStokGridK2.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>