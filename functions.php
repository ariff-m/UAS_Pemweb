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
} else if (isset($_GET['proses']) and $_GET['proses'] == 'ukmREMOVE') {
    ukmREMOVE();
} else if (isset($_POST['proses']) and $_POST['proses'] == 'ukmADD') {
    ukmADD();
} else if (isset($_POST['proses']) and $_POST['proses'] == 'ukmEDIT') {
    ukmEDIT();
}

function hapus()
{
    global $conn;
    $id = $_GET['id'];

    // Mengambil data file yang akan dihapus
    $query = "SELECT sp FROM mahasiswa WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    $sp = $data['sp'];

    // Menghapus data dari tabel
    $query = "DELETE FROM mahasiswa WHERE id = '$id'";
    $eksekusi = mysqli_query($conn, $query);

    if ($eksekusi) {
        // Menghapus file dari direktori
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
    $tgl = date("d-m-Y");

    $sp_tmp = $_FILES['sp'];


    // Menentukan nama file img yang baru
    $sp = uniqid() . '.' . pathinfo($sp_tmp['name'], PATHINFO_EXTENSION);

    // Memindahkan $sp_tmp img yang diunggah ke direktori yang ditentukan
    if ($sp_tmp['error'] == 4) {
        $sp = "null";
    } else {
        if (!move_uploaded_file($sp_tmp['tmp_name'], 'uploads/' . $sp)) {
            echo "<script>
            alert('Foto tidak bisa di masukkan.');
        </script>";
            return 0;
        }
    }



    $query = "INSERT INTO mahasiswa (nama, jk, npm, fak, jur, wa, ukm, sp, tgl) VALUES ('$nama', '$jk', '$npm', '$fak','$jur','$wa','$ukm','$sp','$tgl');";
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

    $sp_tmp = $_POST['sp'];


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


    $query = "UPDATE mahasiswa SET nama = '$nama', jk = '$jk', npm = '$npm', fak = '$fak', jur = '$jur', wa = '$wa', ukm = '$ukm', sp = '$sp' WHERE id = '$id'";
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

function ukmREMOVE()
{
    global $conn;
    $id = $_GET['id'];

    // Mengambil data file yang akan dihapus
    $query = "SELECT img FROM kartu WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    $img = $data['img'];

    // Menghapus data dari tabel
    $query = "DELETE FROM kartu WHERE id = '$id'";
    $eksekusi = mysqli_query($conn, $query);

    if ($eksekusi) {
        // Menghapus file dari direktori
        if ($img !== "null") {
            unlink('uploads/' . $img);
        }
        echo '<script> 
            alert("Berhasil Terhapus"); 
            window.location.href = "index.php";
        </script>';
    } else {
        echo '<script> 
            alert("Gagal Terhapus"); 
            window.location.href = "index.php";
        </script>';
    }
}


function ukmADD()
{
    global $conn;
    $ukm = $_POST['ukm'];
    $desk = $_POST['desk'];
    $instagram = $_POST['instagram'];

    $img_tmp = $_FILES['img'];

    // Menentukan nama file PDF yang baru
    $img = uniqid() . '.' . pathinfo($img_tmp['name'], PATHINFO_EXTENSION);

    // Memindahkan $img_tmp PDF yang diunggah ke direktori yang ditentukan
    if ($img_tmp['error'] == 4) {
        $img = "null";
    } else {
        if (!move_uploaded_file($img_tmp['tmp_name'], 'uploads/' . $img)) {
            echo "<script>
            alert('File Surat Pendaftaran tidak bisa di masukkan.');
        </script>";
            return 0;
        }
    }


    $query = "INSERT INTO kartu (img, ukm, desk, instagram) VALUES ('$img','$ukm','$desk','$instagram')";
    $eksekusi = mysqli_query($conn, $query);

    if ($eksekusi) {
        echo
        '<script> 
            alert("Proses Input Berhasil"); 
            window.location.href = "index.php";
        </script>';
    } else {
        echo
        '<script> 
            alert("Proses Input Gagal"); 
            window.location.href = "form.php";
        </script>';
    }
}

function ukmEDIT()
{
    global $conn;
    $id = $_POST['id'];
    $ukm = $_POST['ukm'];
    $desk = $_POST['desk'];
    $instagram = $_POST['instagram'];
    $img_tmp = $_POST['img'];


    if ($_FILES['img']['error'] === 4) {
        $img = $img_tmp;
    } else {
        $img = uniqid() . '.' . pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        if (!move_uploaded_file($_FILES['img']['tmp_name'], 'uploads/' . $img)) {
            echo "<script>
                alert('MEDICAL FILE COULD NOT BE UPLOADED!');
            </script>";
            return 0;
        }
        if ($img_tmp !== 'null') {
            unlink('uploads/' . $img_tmp);
        }
    }

    $query = "UPDATE kartu SET img = '$img', ukm = '$ukm', desk = '$desk', instagram = '$instagram'  WHERE id = '$id'";
    $eksekusi = mysqli_query($conn, $query);

    if ($eksekusi) {
        echo
        '<script> 
            alert("Edit Berhasil"); 
            window.location.href = "index.php";
        </script>';
    } else {
        echo
        '<script> 
            alert("Edit Gagal"); 
        </script>';
    }
}
