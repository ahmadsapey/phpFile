<?php
session_start();
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sqlRbac=  "DELETE FROM rbac WHERE menu_id = '$id'";
    $sql = "DELETE FROM menu WHERE id='$id'";
    if ($conn->query($sql) && $conn->query($sqlRbac)) {
        $_SESSION['alert'] = "<div class='alert alert-success'>Menu berhasil dihapus</div>";
    } else {
        $_SESSION['alert'] = "<div class='alert alert-danger'>Gagal menghapus: ".$conn->error."</div>";
    }
} else {
    $_SESSION['alert'] = "<div class='alert alert-warning'>ID tidak ditemukan</div>";
}

header("Location: tampilMenu.php");
exit();
