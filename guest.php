<?php
require_once 'functions.php';

$query = "SELECT * FROM kartu";


$result = mysqli_query($conn, $query);

?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="guest.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#home">UKM UPNVJT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="#home">Home</a>
                    <a class="nav-link" href="#ukm">List</a>
                    <a class="nav-link" href="form.php">Form</a>
                </div>
                <div class="navbar-nav">
                    <a class="nav-link" href="login.php">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="home container" id="home">
        <div class="banner">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="src/1.jpg" class="tales d-block">
                    </div>
                    <div class="carousel-item">
                        <img src="src/2.jpg" class="tales d-block">
                    </div>
                    <div class="carousel-item">
                        <img src="src/3.jpg" class="tales d-block">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="isi">
            <h1>SELAMAT DATANG DI WEBSITE <br> UNIT KEGIATAN MAHASISWA UPNVJT </h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate expedita earum aliquid, iure, voluptatum est incidunt reprehenderit delectus, voluptatem veritatis fugit esse debitis a temporibus architecto tempore recusandae itaque illo doloremque. Cumque facilis aperiam nisi ea quasi quo rem earum animi at voluptas, dolorum libero, eaque ducimus eveniet praesentium sit.</p>
        </div>
    </div>

    <div class="hal2 container" id="ukm">
        <h2>UKM</h2>
        <p class="p">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quae laborum alias dolorem, sequi nam in odit, aspernatur quibusdam repellendus soluta impedit adipisci non commodi omnis quam iure fuga expedita. Nihil?</p>
        <div class="kartu">

            <?php
            if (mysqli_num_rows($result) > 0) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="card" style="width: 15rem;">
                        <img src="uploads/<?php echo $row['img']; ?>" class="card-img-top">
                        <div class="card-body">
                            <h5><?php echo $row['ukm']; ?></h5>
                            <p class="card-text"><?php echo $row['desk'] ?></p>
                            <p>Total Mahasiswa : <?php echo $row['total'] ?></p>
                            <a href="<?php echo $row['instagram'] ?>" class="sosmed text-decoration-none btn" target="_blank"><i class="bi bi-instagram"></i> Instagram</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>