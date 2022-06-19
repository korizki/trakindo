<?php
    session_start();
    // menggunakan file connection.php
    include "connection.php";
    if(isset($_SESSION['logged_user'])){
        // memeriksa apakah id telah diset 
        if(isset($_GET['id'])){
            // mendapatkan nilai id dari method get 
            $id = $_GET['id'];
            // query update status ticket
            $query = mysqli_query($connect, "UPDATE tickets SET status='Closed' WHERE ticket_id = '$id' ");
            if($query){
                // jika berhasil redirect ke summary dengan parameter close ticket berhasil
                header("Location: ../pages/summary.php?page=ticket-pending&closed-request=success");
            } else {
                // jika gagal redireect ke summary page dengan parameter close ticket gagal
                header("Location: ../pages/summary.php?page=ticket-pending&closed-request=failed");
            }
        } else {
            header("Location: ../pages/summary.php?page=ticket-pending");
        }
    } else {
        header("Location: ../index.php");
    };
?>