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
    $fungsiHurufMenurun = $_POST['fungsiHurufMenurun'];
    $fungsiSubscriptMenurun = $_POST['fungsiSubscriptMenurun'];
    $fungsiSuperscriptMenurun = !empty($_POST['fungsiSuperscriptMenurun']) ? $_POST['fungsiSuperscriptMenurun'] : 'NULL'; // Menggunakan NULL jika tidak ada

    $namaFungsiSegitiga = $_POST['namaFungsiSegitiga']; // Array
    $segitigaAwal = $_POST['segitigaAwal']; // Array
    $segitigaPuncak = $_POST['segitigaPuncak']; // Array
    $segitigaAkhir = $_POST['segitigaAkhir']; // Array
    $fungsiHurufSegitiga = $_POST['fungsiHurufSegitiga']; // Array
    $fungsiSubscriptSegitiga = $_POST['fungsiSubscriptSegitiga']; // Array

    $namaFungsiMenaik = $_POST['namaFungsiMenaik'];
    $kurvaMenaikBawah = $_POST['kurvaMenaikBawah'];
    $kurvaMenaikAtas = $_POST['kurvaMenaikAtas'];
    $fungsiHurufMenaik = $_POST['fungsiHurufMenaik'];
    $fungsiSubscriptMenaik = $_POST['fungsiSubscriptMenaik'];
    $fungsiSuperscriptMenaik = !empty($_POST['fungsiSuperscriptMenaik']) ? $_POST['fungsiSuperscriptMenaik'] : 'NULL'; // Menggunakan NULL jika tidak ada

    $jenis = $_POST['jenis'];

    // Simpan kurva menurun
    $queryMenurun = "INSERT INTO fungsi_keanggotaan_tsukamoto (jenis, nama_fungsi, huruf, subscript, superscript, tipe, batas_bawah, batas_tengah, batas_atas) 
                     VALUES ('$jenis', '$namaFungsiMenurun', '$fungsiHurufMenurun', $fungsiSubscriptMenurun, $fungsiSuperscriptMenurun, 'Menurun', $kurvaMenurunBawah, NULL, $kurvaMenurunAtas)";
    mysqli_query($conn, $queryMenurun);

    // Simpan kurva segitiga
    foreach ($namaFungsiSegitiga as $index => $namaFungsi) {
        $fungsiSuperscriptSegitiga = !empty($_POST['fungsiSuperscriptSegitiga'][$index]) ? $_POST['fungsiSuperscriptSegitiga'][$index] : 'NULL'; // Menggunakan NULL jika tidak ada

        $querySegitiga = "INSERT INTO fungsi_keanggotaan_tsukamoto (jenis, nama_fungsi, huruf, subscript, superscript, tipe, batas_bawah, batas_tengah, batas_atas) 
                      VALUES ('$jenis', '$namaFungsi', '{$fungsiHurufSegitiga[$index]}', {$fungsiSubscriptSegitiga[$index]}, $fungsiSuperscriptSegitiga, 'Segitiga', {$segitigaAwal[$index]}, {$segitigaPuncak[$index]}, {$segitigaAkhir[$index]})";
        mysqli_query($conn, $querySegitiga);
    }

    // Simpan kurva menaik
    $queryMenaik = "INSERT INTO fungsi_keanggotaan_tsukamoto (jenis, nama_fungsi, huruf, subscript, superscript, tipe, batas_bawah, batas_tengah, batas_atas) 
                    VALUES ('$jenis', '$namaFungsiMenaik', '$fungsiHurufMenaik', $fungsiSubscriptMenaik, $fungsiSuperscriptMenaik, 'Menaik', $kurvaMenaikBawah, NULL, $kurvaMenaikAtas)";
    mysqli_query($conn, $queryMenaik);

    // Redirect atau tampilkan pesan sukses
    header("Location: vProduksiTsukamoto.php");
    exit();
}
?>