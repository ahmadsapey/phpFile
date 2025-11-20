<?php
session_start();
include "header.php";
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM role WHERE id = '$id'");
    $data = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $role       = $_POST['role'];
    $keterangan = $_POST['keterangan'];

    $sql = "UPDATE role SET role='$role', keterangan='$keterangan' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                Role berhasil diubah!
                                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                              </div>";
        header("Location: tampilRole.php");
        exit();
    } else {
        $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                Error: ".$sql." - " . $conn->error . "
                                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                              </div>";
        header("Location: tampilRole.php");
        exit();
    }
}
?>

<div class="header">
    <h4>Ubah Role</h4>
</div>

<div class="content" style="margin-top: 70px;">
    <form action="" method="POST" class="border p-4 rounded shadow">
        <div class="mb-3">
            <label class="form-label">Nama Role</label>
            <input type="text" name="role" class="form-control" value="<?= $data['role'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" required><?= $data['keterangan'] ?></textarea>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-warning mb-3" name="update">Update Role</button>
            <button type="button" class="btn btn-secondary mb-3" onclick="window.history.back()">Kembali</button>
        </div>
    </form>
</div>

<?php include "footer.php"; ?>
