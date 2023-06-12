<?php
session_start();
// Jika tidak bisa login maka balik ke login.php
// jika masuk ke halaman ini melalui url, maka langsung menuju halaman login
if (!isset($_SESSION['login'])) {
    header('location:guest.php');
    exit;
}

require_once 'functions.php';

// Menangani filter tanggal
$filterStartDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$filterEndDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Mengubah format tanggal menjadi "dd-mm-yyyy"
if (!empty($filterStartDate)) {
    $filterStartDate = date('d-m-Y', strtotime($filterStartDate));
}
if (!empty($filterEndDate)) {
    $filterEndDate = date('d-m-Y', strtotime($filterEndDate));
}
// Mengambil data berdasarkan rentang tanggal
$query = "SELECT * FROM mahasiswa";
if (!empty($filterStartDate) && !empty($filterEndDate)) {
    $query .= " WHERE tgl BETWEEN '$filterStartDate' AND '$filterEndDate'";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UKM UPNVJT - Data Mahasiswa</title>
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <link rel="stylesheet" href="data.css" />
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
                    <a class="nav-link" aria-current="page" href="index.php">Data UKM</a>
                    <a class="nav-link" href="data.php">Data Mahasiswa</a>
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Formulir</a>
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

    <div class="data container">
        <h2 class="mb-5">
            DATA MAHASISWA YANG MENGIKUTI UKM<br />
            UPN "VETERAN" JAWA TIMUR
        </h2>

        <!-- Filter Tanggal -->
        <form action="" method="GET" class="mb-4">
            <div class="row">
                <div class="col">
                    <input type="date" class="form-control" name="start_date" value="<?= $filterStartDate ?>">
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="end_date" value="<?= $filterEndDate ?>">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-dark">Search</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table mt-2 text-center border" id="data-table">
                <!-- Table Header -->
                <thead class="table-dark">
                    <tr>
                        <th>No.</th>
                        <th>NPM</th>
                        <th>NAMA</th>
                        <th>JURUSAN</th>
                        <th>GENDER</th>
                        <th>UKM</th>
                        <th>TANGGAL MASUK</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['npm'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['jur'] ?></td>
                                <td><?= $row['jk'] ?></td>
                                <td><?= $row['ukm'] ?></td>
                                <td><?= $row['tgl'] ?></td>
                                <td style="width: 25%;">
                                    <a type="button" class="btn btn-dark" href="detail.php?id=<?= $row['id'] ?>">DETAIL</a> |
                                    <a type="button" class="btn btn-warning" href="edit.php?id=<?= $row['id'] ?>">EDIT</a> |
                                    <a type="button" class="btn btn-danger" href="functions.php?id=<?= $row['id'] ?>&proses=remove" onclick="return confirm('Apakah kamu yakin menghapus data NPM : <?= $row['npm'] ?> ?');">REMOVE</a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        // Jika tidak ada data yang sesuai dengan rentang tanggal
                        ?>
                        <tr>
                            <td colspan="8">Tidak ada data yang sesuai dengan rentang tanggal yang dipilih.</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>Jalan Raya Rungkut Madya<br>Surabaya, 60295<br>Indonesia</p>
            <p class="copy">Copyright &copy 2023 | All Rights Reserved | Kelompok 4</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#data-table').DataTable();
        });
    </script>
</body>

</html>