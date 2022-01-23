<?php
session_start();
if (!isset($_SESSION["user"])){
    header("Location:../login/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Member Laundry</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php
    // menyambungkan dengan database
    include("../home.php");
    ?>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="text-white texxt-center">Data Member Laundry</h4>
                <a href="form-member.php">
                    <button class="btn btn-success mb-2">
                        Add Member
                    </button>
                </a>
            </div>

            <div class="card-body">
                <form action="list-anggota.php" method="get">
                    <input type="text" name="search" class="form-control mb-2"
                    placeholder="Search">
                </form>
                
                <ul class="list-group">
                <?php
                include("../connection.php");
                if (isset($_GET["search"])) {
                    $search = $_GET["search"];

                    $sql = "select * from member where id_member like '%$search%'
                    or nama_member like '%$search%'
                    or alamat like '%$search%'
                    or tlp like '%$tlp%'
                    or jenis_kelamin '%$jenis_kelamin%'";
                }else {
                    $sql = "select * from member";
                }

                $query = mysqli_query($connect, $sql);
                while ($member = mysqli_fetch_array($query)) {
                    ?>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 align-self-center">
                                <h5><b><?php echo $member["id_member"];?></b></h5>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <h5><b><?php echo $member["nama_member"];?></b></h5>
                                <h6>Alamat : <?php echo $member["alamat"];?></h6>
                                <h6>No.Telepon : <?php echo $member["tlp"];?></h6>
                                <h6>Jenis Kelamin : <?php echo $member["jenis_kelamin"];?></h6>
                            </div>

                            <div class="col-lg-2 col-md-2">
                                <a href="form-member.php?id_member=<?php echo $member["id_member"];?>">
                                    <button class="btn btn-block btn-primary mb-2">
                                        Edit
                                    </button>
                                </a>
                                <a href="delete-member.php?id_member=<?=$member["id_member"];?>">
                                    <button class="btn btn-block btn-danger">
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