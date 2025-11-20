<?php include "header.php"; ?>

<?php
// Ambil ID jadwal yang akan diubah
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM jadwal_kuliah WHERE id = '$id'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
}

// Proses update
if (isset($_POST['update'])) {
    $id_kelas       = $_POST['id_kelas'];
    $id_matkul      = $_POST['id_matkul'];
    $id_dosen       = $_POST['id_dosen'];
    $id_hari        = $_POST['id_hari'];
    $id_jam_kuliah  = $_POST['id_jam_kuliah'];
    $id_ruangan     = $_POST['id_ruangan'];
    $semester       = $_POST['semester'];
    $tahun_ajaran   = $_POST['tahun_ajaran'];

    $sql = "UPDATE jadwal_kuliah SET
                id_kelas='$id_kelas',
                id_matkul='$id_matkul',
                id_dosen='$id_dosen',
                id_hari='$id_hari',
                id_jam_kuliah='$id_jam_kuliah',
                id_ruangan='$id_ruangan',
                semester='$semester',
                tahun_ajaran='$tahun_ajaran'
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                Jadwal berhasil diubah!
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
        header("Location: tampilJadwal.php");
        exit();
    } else {
        $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                Error: ".$sql." - ".$conn->error."
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
        header("Location: tampilJadwal.php");
        exit();
    }
}

// Fungsi bantu dropdown
function buildOptions($table, $idField, $nameField, $selectedId) {
    global $conn;
    $options = "";
    $query = "SELECT $idField, $nameField FROM $table";
    $res = $conn->query($query);
    while ($r = $res->fetch_assoc()) {
        $selected = ($r[$idField] == $selectedId) ? "selected" : "";
        $options .= "<option value='".$r[$idField]."' $selected>".$r[$nameField]."</option>";
    }
    return $options;
}
?>

<div class="header">
    <h4>Ubah Jadwal Kuliah</h4>
</div>

<div class="content" style="margin-top: 70px;">
    <form method="POST" class="border p-4 rounded shadow">
        <div class="mb-3">
            <label for="" class="form-label">Kelas</label>
            <select name="id_kelas" class="form-control" required>
                <option value="">-- Pilih Kelas --</option>
                <?= buildOptions("kelas", "id", "nama_kelas", $row['id_kelas']); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Mata Kuliah</label>
            <select name="id_matkul" class="form-control" required>
                <option value="">-- Pilih Mata Kuliah --</option>
                <?= buildOptions("matkul", "id", "nama", $row['id_matkul']); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Dosen</label>
            <select name="id_dosen" class="form-control" required>
                <option value="">-- Pilih Dosen --</option>
                <?= buildOptions("dosen", "id", "nama", $row['id_dosen']); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Hari</label>
            <select name="id_hari" class="form-control" required>
                <option value="">-- Pilih Hari --</option>
                <?= buildOptions("hari", "id", "nama_hari", $row['id_hari']); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Jam Kuliah</label>
            <select name="id_jam_kuliah" class="form-control" required>
                <option value="">-- Pilih Jam --</option>
                <?php
                    $jam_query = "SELECT id, CONCAT(jam_mulai, ' - ', jam_selesai) as waktu FROM jam_kuliah";
                    $jam_result = $conn->query($jam_query);
                    while ($jam = $jam_result->fetch_assoc()) {
                        $selected = ($jam['id'] == $row['id_jam_kuliah']) ? "selected" : "";
                        echo "<option value='".$jam['id']."' $selected>".$jam['waktu']."</option>";
                    }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Ruangan</label>
            <select name="id_ruangan" class="form-control" required>
                <option value="">-- Pilih Ruangan --</option>
                <?= buildOptions("ruangan", "id", "nama_ruangan", $row['id_ruangan']); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Semester</label>
            <input type="text" name="semester" class="form-control" value="<?= $row['semester']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Tahun Ajaran</label>
            <input type="text" name="tahun_ajaran" class="form-control" value="<?= $row['tahun_ajaran']; ?>" required>
        </div>

        <button type="submit" class="btn btn-warning" name="update">Update Jadwal</button>
    </form>
</div>

<?php include "footer.php"; ?>