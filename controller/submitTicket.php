<?php
    // validasi session
    session_start();
    if(isset($_SESSION['logged_user'])){
        $username = $_SESSION['logged_user'];
        $company = $_SESSION['logged_user_comp'];
        $type = $_SESSION['logged_user_type'];
    } else {
        header("Location: ../index.php");
    };
    
?>