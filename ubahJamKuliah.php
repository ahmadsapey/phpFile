<?php include "header.php"; include "../koneksi.php"; ?>

<?php
$id = $_GET['id'];
$query = "SELECT * FROM jam_kuliah WHERE id = $id";
$data = $conn->query($query)->fetch_assoc();

if (isset($_POST['update'])) {
    $mulai = $_POST['jam_mulai'];
    $selesai = $_POST['jam_selesai'];

    $sql = "UPDATE jam_kuliah SET jam_mulai = '$mulai', jam_selesai = '$selesai' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert'] = "<div class='alert alert-success'>Jam kuliah berhasil diubah</div>";
        header("Location: tampilJamKuliah.php");
        exit;
    } else {
        echo "Error: ".$conn->error;
    }
}
?>
<div class="header"><h4>Ubah Jam Kuliah</h4></div>

<div class="content" style="margin-top: 70px;">
    
    <form method="POST" class="border p-4 rounded shadow">
        <div class="mb-3">
            <label class="form-label">Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" value="<?= $data['jam_mulai'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" value="<?= $data['jam_selesai'] ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-warning">Update</button>
        <a href="tampilJamKuliah.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include "footer.php"; ?>
