<?php include "header.php"; ?>

<!-- Header -->
<div class="header">
    <h4>Data Role / Hak Akses</h4>
</div>

<!-- Content -->
<div class="content" style="margin-top: 70px;">
    <?php
    if (isset($_SESSION['alert'])) {
        echo $_SESSION['alert'];
        unset($_SESSION['alert']);
    }
    ?>

    <form action="cetakRole.php" method="POST">
        <button type="submit" class="btn-primary float-end"><i class="fa fa-print"></i> Export Role</button>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Role</th>
                <th>Keterangan</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT id, role, keterangan, created_at FROM role";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>".$i++."</th>";
                        echo "<td>".$row['role']."</td>";
                        echo "<td>".$row['keterangan']."</td>";
                        echo "<td>".$row['created_at']."</td>";
                        echo "<td>
                                <a href='ubahRole.php?id=".$row['id']."'><button class='btn-primary'>Ubah</button></a> |
                                <a href='prosesHapusRole.php?id=".$row['id']."'><button class='btn-danger'>Hapus</button></a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Tidak ada data role</td></tr>";
                }
            ?>
        </tbody>
    </table>

    <a href="tambahRole.php">
        <button type="button" class="form-control btn btn-success mb-3">Tambah Role</button>
    </a>
</div>

<?php include "footer.php"; ?>
