<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summary Page - Trakindo MTS</title>
    <link rel="icon" href="../assets/icons/laptop.png" />
    <link rel="stylesheet" href="../assets/styles/app.css" />

</head>
<body>
    <!-- validasi session -->
    <?php
        session_start();
        if(isset($_SESSION['logged_user'])){
            $username = $_SESSION['logged_user'];
            $company = $_SESSION['logged_user_comp'];
            $type = $_SESSION['logged_user_type'];
        } else {
            header("Location: ../index.php");
        };
    ?>
    <nav class="nav">
        <div class="leftNav">
            <img src="../assets/icons/trakindo.png" alt="logo">
        </div>
        <div class="rightNav">
            <h4>Anda Log In sebagai, <?php echo $username ?> </h4>
            <a href="../index.php?status=loggedout" onClick="return confirm('Anda yakin ingin Log Out?')"><i class="fi fi-rs-sign-out-alt adjust"></i> Log Out</a>
        </div>
    </nav>
    <main>
        <div class="container-top">
            <div>
                <h1>Selamat Datang di Halaman Dashboard</h1>
                <h4>Berikut adalah rangkuman ticket request atas perusahaan</h4>
                <h3><?php  echo $company ?></h3>
                <p>Anda bisa membuat tiket baru ataupun mendapatkan informasi terkait status atau proses dari ticket request sebelumnya.</p>
                <button><i class="fi fi-rs-envelope-plus adjusts" ></i> Buat Ticket/Request</button>
            </div>
            <div class="content">
                <div class="sumTicket" id="ticket1">
                    <p>Ticket Dibuat</p>
                    <h3>3</h3>
                    <img src="../assets/icons/create.png" alt="icon">
                </div>
                <div class="sumTicket" id="ticket2">
                    <p>Ticket Pending Action</p>
                    <h3>1000</h3>
                    <img src="../assets/icons/pending.png" alt="icon" style="width: 120px; margin-top: -30px">
                </div>
                <div class="sumTicket" id="ticket3">
                    <p>Ticket Selesai</p>
                    <h3>10</h3>
                    <img src="../assets/icons/finish.png" alt="icon">
                </div>
            </div>
        </div>
        <div class="container-down">
            <h1>Monitoring Ticket</h1>
            <div class="secondBox">
                <div class="contentBox" id="content1">
                    <img src="../assets/images/s1.svg" alt="illustration">
                    <div>
                        <h2>Daftar Ticket Dibuat</h2>
                        <p>Anda bisa melihat status dan daftar ticket yang telah dibuat sebelumnya.</p>
                        <a href="#"><i class="fi fi-rs-search adjust"></i>Cek Ticket</a>
                    </div>
                </div>
                <div class="contentBox" id="content2">
                    <img src="../assets/images/s2.svg" alt="illustration">
                    <div>
                        <h2>Daftar Semua Ticket</h2>
                        <p>Lihat daftar atas semua ticket yang pernah anda buat sebelumnya.</p>
                        <a href="#"><i class="fi fi-rs-search adjust"></i>Cek Ticket</a>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <footer>
        Maintenance Ticketing System - Trakindo Utama &copy; 2022
    </footer>
</body>
</html>