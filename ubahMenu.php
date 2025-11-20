<?php 
include "header.php"; 

$id = $_GET['id'];
$menu = $conn->query("SELECT * FROM menu WHERE id = '$id'")->fetch_assoc();

if (isset($_POST['update'])) {
    $nama = $_POST['namaMenu'];
    $url = $_POST['url'];
    $parent = $_POST['parent_id'] ?: "NULL";

    $sql = "UPDATE menu SET namaMenu='$nama', url='$url', parent_id=$parent WHERE id='$id'";
    if ($conn->query($sql)) {
        $_SESSION['alert'] = "<div class='alert alert-success'>Menu berhasil diubah</div>";
    } else {
        $_SESSION['alert'] = "<div class='alert alert-danger'>Gagal: ".$conn->error."</div>";
    }

    header("Location: tampilMenu.php");
    exit();
}
?>

<div class="header"><h4>Ubah Menu</h4></div>

<div class="content" style="margin-top: 70px;">
    <form method="POST" class="p-4 border rounded shadow">
        <div class="mb-3">
            <label>Nama Menu</label>
            <input type="text" name="namaMenu" value="<?= $menu['namaMenu'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>URL</label>
            <input type="text" name="url" value="<?= $menu['url'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Parent Menu</label>
            <select name="parent_id" class="form-control">
                <option value="">- Tidak Ada -</option>
                <?php
                    $parents = $conn->query("SELECT id, namaMenu FROM menu WHERE parent_id IS NULL AND id != '$id'");
                    while ($pm = $parents->fetch_assoc()) {
                        $selected = $pm['id'] == $menu['parent_id'] ? "selected" : "";
                        echo "<option value='{$pm['id']}' $selected>{$pm['namaMenu']}</option>";
                    }
                ?>
            </select>
        </div>
        <button name="update" class="btn btn-warning">Update</button>
        <a href="tampilMenu.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php include "footer.php"; ?>