<!doctype html>
<?php include "header.php"; ?>
<?php 
    $target_dir = "uploads/";
    
    // Ambil ID mahasiswa yang akan diubah
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM mhs WHERE id = '$id'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
    }

    if (isset($_POST['update'])) {
        
        $nama               = $_POST['nama'];
        $nipd               = $_POST['nipd'];
        $tanggal_lahir      = $_POST['tanggal_lahir'];
        $alamat             = $_POST['alamat'];
        $kelas_id           = $_POST['kelas_id'];

        $updateFoto = ""; // default

        if (!empty($_FILES["photoProfile"]["name"])) {
            $fileName = basename($_FILES["photoProfile"]["name"]);
            $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $target_file = $target_dir . $nama . "." .$imageFileType;
            $uploadOk = 1;

            // Check image valid
            $check = getimagesize($_FILES["photoProfile"]["tmp_name"]);
            if ($check === false) {
                echo "File yang di Upload bukan berupa Gambar.";
                $uploadOk = 0;
            }

            // File size check
            if ($_FILES["photoProfile"]["size"] > 5000000) {
                echo "Maaf, File Terlalu Besar.";
                $uploadOk = 0;
            }

            // Format check
            if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
                echo "Maaf, Hanya JPG, JPEG, PNG & GIF format yang diperbolehkan.";
                $uploadOk = 0;
            }

            // Upload
            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["photoProfile"]["tmp_name"], $target_file)) {
                    $photoProfile = $nama.".".$imageFileType;
                    $updateFoto = ", photoProfile='$photoProfile'";
                } else {
                    echo "Maaf, Terjadi Kesalahan ketika upload Photo Anda.";
                }
            }
        }

        // SQL update (gambar hanya ikut jika ada upload)
        $sql = "UPDATE mhs SET 
                    namaMhs='$nama', 
                    NIPD='$nipd', 
                    tanggalLahir='$tanggal_lahir', 
                    Alamat='$alamat', 
                    kelas_id='$kelas_id' 
                    $updateFoto
                WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    Data berhasil Di ubah!
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                  </div>";
            $conn->close();
            header("Location: tampilDatamhs.php");
            exit();
        } else {
            $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    Error: ".$sql." - " . $conn->error . "
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                  </div>";
            $conn->close();
            header("Location: tampilDatamhs.php");
            exit();
        }
    }

?>
    <div class="header">
        <h4>Ubah Data Mahasiswa ASE10</h4>
    </div>

    <div class="content" style="margin-top: 70px;">
        <form method="POST" class="border p-4 rounded shadow" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $row['namaMhs']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">NIPD</label>
                <input type="text" name="nipd" class="form-control" maxlength="12" value="<?php echo $row['NIPD']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Kelas</label>
                <select name="kelas_id" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <?php
                    $kelas = $conn->query("SELECT * FROM kelas");
                    while ($k = $kelas->fetch_assoc()) {
                        $selected = ($k['id'] == $row['kelas_id']) ? 'selected' : '';
                        echo "<option value='{$k['id']}' $selected>{$k['nama_kelas']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $row['tanggalLahir']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" required><?php echo $row['Alamat']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Photo Profile</label>
                <img id="imagePreview" src="uploads/<?php echo $row['photoProfile']; ?>" alt="Profile Preview" style="width: 150px; height: 150px; object-fit: cover; display: block; margin-bottom: 10px;">
                <input name="photoProfile" type="file" class="form-control">
            </div>
            <button type="submit" class="btn btn-warning" name="update">Update Data</button>
        </form>
    </div>

   <?php include "footer.php"; ?>