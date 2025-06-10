<?php
class database{
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "sekolah";
    var $koneksi;

    function __construct() {
        try {
            // Mencoba koneksi ke MySQL
            $this->koneksi = mysqli_connect($this->host, $this->username, $this->password);
            
            if(!$this->koneksi){
                throw new Exception("Koneksi ke MySQL gagal: " . mysqli_connect_error());
            }
            
            // Mencoba memilih database
            $cekdb = mysqli_select_db($this->koneksi, $this->database);
            if (!$cekdb) {
                throw new Exception("Database '$this->database' tidak ditemukan: " . mysqli_error($this->koneksi));
            }
            
        
            
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    function tampil_data_siswa() {
        try {
            $data = mysqli_query($this->koneksi,"select * from siswa");
            if(!$data) {
                throw new Exception("Error query: " . mysqli_error($this->koneksi));
            }
            
            $hasil = array();
            while ($row = mysqli_fetch_array($data)) {
                $hasil[] = $row;
            }
            return $hasil;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    function tampil_jurusan($limit = null, $offset = null) {
        try {
            $query = "select * from jurusan";
            if ($limit !== null && $offset !== null) {
                $query .= " LIMIT $limit OFFSET $offset";
            }
            $data = mysqli_query($this->koneksi, $query);
            if(!$data) {
                throw new Exception("Error query: " . mysqli_error($this->koneksi));
            }
            
            $hasil = array();
            while ($row = mysqli_fetch_array($data)) {
                $hasil[] = $row;
            }
            return $hasil;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    function tampil_agama($limit = null, $offset = null) {
        try {
            $query = "select * from agama";
            if ($limit !== null && $offset !== null) {
                $query .= " LIMIT $limit OFFSET $offset";
            }
            $data = mysqli_query($this->koneksi, $query);
            if(!$data) {
                throw new Exception("Error query: " . mysqli_error($this->koneksi));
            }
            
            $hasil = array();
            while ($row = mysqli_fetch_array($data)) {
                $hasil[] = $row;
            }
            return $hasil;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    function tampil_relasi($limit = null, $offset = null) {
    try {
        $query = "SELECT 
            s.idsiswa,
            s.kelas,
            s.kodejurusan,
            CASE
                WHEN s.jeniskelamin = 'L' THEN 'Laki-Laki'
                WHEN s.jeniskelamin = 'P' THEN 'Perempuan'
                ELSE 'Lainnya'
            END as jeniskelamin,
            s.jeniskelamin as jeniskelamin_raw,
            s.nisn,
            s.nama,
            j.namajurusan,
            s.alamat,
            a.namaagama as agama,
            s.agama as agama_id,
            s.nohp
            FROM siswa s
            JOIN jurusan j ON s.kodejurusan = j.kodejurusan
            JOIN agama a ON s.agama = a.idagama";

        if ($limit !== null && $offset !== null) {
            $query .= " LIMIT $limit OFFSET $offset";
        }

        $data = mysqli_query($this->koneksi, $query);

        if(!$data) {
            throw new Exception("Error query: " . mysqli_error($this->koneksi));
        }
            
        $hasil = array();
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}

    function tambah_data($nisn, $nama, $jeniskelamin, $kodejurusan, $kelas, $alamat, $agama, $nohp) {
    try {
        $query = "INSERT INTO siswa (nisn, nama, jeniskelamin, kodejurusan, kelas, alamat, agama, nohp) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                  
        $stmt = mysqli_prepare($this->koneksi, $query);
        
        if (!$stmt) {
            throw new Exception("Error dalam prepared statement: " . mysqli_error($this->koneksi));
        }
        
        mysqli_stmt_bind_param($stmt, "ssssssss", 
            $nisn, $nama, $jeniskelamin, $kodejurusan, $kelas, $alamat, $agama, $nohp);
            
        $result = mysqli_stmt_execute($stmt);
        
        if (!$result) {
            throw new Exception("Error saat menambahkan data: " . mysqli_error($this->koneksi));
        }
        
        mysqli_stmt_close($stmt);
        return true;
        
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
        return false;
    }
}


function tambah_agama($namaagama) {
    try {
        $query = "INSERT INTO agama (namaagama) VALUES (?)";
        $stmt = mysqli_prepare($this->koneksi, $query);
        
        if (!$stmt) {
            throw new Exception("Error dalam prepared statement: " . mysqli_error($this->koneksi));
        }
        
        mysqli_stmt_bind_param($stmt, "s", $namaagama);
        $result = mysqli_stmt_execute($stmt);
        
        if (!$result) {
            throw new Exception("Error saat menambahkan data: " . mysqli_error($this->koneksi));
        }
        
        mysqli_stmt_close($stmt);
        return true;
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
        return false;
    }
}


function tambah_jurusan($namajurusan) {
    try {
        $query = "INSERT INTO jurusan (namajurusan) VALUES (?)";
        $stmt = mysqli_prepare($this->koneksi, $query);
        
        if (!$stmt) {
            throw new Exception("Error dalam prepared statement: " . mysqli_error($this->koneksi));
        }
        
        mysqli_stmt_bind_param($stmt, "s", $namajurusan);
        $result = mysqli_stmt_execute($stmt);
        
        if (!$result) {
            throw new Exception("Error saat menambah data: " . mysqli_error($this->koneksi));
        }
        
        return true;
    } catch (Exception $e) {
        throw $e;
    }
}


public function update_data_siswa($nisn, $nama, $jeniskelamin, $kelas, $alamat, $nohp, $kodejurusan, $idagama) {
    // Validasi: Pastikan semua ID tidak kosong
    if (empty($kodejurusan) || empty($idagama)) {
        throw new Exception("Kode jurusan atau ID agama tidak boleh kosong.");
    }

    // Update langsung pakai ID
    $query = "UPDATE siswa SET 
        nama = '$nama',
        jeniskelamin = '$jeniskelamin',
        kelas = '$kelas',
        alamat = '$alamat',
        nohp = '$nohp',
        kodejurusan = $kodejurusan,
        agama = $idagama
        WHERE nisn = '$nisn'";
    
    if (!mysqli_query($this->koneksi, $query)) {
        throw new Exception("Gagal update: " . mysqli_error($this->koneksi));
    }
}



    function hapus_data_siswa($nisn) {
        $query = "DELETE FROM siswa WHERE nisn='$nisn'";
        mysqli_query($this->koneksi, $query);
        if (mysqli_affected_rows($this->koneksi) > 0) {
            return true; // Delete successful
        } else {
            return false; // Delete failed
        }
    }


    function update_data_agama($idagama, $namaagama) {
        $query = "UPDATE agama SET namaagama='$namaagama' WHERE idagama='$idagama'";
        mysqli_query($this->koneksi, $query);
        if (mysqli_affected_rows($this->koneksi) > 0) {
            return true; // Update successful
        } else {
            return false; // Update failed
        }       
    }

    function update_data_jurusan($kodejurusan, $namajurusan) {
        $query = "UPDATE jurusan SET namajurusan='$namajurusan' WHERE kodejurusan='$kodejurusan'";
        mysqli_query($this->koneksi, $query);
        if (mysqli_affected_rows($this->koneksi) > 0) {
            return true; // Update successful
        } else {
            return false; // Update failed
        }       
    }

    function hapus_data_agama($idagama) {
        $query = "DELETE FROM agama WHERE idagama='$idagama'";
        mysqli_query($this->koneksi, $query);
        if (mysqli_affected_rows($this->koneksi) > 0) {
            return true; // Delete successful
        } else {
            return false; // Delete failed
        }
    }

    function hapus_data_jurusan($kodejurusan) {
        $query = "DELETE FROM jurusan WHERE kodejurusan='$kodejurusan'";
        mysqli_query($this->koneksi, $query);
        if (mysqli_affected_rows($this->koneksi) > 0) {
            return true; // Delete successful
        } else {
            return false; // Delete failed
        }
    }



}


