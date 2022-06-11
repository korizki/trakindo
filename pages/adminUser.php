<main>
    <div class="container-top">
        <div>
            <h1>Selamat Datang Administrator</h1>
            <h3><?php  echo $company ?></h3>
            <p style="line-height: 1.5rem">Anda bisa memberikan response/tanggapan terhadap request yang telah dibuat oleh User, dan melakukan update terhadap status request menjadi <strong>Close</strong>, jika telah dilakukan tindakan/action oleh Teknisi.</p>
        </div>
        <div class="content">
            <div class="sumTicket" id="ticket1">
                <p>Request Baru</p>
                <h3><?php echo $ticket_created['TOTAL'] === "" ? 0 : $ticket_created['TOTAL'] ?></h3>
                <img src="../assets/icons/create.png" alt="icon">
            </div>
            <div class="sumTicket" id="ticket2">
                <p>Request Ditanggapi</p>
                <h3><?php echo $ticket_pending['TOTAL'] === "" ? 0 : $ticket_pending['TOTAL'] ?></h3>
                <img src="../assets/icons/pending.png" alt="icon" style="width: 120px; margin-top: -30px">
            </div>
            <div class="sumTicket" id="ticket3">
                <p>Request Selesai</p>
                <h3><?php echo $ticket_closed['TOTAL'] === "" ? 0 : $ticket_closed['TOTAL'] ?></h3>
                <img src="../assets/icons/finish.png" alt="icon">
            </div>
        </div>
    </div>
    
    <?php 
        if(isset($_GET['status'])){
            if($_GET['status'] === 'create-ticket-success'){
                echo "
                <p class='infoCreate' id='status'>
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
                <p class='infoCreate failed' id='statusf'>
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
        <h1>Monitoring Request</h1>
        <div class="secondBox">
            <div class="contentBox" id="content1">
                <img src="../assets/images/s1.svg" alt="illustration">
                <div>
                    <h2>Request Dibuat</h2>
                    <p>Anda bisa melihat daftar request yang dibuat oleh User, dan memberikan tanggapan/response.</p>
                    <a href="?page=ticket-pending"><i class="fi fi-rs-search adjust"></i>Cek Request</a>
                </div>
            </div>
            <div class="contentBox" id="content2">
                <img src="../assets/images/s2.svg" alt="illustration">
                <div>
                    <h2>Daftar Semua Request</h2>
                    <p>Lihat semua request dengan dengan status Menunggu Response, Menunggu Teknisi, ataupun Selesai/Closed.</p>
                    <a href="?page=all-ticket"><i class="fi fi-rs-search adjust"></i>Cek Semua Request</a>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    document.getElementById('date').value = new Date().toLocaleDateString('en-CA');
</script>
