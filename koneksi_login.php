<?php
class Database {
    public $koneksi;

    public function __construct() {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "login_user";

        $this->koneksi = mysqli_connect($host, $user, $pass, $db);
        if (!$this->koneksi) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }
    }

    public function Users() {
        $query = "SELECT * FROM users";
        $result = mysqli_query($this->koneksi, $query);
        $data = [];
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    function hapus_data_users($iduser) {
        $query = "DELETE FROM users WHERE id='$iduser'";
        mysqli_query($this->koneksi, $query);
        if (mysqli_affected_rows($this->koneksi) > 0) {
            return true; // Delete successful
        } else {
            return false; // Delete failed
        }
    }


}
?>
