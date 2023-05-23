<?php

$host = "Localhost";
$user = "root";
$pass = "";
$DBname = "ukm";

$conn =  mysqli_connect($host, $user, $pass, $DBname);


if (isset($_GET['proses']) and $_GET['proses'] == 'remove') {
    hapus();
} else if (isset($_POST['proses']) and $_POST['proses'] == 'submit') {
    tambah();
} else if (isset($_POST['proses']) and $_POST['proses'] == 'update') {
    edit();
}

function hapus()
{
    global $conn;
    $id = $_GET['id'];

    // Mengambil data file yang akan dihapus
    $query = "SELECT ktm, sp FROM mahasiswa WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    $ktm = $data['ktm'];
    $sp = $data['sp'];

    // Menghapus data dari tabel
    $query = "DELETE FROM mahasiswa WHERE id = '$id'";
    $eksekusi = mysqli_query($conn, $query);

    if ($eksekusi) {
        // Menghapus file dari direktori
        if ($ktm !== "null") {
            unlink('uploads/' . $ktm);
        }
        if ($sp !== "null") {
            unlink('uploads/' . $sp);
        }

        echo '<script> 
            alert("Berhasil Terhapus"); 
            window.location.href = "data.php#data";
        </script>';
    } else {
        echo '<script> 
            alert("Gagal Terhapus"); 
            window.location.href = "data.php#data";
        </script>';
    }
}

function tambah()
{
    global $conn;
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $npm = $_POST['npm'];
    $fak = $_POST['fak'];
    $jur = $_POST['jur'];
    $wa = $_POST['wa'];
    $ukm = $_POST['ukm'];

    $ktm_tmp = $_FILES['ktm'];
    $sp_tmp = $_FILES['sp'];

    // Menentukan nama file PDF yang baru
    $ktm = uniqid() . '.' . pathinfo($ktm_tmp['name'], PATHINFO_EXTENSION);

    // Memindahkan $ktm_tmp PDF yang diunggah ke direktori yang ditentukan
    if ($ktm_tmp['error'] == 4) {
        $ktm = "null";
    } else {
        if (!move_uploaded_file($ktm_tmp['tmp_name'], 'uploads/' . $ktm)) {
            echo "<script>
            alert('File KTM tidak bisa di masukkan.');
        </script>";
            return 0;
        }
    }

    // Menentukan nama file PDF yang baru
    $sp = uniqid() . '.' . pathinfo($sp_tmp['name'], PATHINFO_EXTENSION);

    // Memindahkan $sp_tmp PDF yang diunggah ke direktori yang ditentukan
    if ($sp_tmp['error'] == 4) {
        $sp = "null";
    } else {
        if (!move_uploaded_file($sp_tmp['tmp_name'], 'uploads/' . $sp)) {
            echo "<script>
            alert('File Surat Pendaftaran tidak bisa di masukkan.');
        </script>";
            return 0;
        }
    }



    $query = "INSERT INTO mahasiswa (nama, jk, npm, fak, jur, wa, ukm, ktm, sp) VALUES ('$nama', '$jk', '$npm', '$fak','$jur','$wa','$ukm','$ktm','$sp')";
    $eksekusi = mysqli_query($conn, $query);

    if ($eksekusi) {
        echo
        '<script> 
            alert("Proses Input Berhasil"); 
            window.location.href = "data.php#data";
        </script>';
    } else {
        echo
        '<script> 
            alert("Proses Input Gagal"); 
            window.location.href = "form.php";
        </script>';
    }
}

function edit()
{
    global $conn;
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $npm = $_POST['npm'];
    $fak = $_POST['fak'];
    $jur = $_POST['jur'];
    $wa = $_POST['wa'];
    $ukm = $_POST['ukm'];

    $ktm_tmp = $_POST['ktm'];
    $sp_tmp = $_POST['sp'];

    if ($_FILES['ktm']['error'] === 4) {
        $ktm = $ktm_tmp;
    } else {
        $ktm = uniqid() . '.' . pathinfo($_FILES['ktm']['name'], PATHINFO_EXTENSION);
        if (!move_uploaded_file($_FILES['ktm']['tmp_name'], 'uploads/' . $ktm)) {
            echo "<script>
                alert('MEDICAL FILE COULD NOT BE UPLOADED!');
            </script>";
            return 0;
        }
        if ($ktm_tmp !== 'null') {
            unlink('uploads/' . $ktm_tmp);
        }
    }
    
    if ($_FILES['sp']['error'] === 4) {
        $sp = $sp_tmp;
    } else {
        $sp = uniqid() . '.' . pathinfo($_FILES['sp']['name'], PATHINFO_EXTENSION);
        if (!move_uploaded_file($_FILES['sp']['tmp_name'], 'uploads/' . $sp)) {
            echo "<script>
                alert('MEDICAL FILE COULD NOT BE UPLOADED!');
            </script>";
            return 0;
        }
        if ($sp_tmp !== 'null') {
            unlink('uploads/' . $sp_tmp);
        }
    }


    $query = "UPDATE mahasiswa SET nama = '$nama', jk = '$jk', npm = '$npm', fak = '$fak', jur = '$jur', wa = '$wa', ukm = '$ukm', ktm = '$ktm', sp = '$sp' WHERE id = '$id'";
    $eksekusi = mysqli_query($conn, $query);

    if ($eksekusi) {
        echo
        '<script> 
            alert("Edit Berhasil"); 
            window.location.href = "data.php#data";
        </script>';
    } else {
        echo
        '<script> 
            alert("Edit Gagal"); 
        </script>';
    }
}