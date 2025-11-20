<?php
include "../koneksi.php";

$id_role = $_GET['id_role'];

$menu_result = $conn->query("SELECT id, namaMenu FROM menu");
$rbac_result = $conn->query("SELECT menu_id FROM rbac WHERE role_id = '$id_role'");

$akses = [];
while ($r = $rbac_result->fetch_assoc()) {
    $akses[] = $r['menu_id'];
}

while ($menu = $menu_result->fetch_assoc()) {
    $checked = in_array($menu['id'], $akses) ? "checked" : "";
    echo "<div class='form-check'>";
    echo "<input class='form-check-input' type='checkbox' name='menu[]' value='".$menu['id']."' id='menu_".$menu['id']."' $checked>";
    echo "<label class='form-check-label' for='menu_".$menu['id']."'>".$menu['namaMenu']."</label>";
    echo "</div>";
}
?>
