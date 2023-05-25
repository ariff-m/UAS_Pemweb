<?php
session_start();
// Jika tidak bisa login maka balik ke login.php
// jika masuk ke halaman ini melalui url, maka langsung menuju halaman login
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

require_once 'functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM mahasiswa WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    if ($data = $result->fetch_assoc()) {
        $id = $data['id'];
        $nama = $data['nama'];
        $jk = $data['jk'];
        $npm = $data['npm'];
        $fak = $data['fak'];
        $jur = $data['jur'];
        $wa = $data['wa'];
        $ukm = $data['ukm'];
        $ktm = $data['ktm'];
        $sp = $data['sp'];
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">UKM UPNVJT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    <a class="nav-link" href="data.php">Data</a>
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Form</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="form.php">Tambah Mahasiswa</a></li>
                            <li><a class="dropdown-item" href="form2.php">Tambah UKM</a></li>
                        </ul>
                    </div>
                </div>
                <div class="navbar-nav">
                    <a class="nav-link" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="detail container">
        <table class="table table-striped border">
            <tr>
                <th colspan="2" class="text-center">DETAIL DATA MAHASISWA</th>
            </tr>
            <tr>
                <td>
                    <img src="uploads/<?= $sp ?>" width="200px">
                </td>
                <td style="width: 80%;">
                    <p>Nama : <?= $nama ?></p>
                    <p>Jenis Kelamin : <?= $jk ?></p>
                    <p>NPM : <?= $npm ?></p>
                    <p>Fakultas : <?= $fak ?></p>
                    <p>Jurusan : <?= $jur ?></p>
                    <p>No WA : <?= $wa ?></p>
                    <p>Pilihan UKM : <?= $ukm ?></p>
                </td>
            </tr>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>