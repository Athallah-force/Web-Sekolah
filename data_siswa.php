<?php
include "koneksi.php";
$db = new Database();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
</head>
<body>
    <h2>Data Siswa</h2>
    <table border="1">
        <tr>
            <th>No</th>
            <th>NISN</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Kode Jurusan</th>
            <th>Kelas</th>
            <th>Alamat</th>
            <th>Agama</th>
            <th>No HP</th>
            <th>Option</th>
        </tr>
        <?php
        $no = 1;
        foreach($db->tampil_data_siswa() as $row) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['nisn']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['jeniskelamin']; ?></td>
            <td><?php echo $row['kodejurusan']; ?></td>
            <td><?php echo $row['kelas']; ?></td>
            <td><?php echo $row['alamat']; ?></td>
            <td><?php echo $row['agama']; ?></td>
            <td><?php echo $row['nohp']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['nisn']; ?>">Edit</a> |
                <a href="hapus.php?id=<?php echo $row['nisn']; ?>">Hapus</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    <br>
    <a href="tambah_data.php">Tambah Data Siswa</a>
</body>
</html>
