<?php
session_start();
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM jam_kuliah WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert'] = "<div class='alert alert-success'>Jam kuliah berhasil dihapus</div>";
    } else {
        $_SESSION['alert'] = "<div class='alert alert-danger'>Gagal menghapus: ".$conn->error."</div>";
    }
} else {
    $_SESSION['alert'] = "<div class='alert alert-warning'>Data tidak ditemukan!</div>";
}

header("Location: tampilJamKuliah.php");
exit();
?>
