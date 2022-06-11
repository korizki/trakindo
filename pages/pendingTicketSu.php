<div style="display: flex; flex-direction: column; justify-content: space-between; height: 100vh">
    <div class="pendingBox">
        <?php 
            if(isset($_GET['submit-respon'])){
                if($_GET['submit-respon'] === 'success'){
                    echo "
                        <p class='infores'>Request berhasil direspon, Terima Kasih.</p>
                    ";
                } else if($_GET['submit-respon'] === 'failed'){
                    echo "
                        <p class='infores resred'>Submit respon atas request gagal. </p>
                    ";
                } else if($_GET['closed-request'] === 'success'){
                    echo "
                        <p class='infores'>Status request berhasil diupdate menjadi Closed, Terima Kasih</p>
                    ";
                } else if($_GET['closed-request'] === 'failed'){
                    echo "
                        <p class='infores'>Gagal menyelesaikan Request.</p>
                    ";
                }
                echo "
                    <script>
                        setTimeout( () => {
                            document.querySelector('.infores').style.display = 'none';
                        },2500)
                    </script>
                ";
            }
        ?>
        
        <h1>Ticket Dalam Proses</h1>
        <div class="ticketResult">
            <?php 
                include "../controller/connection.php";
                $query = mysqli_query($connect, "SELECT * FROM tickets INNER JOIN user ON tickets.requestor = user.user_name WHERE status != 'Closed' ORDER BY status ASC");
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
                                        <h3 class="uniq <?php echo $row['status']?>"><i class="fi fi-rs-edit adjust"></i><?php echo $row['status']?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="boxcom">
                                <p>Nomor Ticket : <?php echo $row['ticket_id']?> - <?php echo date_format(date_create($row['req_date']), "d F Y")?></p>
                                <h2 class="admcomp"><?php echo $row['company']?></h2>
                                <h3 style="font-style: italic">" <?php echo $row['job_type']?> "</h3>
                            </div>
                        </div>
                        <div style="flex-direction: column; gap: 15px; align-items: center;">
                            <?php 
                                $idticket = $row['ticket_id'];
                                if($row['status'] === 'Created'){
                                    echo "
                                        <a class='admupdate' href='?page=ticket-pending&update=yes&id=$idticket' ><i class='fi fi-rs-comment adjusts'></i> Berikan Tanggapan</a>
                                        <a class='admupdate close' onClick=\"return confirm('Apakah request telah selesai?')\" href='../controller/processClose.php?id=$idticket'><i class='fi fi-rs-shield-check adjust'></i> Request Selesai</a>
                                    ";
                                } else if($row['status'] === 'Wait Technician'){
                                    echo "
                                        <a class='admupdate close' onClick=\"return confirm('Apakah request telah selesai?')\" href='../controller/processClose.php?id=$idticket'><i class='fi fi-rs-shield-check adjust'></i> Request Selesai</a>
                                    ";
                                }
                                ?>
                        </div>
                    </div>
                    <?php
                }
            ?>
            <a href="summary.php">Kembali ke Halaman Utama</a>
        </div>
    </div>
    <div class="boxres" id="boxreq">
        <div class="formres">
            <h1>Form Response Request</h1>
            <form action="../controller/submitResponse.php" method="post">
                <div class="inputBox">
                    <label for="idrequest">Request ID</label>
                    <input id="idrequest" name="idrequest" type="text" value="<?php echo $_GET['id']?>" required readonly>
                </div>
                <div class="inputBox">
                    <label for="dateresponse">Tanggal Respon</label>
                    <input type="text" id="dateresponse" name="dateresponse" required readonly>
                </div>
                <div class="inputBox">
                    <label for="nomorso">Nomor SO</label>
                    <input type="text" id="nomorso" name="nomorso" required>
                </div>
                <div class="inputBox">
                    <label for="namateknisi">Nama Teknisi</label>
                    <input type="text" id="namateknisi" name="namateknisi" required>
                </div>
                <button type="submit" class="subres" name="subres"><i class="fi fi-rs-check adjust"></i> Submit Respon</button>
                <a href="?page=ticket-pending" onClick="hidereq()">Batal</a>
            </form>
        </div>
    </div>
<div>
<?php 
    if(isset($_GET['update'])){
        if($_GET['update'] === 'yes'){
        echo "
            <script>
                document.getElementById('boxreq').style.display = 'block';
            </script>
        ";    
    }
}
?>
<script>
    function hidereq(){
        document.getElementById('boxreq').style.display = 'none';
    }
    document.getElementById('dateresponse').value = new Date().toLocaleDateString('en-CA');
</script>