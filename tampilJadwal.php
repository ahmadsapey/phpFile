<?php 
include "header.php"; 
?>

<!-- Header -->
<div class="header">
    <h4>Daftar Jadwal Kuliah</h4>
</div>

<!-- Body Content -->
<div class="content" style="margin-top: 70px;">
    <?php
    if (isset($_SESSION['alert'])) {
        echo $_SESSION['alert'];
        unset($_SESSION['alert']);
    }
    ?>

    <form action="cetakJadwal.php" method="POST">
        <button type="submit" class="btn-primary float-end"><i class="fa fa-print"></i> Export Jadwal</button>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Kelas</th>
                <th>Mata Kuliah</th>
                <th>Dosen</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Ruangan</th>
                <th>Semester</th>
                <th>Tahun Ajaran</th>
                <th>Aksi</th>
                
                <?php 
                    // $sql = "SELECT * FROM jadwal_kuliah";
                    $sql = "SELECT a.id,
                                b.nama_kelas,
                                c.nama as mata_kuliah,
                                d.nama as nama_dosen,
                                e.nama_hari,
                                f.jam_mulai,
                                f.jam_selesai,
                                g.nama_ruangan, 
                                a.semester,
                                a.tahun_ajaran
                                FROM jadwal_kuliah a
                                LEFT JOIN kelas b ON a.id_kelas = b.id
                                LEFT JOIN matkul c ON a.id_matkul = c.id
                                LEFT JOIN dosen d ON a.id_dosen = d.id
                                LEFT JOIN hari e ON a.id_hari = e.id
                                LEFT JOIN jam_kuliah f ON a.id_jam_kuliah = f.id
                                LEFT JOIN ruangan g ON a.id_ruangan = g.id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>".$i++."</th>"; 
                            echo "<td>".$row['nama_kelas']."</td>";
                            echo "<td>".$row['mata_kuliah']."</td>";
                            echo "<td>".$row['nama_dosen']."</td>";
                            echo "<td>".$row['nama_hari']."</td>";
                            echo "<td>".$row['jam_mulai']."-".$row['jam_selesai']."</td>";
                            echo "<td>".$row['nama_ruangan']."</td>";
                            echo "<td>".$row['semester']."</td>";
                            echo "<td>".$row['tahun_ajaran']."</td>";
                            echo "<td>
                                    <a href='ubahJadwal.php?id=".$row['id']."'>
                                        <button class='btn-primary'>Ubah</button></a> | 
                                    <a href='prosesHapusJadwal.php?id=".$row['id']."'>
                                        <button class='btn-danger'>Hapus</button></a>
                                </td>";
                            echo "</tr>";
                        }
                    }    
                ?>
                
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>

    <a href="tambahJadwal.php"><button type="button" class="form-control btn btn-success mb-3">Tambah Jadwal</button></a>
</div>

<?php include "footer.php"; ?>