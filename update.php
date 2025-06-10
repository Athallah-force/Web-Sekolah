<?php
include "koneksi.php";
$db = new Database();
$koneksi = $db->connect();

// Ambil data dari form
$nisn = $_POST['nisn'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];
$jeniskelamin = $_POST['jeniskelamin'];
$alamat = $_POST['alamat'];
$agama = $_POST['agama'];
$nohp = $_POST['nohp'];

// Update data ke database
$query = "UPDATE siswa SET 
    nama='$nama',
    kelas='$kelas',
    kodejurusan='$jurusan',
    jeniskelamin='$jeniskelamin',
    alamat='$alamat',
    agama='$agama',
    nohp='$nohp'
    WHERE nisn='$nisn'";

$result = mysqli_query($koneksi, $query);

// Redirect kembali ke halaman data siswa
if ($result) {
    header("Location: datasiswa.php");
} else {
    echo "Gagal update data: " . mysqli_error($koneksi);
}
exit;





?>
