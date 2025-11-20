<?php 
    include "header.php"; 
 ?>

<div class="header">
    <h4>Data Menu Navigasi</h4>
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
                <th>Nama Menu</th>
                <th>URL</th>
                <th>Parent</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT m.*, p.namaMenu AS parent_name 
                        FROM menu m 
                        LEFT JOIN menu p ON m.parent_id = p.id 
                        ORDER BY m.id ASC";
                $result = $conn->query($sql);
                $i = 1;

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<th scope='row'>".$i++."</th>";
                    echo "<td>".$row['namaMenu']."</td>";
                    echo "<td>".$row['url']."</td>";
                    echo "<td>".($row['parent_name'] ?? '-')."</td>";
                    echo "<td>
                            <a href='ubahMenu.php?id=".$row['id']."' class='btn btn-primary btn-sm'>Ubah</a> | 
                            <a href='hapusMenu.php?id=".$row['id']."' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                        </td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    <!-- Tombol Tambah Menu di Bawah -->
    <a href="tambahMenu.php">
        <button class="btn btn-success form-control mb-3"><i class="fa fa-plus"></i> Tambah Menu</button>
    </a>
</div>

<?php include "footer.php"; ?>