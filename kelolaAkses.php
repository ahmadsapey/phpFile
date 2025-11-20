<?php include "header.php"; ?>

<div class="header">
    <h4>Kelola Akses</h4>
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
                <th>Nama Role</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT id, role, keterangan FROM role";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>".$i++."</th>";
                        echo "<td>".$row['role']."</td>";
                        echo "<td>".$row['keterangan']."</td>";
                        echo "<td>
                                <button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#aksesModal' onclick='loadAkses(".$row['id'].")'>
                                    Lihat Akses
                                </button>
                              </td>";
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>
</div>

<!-- MODAL AKSES -->
<div class="modal fade" id="aksesModal" tabindex="-1" aria-labelledby="aksesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="simpanAkses.php">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kelola Akses Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_role" id="id_role">
                <div id="daftar_menu">
                    <!-- Daftar menu dengan checkbox dimuat lewat Ajax -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="submit" class="btn btn-primary">Simpan Akses</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </form>
  </div>
</div>

<script>
function loadAkses(idRole) {
    document.getElementById("id_role").value = idRole;

    fetch("loadMenu.php?id_role=" + idRole)
        .then(response => response.text())
        .then(data => {
            document.getElementById("daftar_menu").innerHTML = data;
        })
        .catch(err => {
            document.getElementById("daftar_menu").innerHTML = "Gagal memuat data.";
        });
}
</script>

<?php include "footer.php"; ?>
