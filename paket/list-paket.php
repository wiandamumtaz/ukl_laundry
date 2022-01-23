<?php
session_start();
# jika saat load halaman ini, pastikan telah login sebagai karyawan
if (!isset($_SESSION["karyawan"])) {
    header("Location:.../login/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Paket</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include("../home.php"); ?>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark">
                <h3 class="text-white text-center">
                    Daftar Paket
                </h3>
                <a href="form-paket.php">
                    <button class="btn btn-success form-control"> 
                        Add Package
                    </button>
                </a>
            </div>

            <div class="card-body">
                <form action="list-paket.php" method="get">
                    <input type="text" name="search"
                    class="form-control mb-2" placeholder="cari">
                </form>

                <ul class="list-group"> 
                <?php
                include("../connection.php");
                if (isset($_GET["search"])) {
                    $cari = $_GET["search"];
                    $sql = "select * from paket where
                    id_paket like '%$cari%'
                    or jenis_paket like '%$cari%'
                    or harga like '%$cari%'";
                }else{
                    $sql = "select * from paket";
                }

                # eksekusi SQL
                $hasil = mysqli_query($connect, $sql);
                while ($paket = mysqli_fetch_array($hasil)) {
                ?>
                    <li class="list-group-item ">
                        <div class="row">

                            <div class="col-lg-6 mt-2">
                                <!-- untuk deskripsi -->
                                <h5><b><?=$paket["jenis"]?></b></h5>
                                <h6>Nomor Paket : <?=$paket["id_paket"]?></h6>
                                <h6>Jenis : <?=$paket["jenis"]?></h6>
                                <h6>Harga Paket Rp : <?=$paket["harga"]?></h6>
                            </div>

                            <div class="col-lg-2">
                                <a href="form-paket.php?id_paket=<?=$paket["id_paket"]?>">
                                    <button class="btn btn-info btn-block mb-2">
                                        Edit
                                    </button>
                                </a>

                                <a href="proses-paket.php?id_paket=<?=$paket["id_paket"]?>"
                                onclick="return confirm('Are you sure delete this data?')">
                                    <button class="btn btn-danger btn-block">
                                        Delete
                                    </button>
                                </a>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>