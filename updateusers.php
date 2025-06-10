<?php
session_start();
include "koneksi_login.php";

$db = new Database();

// Ambil data dari form
$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

// Update data ke database
$query = "UPDATE users SET 
    username='$username',
    password='$password',
    role='$role'
    WHERE id='$id'";

$result = mysqli_query($db->koneksi, $query);

// Redirect kembali ke halaman data users
if ($result) {
    header("Location: users.php");
    exit();
} else {
    echo "Error: " . mysqli_error($db->koneksi);
}
?>
