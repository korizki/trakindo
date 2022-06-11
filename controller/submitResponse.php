<?php 
    include "connection.php";
    if(isset($_POST['subres'])){
        $id = $_POST['idrequest'];
        $date = $_POST['dateresponse'];
        $nomorso = $_POST['nomorso'];
        $namateknisi = $_POST['namateknisi'];
        $query = mysqli_query($connect, "INSERT INTO response VALUES('$id','$nomorso','$namateknisi','$date') ");
        if($query){
            $update = mysqli_query($connect, "UPDATE tickets SET status='Wait Technician' WHERE ticket_id = '$id' ");
            if($update){
                header('Location: ../pages/summary.php?page=ticket-pending&submit-respon=success');    
            }
        } else {
            header('Location: ../pages/summary.php?page=ticket-pending&submit-respon=failed');
        }
    } else {
        header('Location: ../pages/summary.php');
    }
?>