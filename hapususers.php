<?php
include "koneksi_login.php";

$db = new Database();

if (isset($_GET['iduser'])) {
    $iduser = $_GET['iduser'];
    // Delete user by iduser
    $db->hapus_data_users($iduser);
    header("Location: users.php");
    exit();
}
?>
