<?php
session_start();
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM kelas WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert'] = "<div class='alert alert-success'>Kelas berhasil dihapus</div>";
    } else {
        $_SESSION['alert'] = "<div class='alert alert-danger'>Gagal menghapus: ".$conn->error."</div>";
    }
} else {
    $_SESSION['alert'] = "<div class='alert alert-warning'>Data tidak ditemukan!</div>";
}

header("Location: tampilKelas.php");
exit();
?>
