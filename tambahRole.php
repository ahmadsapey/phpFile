<?php
include "header.php";
include "../koneksi.php";

if (isset($_POST['submit'])) {
    $role       = $_POST['role'];
    $keterangan = $_POST['keterangan'];
    $created_at = date("Y-m-d H:i:s");

    $sql = "INSERT INTO role (role, keterangan, created_at) VALUES ('$role', '$keterangan', '$created_at')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                Role berhasil ditambahkan!
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
    <h4>Tambah Role</h4>
</div>

<div class="content" style="margin-top: 70px;">
    <form action="" method="POST" class="border p-4 rounded shadow">
        <div class="mb-3">
            <label class="form-label">Nama Role</label>
            <input type="text" name="role" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" required></textarea>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary mb-3" name="submit">Tambah Role</button>
            <button type="button" class="btn btn-secondary mb-3" onclick="window.history.back()">Kembali</button>
        </div>
    </form>
</div>

<?php include "footer.php"; ?>
