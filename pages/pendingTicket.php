<div style="display: flex; flex-direction: column; justify-content: space-between; height: 100vh">
    <div class="pendingBox">
        <h1>Ticket Dalam Proses</h1>
        <div class="ticketResult">
            <?php 
                $query = mysqli_query($connect, "SELECT * FROM tickets WHERE requestor = '$username' AND status != 'Closed'");
                if(mysqli_num_rows($query) === 0){
                    echo "
                        <div class='emptyresult'>
                            <img src='../assets/images/notfound.svg' alt='illustration'/>
                            <h1>Data ticket tidak ditemukan!</h1>
                        </div>
                    ";
                }
                while($row = mysqli_fetch_array($query)){
                    ?>
                    <div class="item">
                        <div>
                            <img src="../assets/icons/finish.png" alt="icon">
                            <div>
                                <p>Nomor Ticket : <?php echo $row['ticket_id']?> - <?php echo date_format(date_create($row['req_date']), "d F Y")?></p>
                                <h1>Serial Number Unit : <?php echo $row['sn_unit']?></h1>
                                <h3><?php echo $_SESSION['logged_user_comp']?></h3>
                                <h3><?php echo $row['job_type']?></h3>
                                <h3 style="margin-left: 10px;"><i class="fi fi-rs-phone-call adjust"></i> <?php echo $row['cp_phone']?> <span style="margin-left: 30px;"></span> <i class="fi fi-rs-envelope adjust"></i><?php echo $row['cp_email']?></h3>
                            </div>
                        </div>
                        <p><i class="fi fi-rs-edit adjust"></i><?php echo $row['status']?></p>
                    </div>
                    <?php
                }
            ?>
            <a href="summary.php">Kembali ke Halaman Utama</a>
        </div>
    </div>
<div>