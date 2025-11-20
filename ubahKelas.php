<?php include "header.php"; include "../koneksi.php"; ?>

<?php
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM kelas WHERE id = $id")->fetch_assoc();

if (isset($_POST['update'])) {
    $nama = $_POST['nama_kelas'];
    $keterangan = $_POST['keterangan'];

    $sql = "UPDATE kelas SET nama_kelas = '$nama', keterangan = '$keterangan' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert'] = "<div class='alert alert-success'>Kelas berhasil diubah</div>";
        header("Location: tampilKelas.php");
        exit;
    } else {
        echo "Error: ".$conn->error;
    }
}
?>
<div class="header"><h4>Ubah Kelas</h4></div>

<div class="content" style="margin-top: 70px;">
    
    <form method="POST" class="border p-4 rounded shadow">
        <div class="mb-3">
            <label class="form-label">Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" value="<?= $data['nama_kelas'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control"><?= $data['keterangan'] ?></textarea>
        </div>
        <button type="submit" name="update" class="btn btn-warning">Update</button>
        <a href="tampilKelas.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include "footer.php"; ?>
