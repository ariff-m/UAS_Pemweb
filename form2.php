<?php
require_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form Add</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#home">UKM UPNVJT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="form mt-3 container">
        <h2>Masukkan Data UKM</h2>
        <form action="functions.php" method="post" class="mt-3" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama UKM</label>
                            <input type="text" class="form-control" id="ukm" name="ukm" required />
                        </div>
                        <div class="mb-3">
                            <label for="npm" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="desk" id="desk" rows="5"></textarea>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Link Instagram</label>
                            <input type="text" class="form-control" id="instagram" name="instagram" required />
                        </div>
                        <div class="mb-3">
                            <label for="sp" class="form-label">Logo UKM</label>
                            <input class="form-control" type="file" id="img" name="img"
                                accept=".img, .jpeg, .png ,.jpg" />
                        </div>
                    </td>
                </tr>
            </table>
            <a href="index.php" class="btn btn-secondary">Batal</a>
            <button class="btn" style="color: white;
  background-color: #617a55;" type="submit" value="ukmADD" name="proses">Simpan</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>