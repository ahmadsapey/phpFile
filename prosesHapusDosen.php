<?php
session_start();
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM dosen WHERE id='$id'";

    if ($conn->query($sql)) {
        $_SESSION['alert'] = "<div class='alert alert-success'>Data dosen berhasil dihapus</div>";
    } else {
        $_SESSION['alert'] = "<div class='alert alert-danger'>Gagal menghapus: ".$conn->error."</div>";
    }
} else {
    $_SESSION['alert'] = "<div class='alert alert-warning'>ID tidak ditemukan</div>";
}

header("Location: tampilDosen.php");
exit();
