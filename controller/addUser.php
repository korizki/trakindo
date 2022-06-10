<?php 
// meload koneksi ke database
    include "connection.php";
    // jika tombol tambah user ditekan maka process code berikut
    if(isset($_POST['add-user'])){
        // mendapatkan nilai inputan pada field input
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $company = $_POST['company'];
        // ekseskusi code untuk menambahkan user ke database
        $queryAddUser = mysqli_query($connect, "INSERT INTO user VALUES(NULL, '$username', '$password', 'user', '$company' ) ");
        // jika berhasil maka diarahkan ke homepage dengan pesan berhasil tambah data
        if($queryAddUser){
            header("Location:  ../index.php?status=successadd#add");
        } else {
        // munculkan pesan gagal 
            echo " Gagal Tambah Username";
        }
    } else {
        // diarahkan ke homepage
        header("Location:  ../index.php");
    };
?>