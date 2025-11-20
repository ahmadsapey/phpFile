<?php include "header.php"; include "../koneksi.php"; ?>

<?php
if (isset($_POST['submit'])) {
    $nama = $_POST['nama_ruangan'];
    $kapasitas = $_POST['kapasitas'];

    $sql = "INSERT INTO ruangan (nama_ruangan, kapasitas) VALUES ('$nama', '$kapasitas')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert'] = "<div class='alert alert-success'>Ruangan berhasil ditambahkan</div>";
        header("Location: tampilRuangan.php");
        exit;
    } else {
        echo "Error: ".$conn->error;
    }
}
?>

<div class="content" style="margin-top: 70px;">
    <h4>Tambah Ruangan</h4>
    <form method="POST" class="border p-4 rounded shadow">
        <div class="mb-3">
            <label class="form-label">Nama Ruangan</label>
            <input type="text" name="nama_ruangan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kapasitas</label>
            <input type="number" name="kapasitas" class="form-control" min="1" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        <a href="tampilRuangan.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include "footer.php"; ?>
