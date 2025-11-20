<?php
session_start();
include "../koneksi.php";

// Set headers for Excel file
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=mhs_data.csv");

$output = fopen("php://output", "w");

// Write the header row
fputcsv($output, ["namaMhs", "NIPD", "tanggalLahir", "Alamat"]);

// Fetch data from the table
$sql = "SELECT namaMhs, NIPD, tanggalLahir, Alamat FROM mhs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
$conn->close();

exit;
?>