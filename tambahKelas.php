<?php include "header.php"; include "../koneksi.php"; ?>

<?php
if (isset($_POST['submit'])) {
    $nama = $_POST['nama_kelas'];
    $keterangan = $_POST['keterangan'];

    $sql = "INSERT INTO kelas (nama_kelas, keterangan) VALUES ('$nama', '$keterangan')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert'] = "<div class='alert alert-success'>Kelas berhasil ditambahkan</div>";
        header("Location: tampilKelas.php");
        exit;
    } else {
        echo "Error: ".$conn->error;
    }
}
?>
<div class="header">
    <h4>Tambah Kelas</h4>
</div>
<div class="content" style="margin-top: 70px;">
    <form method="POST" class="border p-4 rounded shadow">
        <div class="mb-3">
            <label class="form-label">Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        <a href="tampilKelas.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include "footer.php"; ?>
