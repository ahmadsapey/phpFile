<?php
include "header.php";
include "../koneksi.php";

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];

    $sql = "INSERT INTO matkul (nama, deskripsi) VALUES ('$nama', '$deskripsi')";

    if ($conn->query($sql)) {
        $_SESSION['alert'] = "<div class='alert alert-success'>Data berhasil ditambahkan</div>";
    } else {
        $_SESSION['alert'] = "<div class='alert alert-danger'>Gagal menambahkan: ".$conn->error."</div>";
    }

    header("Location: tampilMatkul.php");
    exit();
}
?>

<div class="header"><h4>Tambah Mata Kuliah</h4></div>
<div class="content" style="margin-top: 70px;">
    <form method="POST" class="border p-4 rounded shadow">
        <div class="mb-3">
            <label>Nama Mata Kuliah</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        <a href="tampilMatkul.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php include "footer.php"; ?>
