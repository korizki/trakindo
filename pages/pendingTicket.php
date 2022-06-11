<div style="display: flex; flex-direction: column; justify-content: space-between; height: 100vh">
    <div class="pendingBox">
        <h1>Request Dalam Proses</h1>
        <div class="ticketResult">
            <?php 
                include "../controller/connection.php";
                $query = mysqli_query($connect, "SELECT * FROM tickets WHERE requestor = '$username' AND status != 'Closed' ORDER BY status ASC");
                if(mysqli_num_rows($query) === 0){
                    echo "
                        <div class='emptyresult'>
                            <img src='../assets/images/notfound.svg' alt='illustration'/>
                            <h1>Data request tidak ditemukan!</h1>
                        </div>
                    ";
                }
                while($row = mysqli_fetch_array($query)){
                    ?>
                    <div class="item">
                        <div>
                            <div class="boxin">
                                <img class="icontick" src="../assets/icons/finish.png" alt="icon">
                                <div>
                                    <h1>ID Unit : <?php echo $row['sn_unit']?></h1>
                                    <div>
                                        <h3><i class="fi fi-rs-phone-call adjust"></i> <?php echo $row['cp_phone']?> </h3>
                                        <h3> <i class="fi fi-rs-envelope adjust"></i><?php echo $row['cp_email']?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="boxcom">
                                <p>Nomor Request : <?php echo $row['ticket_id']?> - <?php echo date_format(date_create($row['req_date']), "d F Y")?></p>
                                <h2><?php echo $_SESSION['logged_user_comp']?></h2>
                                <h3 style="font-style: italic">" <?php echo $row['job_type']?> "</h3>
                            </div>
                        </div>
                        <p class="<?php echo $row['status'] ?>"><i class="fi fi-rs-edit adjust"></i><?php echo $row['status']?></p>
                    </div>
                    <?php
                }
            ?>
            <a href="summary.php">Kembali ke Halaman Utama</a>
        </div>
    </div>
<div>