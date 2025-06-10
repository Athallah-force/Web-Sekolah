<?php
include "koneksi.php";
$db = new Database();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Jurusan</title>
</head>
<body>
    <h2>Data Jurusan</h2>
    <table border="1">
        <tr>
            <th>No</th>
            <th>ID Jurusan</th>
            <th>Nama Jurusan</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no =1;
        foreach($db-> tampil_jurusan() as $x){
            ?>
           <tr>
               <td><?php echo $no++;?></td>
               <td><?php echo $x['kodejurusan'];?></td>
               <td><?php echo $x['namajurusan'];?></td>
               <td>
                   <a href="edit.php?kodejurusan=<?php echo $row['kodejurusan'];?>">Edit</a> | 
                   <a href="hapus.php?kodejurusan=<?php echo $row['kodejurusan'];?>">Hapus</a>
               </td>
           </tr>
           <?php
        }
        ?>
    </table>
    <br>
    <a href="tambah_jurusan.php">Tambah Data Jurusan</a>
    <a href="index.php">Kembali</a>
</body>
</html>
