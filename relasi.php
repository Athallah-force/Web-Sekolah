<?php
include "koneksi.php";
$db = new Database();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relasi</title>
</head>
<body>
    <h2>Data Relasi</h2>
    <table border="1">
        <tr>
            <th>No</th>
            <th>NISN</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Jenis kelamin</th>
            <th>Alamat</th>
            <th>Agama</th>
            <th>No HP</th>
            <th>O  ption</th>
        </tr>
        <?php
        $no = 1;
        foreach ($db-> tampil_relasi("") as $x){
        ?>
        <tr>
            <td><?php echo $no++;?></td>
            <td><?php echo $x['nisn'];?></td>
            <td><?php echo $x['nama'];?></td>
            <td><?php echo $x['kelas'];?></td>
            <td><?php echo $x['kodejurusan'];?></td>
            <td><?php echo $x['jeniskelamin'];?></td>
            <td><?php echo $x['alamat'];?></td>
            <td><?php echo $x['agama'];?></td>
            <td><?php echo $x['nohp'];?></td>
            <td>
                <a href="edit.php?id=<?php echo $x['nisn'];?>">Edit</a> |
                <a href="hapus.php?id=<?php echo $x['nisn'];?>" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</a>
            </td>    
        </tr>
         <?php
        } ?>
        </table>
        <a href="tambah.php">Tambah Data</a>
        <br><br>
</body>
</html>