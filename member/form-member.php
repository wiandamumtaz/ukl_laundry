<?php
session_start();
# jika saat load halaman ini, pastikan telah login sebagai user
if (!isset($_SESSION["user"])) {
    header("Location:.../login/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Laundry</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php include("../home.php") ?>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="text-white">Hai! Member</h4>
            </div>

            <div class="card-body">
                <?php
                if (isset($_GET["id_member"])) {
                    //memeriksa ketika load file ini, apakah membawa
                    //data GET dgn nama "id_member"
                    //jika true, form member digunakan untuk edit

                    # mengakses data member dari id_member yang dikirim
                    include("../connection.php");
                    $id_member = $_GET["id_member"];
                    $sql = "select * from member where id_member='$id_member'";

                    //eksekusi perintah sql
                    $ubah = mysqli_query($connect, $sql);

                    // konversi hasil query ke bentuk array
                    $member = mysqli_fetch_array($ubah);
                ?>

                    <form action="proses-member.php" method="post"
                    onsubmit="return confirm('Are you sure edit this people?')">
                    
                        ID Member
                        <input type="text" name="id_member"
                        class="form-control mb-2" required
                        value="<?=$member["id_member"];?>" readonly>

                        Nama Member
                        <input type="text" name="nama_Member"
                        class="form-control mb-2" required
                        value="<?=$member["nama_member"];?>">

                        Alamat Member
                        <input type="text" name="alamat"
                        class="form-control mb-2" required
                        value="<?=$member["alamat"];?>">

                        No Telepon
                        <input type="number" name="tlp"
                        class="form-control mb-2" required
                        value="<?=$member["tlp"];?>">

                        Jenis Kelamin
                        <select name="jenis_kelamin" class="fprm-control mb-2" >
                            <option value="<?=$member["jenis_kelamin"];?>" selected><?=$member["jenis_kelamin"];?></option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>

                        <button type="submit" class="btn btn-success btn-block"
                        name="edit_member">
                            Save
                        </button>
                    </form>
                <?php
                }else{
                    //jika false, menggunakan ini untuk insert
                ?>
                    <form action="proses-member.php" method="post">
    
                        Nama Member
                        <input type="text" name="nama_Member"
                        class="form-control mb-2" required
                        value="<?=$member["nama_member"];?>">

                        Alamat Member
                        <input type="text" name="alamat"
                        class="form-control mb-2" required
                        value="<?=$member["alamat"];?>">

                        No Telepon
                        <input type="number" name="tlp"
                        class="form-control mb-2" required
                        value="<?=$member["tlp"];?>">

                        Jenis Kelamin
                        <select name="jenis_kelamin" class="form-control mb-2" >
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>

                        <button type="submit" class="btn btn-success btn-block"
                        name="simpan_pelanggan">
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