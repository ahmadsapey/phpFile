<?php
// session_start();
include "header.php";
// include "../koneksi.php";

$id = $_GET['id'];
$dosen = $conn->query("SELECT * FROM dosen WHERE id='$id'")->fetch_assoc();

if (isset($_POST['update'])) {
    $nid        = $_POST['nid'];
    $nama       = $_POST['nama'];
    $alamat     = $_POST['alamat'];
    $mataKuliah = $_POST['mataKuliah'];

    $sql = "UPDATE dosen SET nid='$nid', nama='$nama', alamat='$alamat', mataKuliah='$mataKuliah' WHERE id='$id'";

    if ($conn->query($sql)) {
        $_SESSION['alert'] = "<div class='alert alert-success'>Data berhasil diubah</div>";
    } else {
        $_SESSION['alert'] = "<div class='alert alert-danger'>Gagal mengubah: ".$conn->error."</div>";
    }

    header("Location: tampilDosen.php");
    exit();
}
?>

<div class="header"><h4>Ubah Data Dosen</h4></div>
<div class="content" style="margin-top: 70px;">
    <form method="POST" class="border p-4 rounded shadow">
        <div class="mb-3">
            <label>NID</label>
            <input type="text" name="nid" class="form-control" value="<?= $dosen['nid'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= $dosen['nama'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required><?= $dosen['alamat'] ?></textarea>
        </div>
        <div class="mb-3">
            <label>Mata Kuliah</label>
            <input type="text" name="mataKuliah" class="form-control" value="<?= $dosen['mataKuliah'] ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-warning">Update</button>
        <a href="tampilDosen.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php include "footer.php"; ?>
