<?php 
include "header.php"; 

if (isset($_POST['submit'])) {
    $nama = $_POST['namaMenu'];
    $url = $_POST['url'];
    $parent = $_POST['parent_id'] ?: "NULL";

    $sql = "INSERT INTO menu (namaMenu, url, parent_id) VALUES ('$nama', '$url', $parent)";
    if ($conn->query($sql)) {
        $_SESSION['alert'] = "<div class='alert alert-success'>Menu berhasil ditambahkan</div>";
    } else {
        $_SESSION['alert'] = "<div class='alert alert-danger'>Error: ".$conn->error."</div>";
    }

    $conn->close();
    header("Location: tampilMenu.php");
    exit();
}
?>

<div class="header">
    <h4>Tambah Menu</h4>
</div>

<div class="content" style="margin-top: 70px;">
    <form method="POST" class="p-4 border rounded shadow">
        <div class="mb-3">
            <label>Nama Menu</label>
            <input type="text" name="namaMenu" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>URL</label>
            <input type="text" name="url" class="form-control">
        </div>
        <div class="mb-3">
            <label>Parent Menu</label>
            <select name="parent_id" class="form-control">
                <option value="">- Tidak Ada -</option>
                <?php
                    $parentMenu = $conn->query("SELECT id, namaMenu FROM menu WHERE parent_id IS NULL");
                    while ($pm = $parentMenu->fetch_assoc()) {
                        echo "<option value='{$pm['id']}'>{$pm['namaMenu']}</option>";
                    }
                ?>
            </select>
        </div>
        <button name="submit" class="btn btn-primary">Simpan</button>
        <a href="tampilMenu.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include "footer.php"; ?>