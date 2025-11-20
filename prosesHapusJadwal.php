<?php
// Mulai session & koneksi database
session_start();
include "../koneksi.php";

// Ambil ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query hapus
    $sql = "DELETE FROM jadwal_kuliah WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                Jadwal berhasil dihapus!
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
            JADWAL tidak ditemukan!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}

// Tutup koneksi & kembali ke halaman jadwal
$conn->close();
header("Location: tampilJadwal.php");
exit();
?>
