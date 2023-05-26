<?php
require_once 'functions.php';

$query = "SELECT ukm FROM kartu";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>UKM UPNVJT - Daftar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand">UKM UPNVJT</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <div class="form mt-3 container">
    <h2>Masukkan Data Anda</h2>
    <form action="functions.php" method="post" class="mt-3" enctype="multipart/form-data">
      <table class="table">
        <tr>
          <td>
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" required />
            </div>
            <div class="mb-3">
              <label for="jk" class="form-label">Jenis Kelamin</label>
              <select name="jk" id="jk" class="form-select" required>
                <option value="" disabled selected></option>
                <option value="Laki - laki">Laki - laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="npm" class="form-label">NPM</label>
              <input type="text" class="form-control" id="npm" name="npm" required />
            </div>
            <div class="mb-3">
              <label for="fak" class="form-label">Fakultas</label>
              <select id="fak" name="fak" class="form-select" required>
                <option value="" disabled selected></option>
                <option value="FASILKOM">FASILKOM</option>
                <option value="FH">FH</option>
                <option value="FT">FT</option>
                <option value="FP">FP</option>
                <option value="FISIP">FISIP</option>
                <option value="FEB">FEB</option>
                <option value="FAD">FAD</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="jur" class="form-label">Program Studi</label>
              <input type="text" class="form-control" id="jur" name="jur" required />
            </div>
          </td>
          <td>
            <div class="mb-3">
              <label for="wa" class="form-label">Nomor Whatsapp</label>
              <input type="text" class="form-control" id="wa" name="wa" value="+62" required />
            </div>
            <div class="mb-3">
              <label for="ukm" class="form-label">Pilihan UKM</label>
              <select id="ukm" name="ukm" class="form-select" required>
                <option value="" disabled selected></option>
                <?php
                if (mysqli_num_rows($result) > 0) {
                  $no = 1;
                  while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $row['ukm'] ?>"><?php echo $row['ukm'] ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="sp" class="form-label">Foto</label>
              <input class="form-control" type="file" id="sp" name="sp" accept=".img, .jpeg, .png ,.jpg" required />
            </div>
          </td>
        </tr>
      </table>
      <a href="index.php" class="btn btn-secondary">Batal</a>
      <button class="btn" type="submit" value="submit" name="proses" style="color: white;
  background-color: #617a55;">Simpan</button>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>

</html>