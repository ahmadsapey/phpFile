<?php include "header.php"; include "../koneksi.php"; ?>

<div class="header">
    <h4>Data Kelas</h4>
</div>

<div class="content" style="margin-top: 70px;">
    <?php
    if (isset($_SESSION['alert'])) {
        echo $_SESSION['alert'];
        unset($_SESSION['alert']);
    }
    ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Kelas</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT * FROM kelas ORDER BY id ASC";
                $result = $conn->query($sql);
                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<th scope='row'>".$i++."</th>";
                    echo "<td>".$row['nama_kelas']."</td>";
                    echo "<td>".$row['keterangan']."</td>";
                    echo "<td>
                            <a href='ubahKelas.php?id=".$row['id']."' class='btn btn-primary btn-sm'>Ubah</a> | 
                            <a href='hapusKelas.php?id=".$row['id']."' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                          </td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <a href="tambahKelas.php">
        <button class="btn btn-success form-control mb-3"><i class="fa fa-plus"></i> Tambah Kelas</button>
    </a>
</div>

<?php include "footer.php"; ?>
