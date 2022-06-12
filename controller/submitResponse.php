<?php 
    include "connection.php";
    if(isset($_POST['subres'])){
        $id = $_POST['idrequest'];
        $date = $_POST['dateresponse'];
        $statusreq = $_POST['statusreq'];
        $note = $_POST['info'];

        if($statusreq != "Waiting Quote Approval/PO" ){
            if($statusreq === "Advice Only"){
                // cari data tanggal dibuat
                $getdataticket = mysqli_query($connect, "SELECT * FROM tickets WHERE ticket_id = $id");
                $row = mysqli_fetch_assoc($getdataticket);
                $datereq = $row['req_date'];
                // tambahkan data baru ke tabel history
                $queryadd = mysqli_query($connect, "INSERT INTO history(request_id, date_request,advice_date,advice_note) VALUES($id,'$datereq','$date','$note')");
            } else if($statusreq === "Waiting Quote") {
                // update tabel history
                $updatehis = mysqli_query($connect, "UPDATE history SET quote_date = '$date', quote_note = '$note' WHERE request_id = $id ");
            } else if($statusreq === "Waiting Schedule Perform"){
                $nomorso = $_POST['nomorso'];
                $updatehis = mysqli_query($connect, "UPDATE history SET schedule_date = '$date', schedule_note = '$note', schedule_so = '$nomorso' WHERE request_id = $id ");
            } else if($statusreq === "Waiting Technician"){
                $nomorso = $_POST['nomorso'];
                $updatehis = mysqli_query($connect, "UPDATE history SET waittech_date = '$date', waittech_note = '$note', waittech_so = '$nomorso' WHERE request_id = $id ");
            } else if($statusreq === "In Progress Perform"){
                $nomorso = $_POST['nomorso'];
                $namateknisi = $_POST['namateknisi'];
                $updatehis = mysqli_query($connect, "UPDATE history SET progress_date = '$date', progress_note = '$note', progress_so = '$nomorso', progress_tech = '$namateknisi' WHERE request_id = $id ");
            } else if($statusreq === "Closed"){
                $updatehis = mysqli_query($connect, "UPDATE history SET close_date = '$date', close_note = '$note' WHERE request_id = $id");
            };
        } else {
            $nomorso = $_POST['nomorso'];
            $namateknisi = $_POST['namateknisi'];
            // tambah data ke tabel response
            $queryadd = mysqli_query($connect, "INSERT INTO response VALUES('$id','$nomorso','$namateknisi','$date')");
            // update tabel history
            $updatehis = mysqli_query($connect, "UPDATE history SET quoteapp_date = '$date', quoteapp_note = '$note' WHERE request_id = $id");
        };
        // update status di tabel ticket
        $update = mysqli_query($connect, "UPDATE tickets SET status='$statusreq' WHERE ticket_id = '$id' ");
        if($update){
            header('Location: ../pages/summary.php?page=ticket-pending&submit-respon=success'); 
        } else {
            header('Location: ../pages/summary.php?page=ticket-pending&submit-respon=failed');
        }
    } else {
        header('Location: ../pages/summary.php');
    }
?>