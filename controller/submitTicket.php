<?php
    include "connection.php";
    // validasi session
    session_start();
    if(empty($_SESSION['logged_user'])){
        // jika tidak ada user di session maka redirect ke halaman login
        header("Location: ../index.php");
    } else {
        $username = $_SESSION['logged_user'];
        $company = $_SESSION['logged_user_comp'];
        $type = $_SESSION['logged_user_type'];
        // jika tombol submit / create tricket ditekan maka
        if(isset($_POST['createTicket'])){
            $sn = $_POST['sn'];
            $job = $_POST['job'];
            $date = $_POST['date'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            // eksekusi query tambah data ke tabel
            $query = mysqli_query($connect, "INSERT INTO tickets VALUES(null,'$username', '$sn', '$job','$date','$email','$phone','Created') ");
            if($query){
                // jika berhasil munculkan pesan sukses
                header("Location: ../pages/summary.php?status=create-ticket-success#status");
            } else {
                // jika gagal munculkan pesan error
                header("Location: ../pages/summary.php?status=create-ticket-failed#status");
            }    
        } else {
            // redirect ke homepage
            header("Location: ../index.php");
        }
    }; 

?>