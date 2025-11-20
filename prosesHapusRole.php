<?php
session_start();
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM role WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                Role berhasil dihapus!
                                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                              </div>";
    } else {
        $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                Error: ".$sql." - " . $conn->error . "
                                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                              </div>";
    }
} else {
    $_SESSION['alert'] = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            ID Role tidak ditemukan!
                            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                          </div>";
}

$conn->close();
header("Location: tampilRole.php");
exit();
