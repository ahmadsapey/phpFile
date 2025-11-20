<?php
include "header.php";
?>

<div class="header">
    <h4>Data Absensi</h4>
</div>

<div class="content" style="margin-top: 70px;">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Kelas</th>
                <th>Mata Kuliah</th>
                <th>Semester</th>
                <th>Pertemuan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $sql = "SELECT a.id_kelas, a.id_matkul, a.semester, a.pertemuan_ke, a.tanggal, 
                           k.nama_kelas, m.nama 
                    FROM absensi a 
                    JOIN kelas k ON a.id_kelas = k.id 
                    JOIN matkul m ON a.id_matkul = m.id 
                    GROUP BY a.id_kelas, a.id_matkul, a.semester, a.pertemuan_ke, a.tanggal";
            $result = $conn->query($sql);
            $no = 1;
            while($row = $result->fetch_assoc()):
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama_kelas'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['semester'] ?></td>
                <td><?= $row['pertemuan_ke'] ?></td>
                <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                <td>
                    <button 
                        class="btn btn-primary btn-sm btn-detail"
                        data-kelas="<?= $row['id_kelas'] ?>"
                        data-matkul="<?= $row['id_matkul'] ?>"
                        data-semester="<?= $row['semester'] ?>"
                        data-pertemuan="<?= $row['pertemuan_ke'] ?>"
                        data-tanggal="<?= $row['tanggal'] ?>"
                        data-bs-toggle="modal"
                        data-bs-target="#modalDetail">
                        Detail
                    </button>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetailLabel">Detail Absensi Mahasiswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIPD</th>
                    <th>Nama</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="detail-absen-body">
                <!-- Diisi via jQuery -->
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- JS jQuery + Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).on('click', '.btn-detail', function() {
    let id_kelas = $(this).data('kelas');
    let id_matkul = $(this).data('matkul');
    let semester = $(this).data('semester');
    let pertemuan = $(this).data('pertemuan');
    let tanggal = $(this).data('tanggal');

    $.ajax({
        url: 'detailAbsensi.php',
        type: 'POST',
        data: {
            id_kelas, id_matkul, semester, pertemuan, tanggal
        },
        success: function(res) {
            $('#detail-absen-body').html(res);
        }
    });
});
</script>

<?php include "footer.php"; ?>
