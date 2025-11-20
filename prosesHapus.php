<?php
// Database connection
session_start();
include "../koneksi.php";

// Get ID from request
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM mhs WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                Data berhasil dihapus!
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
    } else {
        $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                Error: ".$sql." - " . $conn->error . "
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
    }

} else {  
    $_SESSION['alert'] = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            MAHASISWA tidak ditemukan!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}

$conn->close();
header("Location: tampilDatamhs.php");
exit();

?>