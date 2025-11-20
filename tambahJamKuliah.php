<?php include "header.php"; include "../koneksi.php"; ?>

<?php
if (isset($_POST['submit'])) {
    $mulai = $_POST['jam_mulai'];
    $selesai = $_POST['jam_selesai'];

    $sql = "INSERT INTO jam_kuliah (jam_mulai, jam_selesai) VALUES ('$mulai', '$selesai')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert'] = "<div class='alert alert-success'>Jam kuliah berhasil ditambahkan</div>";
        header("Location: tampilJamKuliah.php");
        exit;
    } else {
        echo "Error: ".$conn->error;
    }
}
?>
<div class="header">
<h4>Tambah Jam Kuliah</h4>
</div>
<div class="content" style="margin-top: 70px;">
    <form method="POST" class="border p-4 rounded shadow">
        <div class="mb-3">
            <label class="form-label">Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        <a href="tampilJamKuliah.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include "footer.php"; ?>
