<?php
include "koneksi.php";

$db = new Database();

if (isset($_GET['id'])) {
    $nisn = $_GET['id'];
    // Delete student by nisn
    $db->hapus_data_siswa($nisn);
    header("Location: datasiswa.php");
    exit();
} elseif (isset($_GET['idagama'])) {
    $idagama = $_GET['idagama'];
    // Delete agama by idagama
    $db->hapus_data_agama($idagama);
    header("Location: dataagama.php");
    exit();
} elseif (isset($_GET['kodejurusan'])) {
    $kodejurusan = $_GET['kodejurusan'];
    // Delete jurusan by kodejurusan
    $db->hapus_data_jurusan($kodejurusan);
    header("Location: datajurusan.php");
    exit();
} else {
    // If no valid id provided, redirect to home or datasiswa.php
    header("Location: index.php");
    exit();
} 


?>
