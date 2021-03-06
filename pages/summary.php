<?php
    session_start();
    if(isset($_SESSION['logged_user'])){
        $username = $_SESSION['logged_user'];
        $company = $_SESSION['logged_user_comp'];
        $type = $_SESSION['logged_user_type'];
    } else {
        header("Location: ../index.php");
    };
    include "../controller/summaryProcess.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summary Page - Trakindo</title>
    <link rel="icon" href="../assets/icons/laptop.png" />
    <link rel="stylesheet" href="../assets/styles/app.css" />
    <link rel="stylesheet" href="../assets/styles/responsive.css" />
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;400;600&display=swap" rel="stylesheet">
</head>
<style>
    a{
        text-decoration: none;
        color: inherit;
    }
    a:focus{
        box-shadow: none;
        background: none;
        color: inherit;
    }
</style>
<body>
    <nav class="nav">
        <div class="leftNav">
            <img src="../assets/icons/trakindo.png" alt="logo">
        </div>
        <div class="rightNav">
            <h4>Selamat datang <?php echo $username ?> </h4>
            <a href="../index.php?status=loggedout" onClick="return confirm('Anda yakin ingin Log Out?')"><i class="fi fi-rs-sign-out-alt adjust"></i> Log Out</a>
        </div>
    </nav>
    <nav class="navmobile">
        <a href="summary.php" class="navitem" id="btnhome" onClick="activebtn('btnhome')">
            <i class="fi fi-rs-home"></i>
            <p>Beranda</p>
        </a>
        <a href="?page=ticket-pending" class="navitem" id="btnticket" onClick="activebtn('btnticket')">
            <i class="fi fi-rs-chart-histogram"></i>
            <p>Request Dibuat</p>
        </a>
        <a href="?page=all-ticket" class="navitem" id="btntickets" onClick="activebtn('btntickets')">
            <i class="fi fi-rs-list-check"></i>
            <p>Semua Request</p>
        </a>
        <a class="navitem" id="btnout" onClick="return confirm('Anda yakin ingin Log Out?')" href="../index.php?status=loggedout">
            <i class="fi fi-rs-sign-out-alt"></i>
            <p>Keluar</p>
        </a>
    </nav>
    <script>
        function clickbtn(param){
            document.getElementById('btnticket').style.color = "rgb(163,163,163)";
            document.getElementById('btntickets').style.color = "rgb(163,163,163)";
            document.getElementById('btnhome').style.color = "rgb(163,163,163)";
            document.getElementById('btnout').style.color = "rgb(163,163,163)";
            document.getElementById(param).style.color = "var(--kuning)";
        }
    </script>
    <?php
    // memeriksa user type
        if($_SESSION['logged_user_type'] === 'user'){ 
            if(isset($_GET['page'])){
                $page = $_GET['page'];
                switch ($page) {
                    case "ticket-pending" : 
                        include "pendingTicket.php";
                        echo "<script>clickbtn('btnticket')</script>";
                        break;
                    case "all-ticket" : 
                        include "allTicket.php";
                        echo "<script>clickbtn('btntickets')</script>";
                        break;
                }
            } else {
                // mengembalikan ke halaman home
                include "commonUser.php";
                echo "<script>clickbtn('btnhome')</script>";
            };
        } else if($_SESSION['logged_user_type'] === 'Administrator'){
            if(isset($_GET['page'])){
                $page = $_GET['page'];
                switch ($page) {
                    case "ticket-pending" : 
                        include "pendingTicketSu.php";
                        echo "<script>clickbtn('btnticket')</script>";
                        break;
                    case "all-ticket" : 
                        include "allTicket.php";
                        echo "<script>clickbtn('btntickets')</script>";
                        break;
                }
            } else {
                include "adminUser.php";
                echo "<script>clickbtn('btnhome')</script>";
            }
        }
    ?>
    
    <footer class="sumfooter">
        <div class="footerbox">
            <div class="footersection">
                <h3>Trakindo Utama Muara Enim</h3>
                <p><i class="fi fi-rs-marker adjust"></i>  Jl. Lintas Prabumulih - Muara Enim, Sumatera Selatan. </p>
                <p><i class="fi fi-rs-phone-call adjust"></i> (0734) 4252824 </p>
                <p><i class="fi fi-rs-globe adjust" ></i><a style="text-decoration: none; color: inherit" href="https://www.trakindo.co.id" target="_blank"> www.trakindo.co.id </a></p>
            </div>
            <div class="footersection">
                <h3>Resource</h3>
                <p>Icon's by <a href="https://www.flaticon.com/">Flaticon</a> </p>
                <p>Illustration's by <a href="https://storyset.com/">Storyset</a> </p>
                <p>Background by <a href="https://bgjar.com/">BGjar</a> </p>
            </div>
        </div>
        <h3 class="title">Technician Request - Trakindo Utama Muara Enim &copy; 2022</h3>
    </footer>
    
    
    <script>
        function showFormCreate(param){
            const formCreate = document.getElementById('createticket');
            if(param === 'open'){
                formCreate.style.height = "100%";
            } else {
                formCreate.style.height = "0";
            }
        }
        function activebtn(param){
            document.getElementById('btnticket').style.color = "rgb(163,163,163)";
            document.getElementById('btntickets').style.color = "rgb(163,163,163)";
            document.getElementById('btnhome').style.color = "rgb(163,163,163)";
            document.getElementById('btnout').style.color = "rgb(163,163,163)";
            document.getElementById(param).style.color = "var(--kuning)";
        }
        
    </script>
</body>
</html>