<?php include "header.php"; include "../koneksi.php"; ?>

<div class="header">
    <h4>Data Ruangan</h4>
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
                <th>Nama Ruangan</th>
                <th>Kapasitas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT * FROM ruangan ORDER BY id ASC";
                $result = $conn->query($sql);
                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<th>".$i++."</th>";
                    echo "<td>".$row['nama_ruangan']."</td>";
                    echo "<td>".$row['kapasitas']."</td>";
                    echo "<td>
                        <a href='ubahRuangan.php?id=".$row['id']."' class='btn btn-sm btn-primary'>Ubah</a> |
                        <a href='hapusRuangan.php?id=".$row['id']."' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                    </td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <a href="tambahRuangan.php">
        <button class="btn btn-success form-control mb-3">Tambah Ruangan</button>
    </a>
</div>

<?php include "footer.php"; ?>
