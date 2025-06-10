<?php
include "koneksi.php";
$db = new Database();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Agama</title>
</head>
<body>
    <h2>Data Agama</h2>
    <table border="1">
        <tr>
            <th>No</th>
            <th>ID Agama</th>
            <th>Nama Agama</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no =1;
        foreach($db-> tampil_agama() as $x){
            ?>
           <tr>
               <td><?php echo $no++;?></td>
               <td><?php echo $x['idagama'];?></td>
               <td><?php echo $x['namaagama'];?></td>
               <td>
                   <a href="edit.php?idagama=<?php echo $x['idagama'];?>">Edit</a> | 
                   <a href="hapus.php?idagama=<?php echo $x['idagama'];?>">Hapus</a>
               </td>
           </tr>
           <?php
        }
        ?>
    </table>
    <br>
    <a href="tambah_agama.php">Tambah Data agama>
    <a href="index.php">Kembali</a>
</body>
</html>
