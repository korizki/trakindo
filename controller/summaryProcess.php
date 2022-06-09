<?php 
    include "connection.php";
    function countData($status, $username){
        include "connection.php";
        return mysqli_query($connect, "SELECT COUNT(ticket_id) AS TOTAL FROM tickets WHERE requestor = '$username' AND status = '$status'");
    }
    $ticket_created = mysqli_fetch_assoc(countData('Created', $username));
    $ticket_pending = mysqli_fetch_assoc(countData('Wait Technisian', $username));
    $ticket_closed = mysqli_fetch_assoc(countData('Closed', $username));
    

?>