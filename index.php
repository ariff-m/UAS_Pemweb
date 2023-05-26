<?php
session_start();
// Jika tidak bisa login maka balik ke login.php
// jika masuk ke halaman ini melalui url, maka langsung menuju halaman login
if (!isset($_SESSION['login'])) {
  header('location:guest.php');
  exit;
}

require_once 'functions.php';

$query = "SELECT * FROM kartu";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>UKM</title>
  <!-- Data Tables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">UKM UPNVJT</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link" aria-current="page" href="index.php">Data UKM</a>
          <a class="nav-link" href="data.php">Data Mahasiswa</a>
          <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">Formulir</a>
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


  <div class="hal2 container">
    <h2 class="mb-5">UKM</h2>
    <div class="kartu">

      <?php
      if (mysqli_num_rows($result) > 0) {
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          ?>
          <div class="card" style="width: 15rem;">
            <img src="uploads/<?php echo $row['img']; ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5>
                <?php echo $row['ukm']; ?>
              </h5>
              <p class="card-text">
                <?php echo $row['desk'] ?>
              </p>
              <p class="fw-semibold">Total Mahasiswa :
                <?php echo $row['total'] ?>
              </p>
              <a href="<?php echo $row['instagram'] ?>" class="sosmed text-decoration-none btn" target="_blank"><i
                  class="bi bi-instagram"></i> Instagram</a>
              <hr>
              <div>
                <a type="button" class="btn btn-warning" href="edit2.php?id=<?= $row['id'] ?>">EDIT</a>
                <a type="button" class="btn btn-danger"
                  href="functions.php?id=<?= $row['id'] ?> &proses=ukmREMOVE">REMOVE</a>
              </div>
            </div>
          </div>

          <?php
        }
      }
      ?>
    </div>

  </div>

  <footer>
    <p>&copy 2023 | Kelompok 4</p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>

  <script>
    $(document).ready(function () {
      $('#data-table').DataTable();
    });
  </script>
</body>

</html>