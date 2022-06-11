<?php 
    if($_SESSION['logged_user_type'] === 'user'){
        function countData($status, $username){
            include "connection.php";
            return mysqli_query($connect, "SELECT COUNT(ticket_id) AS TOTAL FROM tickets WHERE requestor = '$username' AND status = '$status'");
        }
        $ticket_created = mysqli_fetch_assoc(countData('Created', $username));
        $ticket_pending = mysqli_fetch_assoc(countData('Wait Technician', $username));
        $ticket_closed = mysqli_fetch_assoc(countData('Closed', $username));
    } else if($_SESSION['logged_user_type'] === 'Administrator'){
        function countData($status){
            include "connection.php";
            return mysqli_query($connect, "SELECT COUNT(ticket_id) AS TOTAL FROM tickets WHERE status = '$status'");
        }
        $ticket_created = mysqli_fetch_assoc(countData('Created', $username));
        $ticket_pending = mysqli_fetch_assoc(countData('Wait Technician', $username));
        $ticket_closed = mysqli_fetch_assoc(countData('Closed', $username));
    }
    

?>