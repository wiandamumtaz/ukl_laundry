<?php
session_start();
# jika saat load halaman ini, pastikan telah login sebagai paket
if (!isset($_SESSION["user"])) {
    header("Location:../login/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Laundry</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include("../home.php") ?>
    <div class="container">
        <div class="card">
            <div class="card-header bg-danger">
                <h1 class="text-white">Paket Baru</h1>
                <h5 class="text-white">Tambahkan Paket Baru</h5>
            </div>

            <div class="card-body">
            <?php
                if (isset($_GET["id_paket"])) {
                    $id_paket = $_GET["id_paket"];
                    $sql = "select * from paket where id_paket='$id_paket'";

                    include("../connection.php");

                    #eksekusi
                    $hasil = mysqli_query($connect, $sql);

                    #konversi
                    $mobil = mysqli_fetch_array($hasil);
            ?>
                        <form action="proses-paket.php" method="post"
                        enctype="multipart/form-data">

                            ID Paket
                            <input type="text" name="id_paket"
                            class="form-control mb-2" required
                            value="<?=$paket["id_paket"];?>" readonly>

                            Jenis
                            <select name="jenis" class="form-control mb-2" required>
                                <option value="<?=$paket["jenis"];?>" selected><?=$paket["jenis"];?></option>
                                <option value="jeans">Jeans</option>
                                <option value="selimut">Selimut</option>
                                <option value="bedcover">Bed Cover</option>
                                <option value="Kaos">Kaos</option>
                            </select>

                            Harga Paket
                            <input type="text" name="harga_total"
                            class="form-control mb-2" required
                            value="<?=$paket["harga"];?>">

                            <button type="submit" class="btn btn-info btn-block"
                            name="update_paket">
                                Save
                            </button>
                        </form>
            <?php
                }else{
                    #form untuk insert
            ?>
                    <form action="proses-paket.php" method="post"
                    enctype="multipart/form-data">

                            Jenis
                            <select name="jenis" class="form-control mb-2" required>
                                <option value="<?=$paket["jenis"];?>" selected><?=$paket["jenis"];?></option>
                                <option value="jeans">Jeans</option>
                                <option value="selimut">Selimut</option>
                                <option value="bedcover">Bed Cover</option>
                                <option value="Kaos">Kaos</option>
                            </select>

                            Harga Paket
                            <input type="text" name="harga"
                            class="form-control mb-2" required
                            value="<?=$paket["harga"];?>">


                        <button type="submit" class="btn btn-info btn-block"
                        name="simpan_paket">
                            Save
                        </button>
                    </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>