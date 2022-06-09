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
                    <input type="date" id="date" name="date" required readonly>
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
                <a href="#" style="text-decoration: none; color: inherit" onClick="showFormCreate('close')">Batal</a>
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
                    <a href="?page=ticket-pending"><i class="fi fi-rs-search adjust"></i>Cek Ticket</a>
                </div>
            </div>
            <div class="contentBox" id="content2">
                <img src="../assets/images/s2.svg" alt="illustration">
                <div>
                    <h2>Daftar Semua Ticket</h2>
                    <p>Lihat daftar atas semua ticket yang pernah anda buat sebelumnya.</p>
                    <a href="?page=all-ticket"><i class="fi fi-rs-search adjust"></i>Cek Semua Ticket</a>
                </div>
            </div>
        </div>
    </div>
</main>
