<?php
include "header.php";

// Handle simpan absensi
if (isset($_POST['simpan'])) {
    $id_kelas = $_POST['id_kelas'];
    $id_matkul = $_POST['id_matkul'];
    $semester = $_POST['semester'];
    $pertemuan = $_POST['pertemuan'];
    $tanggal = date('Y-m-d');

    foreach ($_POST['status'] as $id_mhs => $status) {
        $ket = $_POST['keterangan'][$id_mhs];
        $sql = "INSERT INTO absensi (id_mahasiswa, id_kelas, id_matkul, semester, pertemuan_ke, status, keterangan, tanggal) 
                VALUES ('$id_mhs', '$id_kelas', '$id_matkul', '$semester', '$pertemuan', '$status', '$ket', '$tanggal')";
        $conn->query($sql);
        $sukses = true;
    }

    if ($sukses === TRUE) {
        $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                Absensi berhasil Di Simpan!
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
        $conn->close();
        header("Location: formAbsensi.php");
        exit();
    } else {
        $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                Error: ".$sql." - " . $conn->error . "
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
        $conn->close();
        header("Location: formAbsensi.php");
        exit();
    }
}
?>

<div class="header">
    <h4>Form Absensi Mahasiswa</h4>
</div>

<div class="content" style="margin-top: 70px;">
        <?php
            if (isset($_SESSION['alert'])) {
                echo $_SESSION['alert']; // Display the alert message
                unset($_SESSION['alert']); // Remove message after displaying
            }
        ?>
    <form method="POST">
        <div class="row mb-3">
            <div class="col-md-3">
                <label>Kelas</label>
                <select name="id_kelas" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <?php
                    $kelas = $conn->query("SELECT * FROM kelas");
                    while ($k = $kelas->fetch_assoc()) {
                        $selected = (isset($_POST['id_kelas']) && $_POST['id_kelas'] == $k['id']) ? 'selected' : '';
                        echo "<option value='{$k['id']}' $selected>{$k['nama_kelas']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label>Mata Kuliah</label>
                <select name="id_matkul" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <?php
                    $matkul = $conn->query("SELECT * FROM matkul");
                    while ($m = $matkul->fetch_assoc()) {
                        $selected = (isset($_POST['id_matkul']) && $_POST['id_matkul'] == $m['id']) ? 'selected' : '';
                        echo "<option value='{$m['id']}' $selected>{$m['nama']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <label>Semester</label>
                <select name="semester" class="form-control" required>
                    <option value="">-- Pilih Semester --</option>
                    <?php
                    for ($i = 1; $i <= 4; $i++) {
                        $selected = (isset($_POST['semester']) && $_POST['semester'] == $i) ? 'selected' : '';
                        echo "<option value='$i' $selected>Semester $i</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <label>Pertemuan Ke</label>
                <select name="pertemuan" class="form-control" required>
                    <option value="">-- Pilih Pertemuan --</option>
                    <?php
                    for ($i = 1; $i <= 14; $i++) {
                        $selected = (isset($_POST['pertemuan']) && $_POST['pertemuan'] == $i) ? 'selected' : '';
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <label>&nbsp;</label>
                <button type="submit" name="tampil" class="btn btn-primary form-control">Tampilkan</button>
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST['tampil']) || isset($_POST['simpan'])):
        $id_kelas = $_POST['id_kelas'];
        $mhs = $conn->query("SELECT * FROM mhs WHERE kelas_id = '$id_kelas'");
    ?>
    <form method="POST">
        <!-- hidden input -->
        <input type="hidden" name="id_kelas" value="<?= $id_kelas ?>">
        <input type="hidden" name="id_matkul" value="<?= $_POST['id_matkul'] ?>">
        <input type="hidden" name="semester" value="<?= $_POST['semester'] ?>">
        <input type="hidden" name="pertemuan" value="<?= $_POST['pertemuan'] ?>">

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIPD</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while($row = $mhs->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['NIPD'] ?></td>
                    <td><?= $row['namaMhs'] ?></td>
                    <td>
                        <select name="status[<?= $row['id'] ?>]" class="form-select" required>
                            <option value="hadir">Hadir</option>
                            <option value="alfa">Alfa</option>
                            <option value="ijin">Ijin</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="keterangan[<?= $row['id'] ?>]" class="form-control">
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <button type="submit" name="simpan" class="btn btn-success">Simpan Absensi</button>
    </form>
    <?php endif; ?>
</div>

<?php include "footer.php"; ?>
