<?php
include "header.php";
include "../koneksi.php";

if (isset($_POST['submit'])) {
    $nid        = $_POST['nid'];
    $nama       = $_POST['nama'];
    $alamat     = $_POST['alamat'];
    $mataKuliah = $_POST['mataKuliah'];

    $sql = "INSERT INTO dosen (nid, nama, alamat, mataKuliah) VALUES ('$nid', '$nama', '$alamat', '$mataKuliah')";

    if ($conn->query($sql)) {
        $_SESSION['alert'] = "<div class='alert alert-success'>Data berhasil ditambahkan</div>";
    } else {
        $_SESSION['alert'] = "<div class='alert alert-danger'>Gagal menambahkan: ".$conn->error."</div>";
    }

    header("Location: tampilDosen.php");
    exit();
}
?>

<div class="header"><h4>Tambah Dosen</h4></div>
<div class="content" style="margin-top: 70px;">
    <form method="POST" class="border p-4 rounded shadow">
        <div class="mb-3">
            <label>NID</label>
            <input type="text" name="nid" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Mata Kuliah</label>
            <input type="text" name="mataKuliah" class="form-control" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        <a href="tampilDosen.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php include "footer.php"; ?>
