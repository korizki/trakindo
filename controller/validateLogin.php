<?php 
// koneksi ke database
    include "connection.php";
    // jika tombol login ditekan makan proses code berikut
    if(isset($_POST['loginBtn'])){
        // dapatkan data yang disubmit dari input 
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        // membuat query cari user dengan password yang diinput
        $query = "SELECT * from user WHERE user_name = '$username' AND password = '$password' ";
        // process query 
        $queryCheckUser = mysqli_query($connect, $query);
        // jika tidak ditemukan kembalikan ke homepage
        if(mysqli_num_rows($queryCheckUser) === 0){
            header("Location: ../index.php?status=loginfailed");
        } else {
            // jika user ada, maka mulai session dengan menyimpan data login di session
            session_start();
            $row = mysqli_fetch_array($queryCheckUser, MYSQLI_ASSOC);
            $_SESSION['logged_user'] = $username;
            $_SESSION['logged_user_comp'] = $row['company'];
            $_SESSION['logged_user_type'] = $row['type'];
            header("Location: ../pages/summary.php");
        }
        // jika tombol login belum ditekan / akses langsung ke file directory maka kembalikan ke homepage
    } else {
        header("Location: ../index.php");
    };

?>