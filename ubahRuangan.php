<?php include "header.php"; include "../koneksi.php"; ?>

<?php
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM ruangan WHERE id = $id")->fetch_assoc();

if (isset($_POST['update'])) {
    $nama = $_POST['nama_ruangan'];
    $kapasitas = $_POST['kapasitas'];

    $sql = "UPDATE ruangan SET nama_ruangan = '$nama', kapasitas = '$kapasitas' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert'] = "<div class='alert alert-success'>Ruangan berhasil diubah</div>";
        header("Location: tampilRuangan.php");
        exit;
    } else {
        echo "Error: ".$conn->error;
    }
}
?>

<div class="content" style="margin-top: 70px;">
    <h4>Ubah Ruangan</h4>
    <form method="POST" class="border p-4 rounded shadow">
        <div class="mb-3">
            <label class="form-label">Nama Ruangan</label>
            <input type="text" name="nama_ruangan" class="form-control" value="<?= $data['nama_ruangan'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kapasitas</label>
            <input type="number" name="kapasitas" class="form-control" value="<?= $data['kapasitas'] ?>" min="1" required>
        </div>
        <button type="submit" name="update" class="btn btn-warning">Update</button>
        <a href="tampilRuangan.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include "footer.php"; ?>
