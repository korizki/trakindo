<?php
    session_start();
    include "connection.php";
    if(isset($_SESSION['logged_user'])){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = mysqli_query($connect, "UPDATE tickets SET status='Closed' WHERE ticket_id = '$id' ");
            if($query){
                header("Location: ../pages/summary.php?page=ticket-pending&closed-request=success");
            } else {
                header("Location: ../pages/summary.php?page=ticket-pending&closed-request=failed");
            }
        } else {
            header("Location: ../pages/summary.php?page=ticket-pending");
        }
    } else {
        header("Location: ../index.php");
    };
?>