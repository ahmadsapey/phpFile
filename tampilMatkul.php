<?php include "header.php"; ?>

<div class="header">
    <h4>Data Mata Kuliah</h4>
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
                <th>Nama Mata Kuliah</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                include "../koneksi.php";
                $sql = "SELECT * FROM matkul";
                $result = $conn->query($sql);
                $i = 1;

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<th>".$i++."</th>";
                    echo "<td>".$row['nama']."</td>";
                    echo "<td>".$row['deskripsi']."</td>";
                    echo "<td>
                            <a href='ubahMatkul.php?id=".$row['id']."'><button class='btn btn-warning btn-sm'>Ubah</button></a> |
                            <a href='prosesHapusMatkul.php?id=".$row['id']."' onclick='return confirm(\"Yakin hapus?\")'><button class='btn btn-danger btn-sm'>Hapus</button></a>
                          </td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <a href="tambahMatkul.php"><button class="form-control btn btn-success mb-3">Tambah Mata Kuliah</button></a>
</div>

<?php include "footer.php"; ?>
