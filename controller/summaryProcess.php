<?php 
    if($_SESSION['logged_user_type'] === 'user'){
        function countData($status, $username){
            include "connection.php";
            return mysqli_query($connect, "SELECT COUNT(ticket_id) AS TOTAL FROM tickets WHERE requestor = '$username' AND status = '$status'");
        }
        $ticket_created = mysqli_fetch_assoc(countData('Created', $username));
        include "connection.php";
        $querycount = mysqli_query($connect, "SELECT COUNT('ticket_id') AS TOTAL FROM tickets WHERE requestor = '$username' AND status IN('Advice Only','Waiting Quote','Waiting Quote Approval/PO, Waiting Schedule Program','Waiting Technician','In Progress Perform') ");

        $ticket_pending = mysqli_fetch_assoc($querycount);
        $ticket_closed = mysqli_fetch_assoc(countData('Closed', $username));
    } else if($_SESSION['logged_user_type'] === 'Administrator'){
        function countData($status){
            include "connection.php";
            return mysqli_query($connect, "SELECT COUNT(ticket_id) AS TOTAL FROM tickets WHERE status = '$status'");
        }
        $ticket_created = mysqli_fetch_assoc(countData('Created', $username));
        include "connection.php";
        $querycount = mysqli_query($connect, "SELECT COUNT('ticket_id') AS TOTAL FROM tickets WHERE status IN('Advice Only','Waiting Quote','Waiting Quote Approval/PO, Waiting Schedule Program','Waiting Technician','In Progress Perform') ");
        $ticket_pending = mysqli_fetch_assoc($querycount);
        $ticket_closed = mysqli_fetch_assoc(countData('Closed', $username));
    }
    

?>