<?php
include 'auth.php';
checkRole(['admin']);
// sambungkan ke database
include 'dbKoneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menangkap data dari form
    $namaFungsiMenurun = $_POST['namaFungsiMenurun'];
    $kurvaMenurunBawah = $_POST['kurvaMenurunBawah'];
    $kurvaMenurunAtas = $_POST['kurvaMenurunAtas'];

    $namaFungsiSegitiga = $_POST['namaFungsiSegitiga']; // Array
    $segitigaAwal = $_POST['segitigaAwal']; // Array
    $segitigaPuncak = $_POST['segitigaPuncak']; // Array
    $segitigaAkhir = $_POST['segitigaAkhir']; // Array

    $namaFungsiMenaik = $_POST['namaFungsiMenaik'];
    $kurvaMenaikBawah = $_POST['kurvaMenaikBawah'];
    $kurvaMenaikAtas = $_POST['kurvaMenaikAtas'];

    $jenis = $_POST['jenis'];

    // Simpan kurva menurun
    $queryMenurun = "INSERT INTO fungsi_keanggotaan_tsukamoto (jenis, nama_fungsi, tipe, batas_bawah, batas_tengah, batas_atas) 
                     VALUES ('$jenis', '$namaFungsiMenurun', 'Menurun', $kurvaMenurunBawah, NULL, $kurvaMenurunAtas)";
    mysqli_query($conn, $queryMenurun);

    // Simpan kurva segitiga
    foreach ($namaFungsiSegitiga as $index => $namaFungsi) {
        $querySegitiga = "INSERT INTO fungsi_keanggotaan_tsukamoto (jenis, nama_fungsi, tipe, batas_bawah, batas_tengah, batas_atas) 
                          VALUES ('$jenis', '$namaFungsi', 'Segitiga', {$segitigaAwal[$index]}, {$segitigaPuncak[$index]}, {$segitigaAkhir[$index]})";
        mysqli_query($conn, $querySegitiga);
    }

    // Simpan kurva menaik
    $queryMenaik = "INSERT INTO fungsi_keanggotaan_tsukamoto (jenis, nama_fungsi, tipe, batas_bawah, batas_tengah, batas_atas) 
                    VALUES ('$jenis', '$namaFungsiMenaik', 'Menaik', $kurvaMenaikBawah, NULL, $kurvaMenaikAtas)";
    mysqli_query($conn, $queryMenaik);

    // Redirect atau tampilkan pesan sukses
    header("Location: vStokTsukamoto.php");
    exit();
}
?>