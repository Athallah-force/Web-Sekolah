<?php
include 'koneksi.php';

$db = new database(); // Membuat objek dari class database
$koneksi = $db->koneksi; // Ambil koneksi dari properti class

$nama = 'admin';
$password_plain = 'admin123';

// Cek apakah admin dengan nama tersebut sudah ada
$cek = mysqli_query($koneksi, "SELECT * FROM admin WHERE nama = '$nama'");
if (mysqli_num_rows($cek) > 0) {
    echo "<h3>Admin dengan nama '$nama' sudah ada.</h3>";
} else {
    $password_hash = password_hash($password_plain, PASSWORD_DEFAULT); 
    $insert = mysqli_query($koneksi, "INSERT INTO admin (nama, password) VALUES ('$nama', '$password_hash')");

    if ($insert) {
        echo "<h3>Admin berhasil ditambahkan!</h3>";
        echo "<p>Nama: <strong>$nama</strong></p>";
        echo "<p>Kata Sandi: <strong>$password_plain</strong></p>";
    } else {
        echo "<h3>Gagal menambahkan admin: " . mysqli_error($koneksi) . "</h3>";
    }
}
?>
