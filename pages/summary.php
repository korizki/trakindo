<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summary Page - Trakindo MTS</title>
    <link rel="icon" href="../assets/icons/laptop.png" />
    <link rel="stylesheet" href="../assets/styles/app.css" />
    <link rel="stylesheet" href="../assets/styles/responsive.css" />
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
        include "../controller/summaryProcess.php";
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
    <nav class="navmobile">
        <a>
            <i class="fi fi-rs-home"></i>
            <p>Beranda</p>
        </a>
        <a>
            <i class="fi fi-rs-chart-histogram"></i>
            <p>Ticket Dibuat</p>
        </a>
        <a>
            <i class="fi fi-rs-list-check"></i>
            <p>Semua Ticket</p>
        </a>
        <a>
            <i class="fi fi-rs-sign-out-alt"></i>
            <p>Keluar</p>
        </a>
    </nav>
    <main>
        <div class="container-top">
            <div>
                <h1>Selamat Datang di Halaman Dashboard</h1>
                <h4>Berikut adalah rangkuman ticket request atas perusahaan</h4>
                <h3><?php  echo $company ?></h3>
                <p>Anda bisa membuat tiket baru ataupun mendapatkan informasi terkait status atau proses dari ticket request sebelumnya.</p>
                <a href="#createticket" onClick="showFormCreate('open')"><i class="fi fi-rs-envelope-plus adjusts" ></i> Buat Ticket/Request</a>
            </div>
            <div class="content">
                <div class="sumTicket" id="ticket1">
                    <p>Ticket Dibuat</p>
                    <h3><?php echo $ticket_created['TOTAL'] === "" ? 0 : $ticket_created['TOTAL'] ?></h3>
                    <img src="../assets/icons/create.png" alt="icon">
                </div>
                <div class="sumTicket" id="ticket2">
                    <p>Ticket Pending Action</p>
                    <h3><?php echo $ticket_pending['TOTAL'] === "" ? 0 : $ticket_pending['TOTAL'] ?></h3>
                    <img src="../assets/icons/pending.png" alt="icon" style="width: 120px; margin-top: -30px">
                </div>
                <div class="sumTicket" id="ticket3">
                    <p>Ticket Selesai</p>
                    <h3><?php echo $ticket_closed['TOTAL'] === "" ? 0 : $ticket_closed['TOTAL'] ?></h3>
                    <img src="../assets/icons/finish.png" alt="icon">
                </div>
            </div>
        </div>
        <div  id="createticket">
            <div class="addTicketBox">
                <h1><i class="fi fi-rs-document adjust"></i> Tambah Ticket Baru</h1>
                <form action="../controller/submitTicket.php" method="post" autocomplete="off">
                    <div class="inputBox">
                        <label for="sn">Serial Number Unit</label>
                        <input type="text" id="sn" name="sn" required>
                    </div>
                    <div class="inputBox">
                        <label for="company">Nama Perusahaan</label>
                        <input type="text" id="company" name="company" value="<?php echo $_SESSION['logged_user_comp'] ?>" disabled required>
                    </div>
                    <div class="inputBox">
                        <label for="job">Jenis Pekerjaan</label>
                        <input type="text" id="job" name="job" required>
                    </div>
                    <div class="inputBox">
                        <label for="date">Tanggal Permintaan</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div class="joinEmail">
                        <div class="inputBox">
                            <label for="email">Contact Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="inputBox">
                            <label for="phone">Contact Mobile Phone</label>
                            <input type="phone" id="phone" name="phone" required>
                        </div>
                    </div>
                    <button type="submit" name="createTicket" class="sendTicket">Submit Ticket</button>
                    <a href="#" onClick="showFormCreate('close')">Batal</a>
                </form>
            </div>
        </div>
        <?php 
            if(isset($_GET['status'])){
                if($_GET['status'] === 'create-ticket-success'){
                    echo "
                    <p class='infoCreate'>
                        Selamat, ticket berhasil dibuat dan akan segera diproses. Mohon bersabar menunggu response/update selanjutnya. Terima Kasih. 
                    </p>
                    <script>
                        const pesan = document.querySelector('.infoCreate');
                        pesan.style.transform = 'translateY(0)';
                        pesan.style.opacity = '1';
                        setTimeout(() => {
                            pesan.style.transform = 'translateY(-50px)';
                            pesan.style.opacity = '0';
                        },5000)
                    </script>
                    ";
                } else if($_GET['status'] === 'create-ticket-failed'){
                    echo "
                    <p class='infoCreate failed'>
                        Ticket gagal dibuat, mohon periksa kembali data yang diinput! 
                    </p>
                    <script>
                        const pesan = document.querySelector('.failed');
                        pesan.style.transform = 'translateY(0)';
                        pesan.style.opacity = '1';
                        setTimeout(() => {
                            pesan.style.transform = 'translateY(-50px)';
                            pesan.style.opacity = '0';
                        },5000)
                    </script>
                    ";
                };   
            }
        ?>
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
                        <a href="#"><i class="fi fi-rs-search adjust"></i>Cek Semua Ticket</a>
                    </div>
                </div>
            </div>
        </div>

    </main>
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
                <p>Icon's by <a>Flaticon<a> </p>
                <p>Illustration's by <a>Storyset<a> </p>
                <p>Background by <a>BGjar<a> </p>
            </div>
        </div>
        <h3 class="title">Maintenance Ticketing System - Trakindo Utama &copy; 2022</h3>
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
    </script>
</body>
</html>