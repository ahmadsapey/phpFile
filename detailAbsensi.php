<?php
include "../koneksi.php";

$id_kelas = $_POST['id_kelas'];
$id_matkul = $_POST['id_matkul'];
$semester = $_POST['semester'];
$pertemuan = $_POST['pertemuan'];
$tanggal = $_POST['tanggal'];

$sql = "SELECT a.*, m.NIPD, m.namaMhs 
        FROM absensi a 
        JOIN mhs m ON a.id_mahasiswa = m.id 
        WHERE a.id_kelas = '$id_kelas'
          AND a.id_matkul = '$id_matkul'
          AND a.semester = '$semester'
          AND a.pertemuan_ke = '$pertemuan'
          AND a.tanggal = '$tanggal'";

$result = $conn->query($sql);
$no = 1;
while ($row = $result->fetch_assoc()) {
    $status = ucfirst($row['status']);
    $keterangan = !empty($row['keterangan']) ? " ({$row['keterangan']})" : '';
    echo "<tr>
            <td>{$no}</td>
            <td>{$row['NIPD']}</td>
            <td>{$row['namaMhs']}</td>
            <td>{$status}{$keterangan}</td>
          </tr>";$no++;
}
?>
