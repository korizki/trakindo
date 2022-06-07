<?php 
    include "connection.php";
    if(isset($_POST['add-user'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $company = $_POST['company'];
        $queryAddUser = mysqli_query($connect, "INSERT INTO user VALUES(NULL, '$username', '$password', 'user', '$company' ) ");
        if($queryAddUser){
            header("Location:  ../index.php?status=successadd");
        } else {
            echo " Gagal Tambah Username";
        }
    } else {
        header("Location:  ../index.php");
    };
?>