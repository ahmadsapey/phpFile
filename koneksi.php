<?php
// file koneksi antara web dengan db

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_mahasiwa";

// membuat koneksi
$conn = new mysqli($servername,$username,$password,$dbname);

// periksa koneksi
if($conn->connect_error){
    die("Koneksi Gagal: ".$conn->connect_error);
}
// echo "Koneksi Berhasil";

?>