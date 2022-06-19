<?php 
    // memeriksa jenis / tipe user
    if($_SESSION['logged_user_type'] === 'user'){
        // membuat function countData()
        function countData($status, $username){
            // menggunakan file koneksi.php
            include "connection.php";
            // mengembalikan query
            return mysqli_query($connect, "SELECT COUNT(ticket_id) AS TOTAL FROM tickets WHERE requestor = '$username' AND status = '$status'");
        }
        $ticket_created = mysqli_fetch_assoc(countData('Created', $username));
        include "connection.php";
        // query filter data
        $querycount = mysqli_query($connect, "SELECT COUNT('ticket_id') AS TOTAL FROM tickets WHERE requestor = '$username' AND status IN('Waiting Quote','Waiting Quote Approval/PO, Waiting Schedule Program','Waiting Technician','In Progress Perform') ");
        // mendapatkan jumlah ticket pending
        $ticket_pending = mysqli_fetch_assoc($querycount);
        // mendapatkan jumlah ticket closed
        $queryclose = mysqli_query($connect, "SELECT COUNT('ticket_id') AS TOTAL FROM tickets WHERE requestor = '$username' AND status IN('Advice Only','Closed')");
        $ticket_closed = mysqli_fetch_assoc($queryclose);
    } else if($_SESSION['logged_user_type'] === 'Administrator'){
        // membuat function countData() jika user adalah admin
        function countData($status){
            include "connection.php";
            return mysqli_query($connect, "SELECT COUNT(ticket_id) AS TOTAL FROM tickets WHERE status = '$status'");
        }
        // mendapatkan data ticket dibuat
        $ticket_created = mysqli_fetch_assoc(countData('Created', $username));
        include "connection.php";
        // mendapatkan jumlah data ticket on progress
        $querycount = mysqli_query($connect, "SELECT COUNT('ticket_id') AS TOTAL FROM tickets WHERE status IN('Waiting Quote','Waiting Quote Approval/PO, Waiting Schedule Program','Waiting Technician','In Progress Perform') ");
        $ticket_pending = mysqli_fetch_assoc($querycount);
        // mendapatkan jumlah ticket closed
        $queryclose = mysqli_query($connect, "SELECT COUNT('ticket_id') AS TOTAL FROM tickets WHERE status IN('Advice Only','Closed') ");
        $ticket_closed = mysqli_fetch_assoc($queryclose);
    }
    

?>