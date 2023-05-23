<?php
session_start();
// Jika bisa login maka ke index.php
if (isset($_SESSION['login'])) {
  header('location:index.php');
  exit;
}

// Memanggil atau membutuhkan file function.php
require_once 'functions.php';

// jika tombol yang bernama login diklik
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // mengambil data dari user dimana username dan password yang diambil
  $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND pass = '$password'");

  $cek = mysqli_num_rows($result);

  // jika $cek lebih dari 0, maka berhasil login dan masuk ke index.php
  if ($cek > 0) {
    $_SESSION['login'] = true;
    header('location:index.php');
    exit;
  }
  // jika $cek adalah 0 maka tampilkan error
  $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login UKM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <link rel="stylesheet" href="login.css" />
</head>

<body>
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="guest.php">UKM UPNVJT</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link" aria-current="page" href="guest.php">Home</a>
          <a class="nav-link" href="form.php">Form</a>
        </div>
        <div class="navbar-nav">
          <a class="nav-link" href="login.php">Login</a>
        </div>
      </div>
    </div>
  </nav>

  <div class="login">
    <form class="kotak" action="" method="post">
      <h3 class="fw-bold mb-4 fs-2 text-center">ADMIN</h3>
      <div class="mb-3">
        <input type="text" class="form-control" name="username" placeholder="username" required />
      </div>
      <div class="mb-3">
        <input type="password" class="form-control" name="password" placeholder="password" required />
      </div>
      <div style="display: none;" class="verif text-danger fw-bold text-center <?php if (isset($error)) echo 'd-block'; ?>">
        <p>Username or password is incorrect!</p>
      </div>
      <button class="btn btn-success" type="submit" name="login">LOGIN</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>