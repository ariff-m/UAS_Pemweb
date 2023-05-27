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
        $sp = $data['sp'];
    }
}

$query2 = "SELECT ukm FROM kartu";
$result2 = mysqli_query($conn, $query2);
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
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#home">UKM UPNVJT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    <a class="nav-link" href="form.php">Form</a>
                    <a class="nav-link" href="data.php">Data</a>
                </div>
                <div class="navbar-nav">
                    <a class="nav-link" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="form mt-3 container">
        <h2>UBAH DATA ANDA</h2>
        <form action="functions.php" method="post" class="mt-3" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>">
            <table class="table">
                <tr>
                    <td>
                        <div class="mb-3">
                            <label for="nama" class="form-label">NAMA</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="jk" class="form-label">JENIS KELAMIN</label>
                            <select name="jk" id="jk" class="form-select" required>
                                <option value="" disabled selected></option>
                                <option value="Laki - laki" <?php if ($data['jk'] == 'Laki - laki') { ?> selected <?php } ?>>Laki - laki</option>
                                <option value="Perempuan" <?php if ($data['jk'] == 'Perempuan') { ?> selected <?php } ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="npm" class="form-label">NPM</label>
                            <input type="text" class="form-control" id="npm" name="npm" value="<?= $npm ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="fak" class="form-label">FAKULTAS</label>
                            <select id="fak" name="fak" class="form-select" required>
                                <option value="" disabled selected></option>
                                <option value="FASILKOM" <?php if ($data['fak'] == 'FASILKOM') { ?> selected <?php } ?>>FASILKOM</option>
                                <option value="FH" <?php if ($data['fak'] == 'FH') { ?> selected <?php } ?>>FH</option>
                                <option value="FT" <?php if ($data['fak'] == 'FT') { ?> selected <?php } ?>>FT</option>
                                <option value="FP" <?php if ($data['fak'] == 'FP') { ?> selected <?php } ?>>FP</option>
                                <option value="FISIP" <?php if ($data['fak'] == 'FISIP') { ?> selected <?php } ?>>FISIP</option>
                                <option value="FEB" <?php if ($data['fak'] == 'FEB') { ?> selected <?php } ?>>FEB</option>
                                <option value="FAD" <?php if ($data['fak'] == 'FAD') { ?> selected <?php } ?>>FAD</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jur" class="form-label">PROGRAM STUDI</label>
                            <input type="text" class="form-control" id="jur" name="jur" value="<?= $jur ?>" required />
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <label for="wa" class="form-label">NO WHATSAPP</label>
                            <input type="text" class="form-control" id="wa" name="wa" value="<?= $wa ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="ukm" class="form-label">PILIHAN UKM</label>
                            <select id="ukm" name="ukm" class="form-select" required>
                                <option value="" disabled selected></option>
                                <?php
                                if (mysqli_num_rows($result2) > 0) {
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result2)) {
                                ?>
                                        <option value="<?php echo $row['ukm'] ?>" <?php if ($data['ukm'] == $row['ukm']) { ?> selected <?php } ?>><?php echo $row['ukm'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <img src="uploads/<?= $sp ?>" width="100px"><br>
                            <label for="sp" class="form-label">FOTO</label>
                            <input type="hidden" name="sp" value="<?= $sp ?>">
                            <input class="form-control" type="file" id="sp" name="sp" accept=".img, .jpeg, .png ,.jpg"/>
                        </div>
                    </td>
                </tr>
            </table>
            <a href="index.php" class="btn btn-secondary">Batal</a>
            <button class="btn text-light" type="submit" value="update" name="proses" style="background-color: var(--pr);">Perbarui</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>