<?php
include("../connection.php");

if (isset($_POST["simpan_member"])) {
    // tampung data input member dari user
    
    $nama_member = $_POST["nama_member"];
    $alamat = $_POST["alamat"];
    $tlp = $_POST["tlp"];
    $jenis_kelamin = $_POST["jenis_kelamin"];

    //membuat perintah sql untuk insert data ke table member
    $sql = "insert into member values
    ('','$nama_member','$alamat','$tlp','$jenis_kelamin')";

    //eksekusi perintah sql
    $tambah = mysqli_query($connect, $sql);

    //direct ke halaman list-member
    if ($tambah) {
        header('Location:list-member.php');
    } else {
        printf('Gagal'.mysqli_error($connect));
        exit();
    }

# untuk update

}else if(isset($_POST["edit_member"])){
        # menampung dulu data yang akan di update
        $id_member = $_POST["id_member"];
        $nama_member = $_POST["nama_member"];
        $alamat = $_POST["alamat"];
        $tlp = $_POST["tlp"];

        $sql = "update member set nama_member='$nama_member', alamat='$alamat',
        tlp='$tlp', jenis_kelamin='$jenis_kelamin' where id_member='$id_member'";
        
        $edit = mysqli_query($connect, $sql);
        
        if ($edit) {
            header('Location:list-member.php');
        } else {
            printf('Gagal'.mysqli_error($connect));
            exit();
        }
        
}
?>