<div class="boxres" id="boxreq">
    <?php 
        include "../controller/connection.php";
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $getdata = mysqli_query($connect, "SELECT * FROM tickets WHERE ticket_id = $id");
            $row = mysqli_fetch_assoc($getdata);
        }
    ?>
    <div class="formres">
        <h1>Form Update Request</h1>
        <form action="../controller/submitResponse.php" method="post">
            <div class="inputBox">
                <label for="idrequest">Request ID</label>
                <input class="dis" id="idrequest" name="idrequest" type="text" value="<?php echo $_GET['id']?>" required readonly>
            </div>
            <div class="inputBox">
                <label for="dateresponse">Tanggal Respon</label>
                <input class="dis" type="text" id="dateresponse" name="dateresponse" required readonly>
            </div>
            <div class="inputBox">
                <label for="statusreq">Status Request</label>
                <select name="statusreq" id="statusreq" onChange="checkval()" required>
                    <option value="Advice Only">Advice Only</option>
                    <option value="Waiting Quote">Waiting Quote</option>
                    <option value="Waiting Quote Approval/PO">Waiting Quote Approval/PO</option>
                    <option value="Waiting Schedule Perform">Waiting Schedule Perform</option>
                    <option value="Waiting Technician">Waiting Technician</option>
                    <option value="In Progress Perform">In Progress Perform</option>
                    <option value="Closed">Closed</option>
                </select>
            </div>
            <div class='inputBox' id="inputso">
                <label for='nomorso'>Nomor Quote / SO</label>
                <input type='text' id='nomorso' name='nomorso' >
            </div>
            <div class='inputBox' id="inputtech">
                <label for='namateknisi'>Nama Teknisi</label>
                <input type='text' id='namateknisi' name='namateknisi'>
            </div> 
            <div class="inputBox">
                <label for="info">Catatan Tambahan</label>
                <input type="text" id="info" name="info" >
            </div>
            <button type="submit" class="subres" name="subres"><i class="fi fi-rs-check adjust"></i> Update Request Status</button>
            <a href="?page=ticket-pending" onClick="hidereq()">Batal</a>
        </form>
        <script>
            function checkval(e){
                if(document.getElementById('statusreq').value === "Waiting Quote Approval/PO" || document.getElementById('statusreq').value === "In Progress Perform"){
                    document.getElementById('inputso').style.display = "flex";
                    document.getElementById('inputtech').style.display ="flex";
                } else if(document.getElementById('statusreq').value === "Waiting Schedule Perform" || document.getElementById('statusreq').value === "Waiting Technician") {
                    document.getElementById('inputso').style.display = "flex";
                    document.getElementById('inputtech').style.display ="none";
                } else {
                    document.getElementById('inputso').style.display = "none";
                    document.getElementById('inputtech').style.display ="none";
                }
            }
        </script>
    </div>
</div>
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
                }
            }
            if(isset($_GET['closed-request'])){
                if($_GET['closed-request'] === 'success'){
                    echo "
                        <p class='infores'>Status request berhasil diupdate menjadi Closed, Terima Kasih</p>
                    ";
                } else {
                    echo "
                        <p class='infores'>Gagal menyelesaikan Request.</p>
                    ";
                }
            }
            echo "
                    <script>
                        setTimeout( () => {
                            document.querySelector('.infores').style.display = 'none';
                        },2500)
                    </script>
                ";
        ?>
        
        <h1>Ticket Dalam Proses</h1>
        <div class="ticketResult">
            <?php 
                include "../controller/connection.php";
                $query = mysqli_query($connect, "SELECT * FROM tickets INNER JOIN user ON tickets.requestor = user.user_name WHERE status IN('Created','Waiting Quote','Waiting Quote Approval/PO','Waiting Schedule Perform','Waiting Technician','In Progress Perform') ORDER BY status ASC");
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
                        <div class="boxbtn">
                            <a class='admupdate' href='?page=ticket-pending&update=yes&id=<?php echo $row['ticket_id']; ?>' ><i class='fi fi-rs-comment adjusts'></i> Update Request</a>
                        </div>
                    </div>
                    <?php
                }
            ?>
            <a href="summary.php">Kembali ke Halaman Utama</a>
        </div>
    </div>
<div>



<script>
    function hidereq(){
        document.getElementById('boxreq').style.display = 'none';
    }
    document.getElementById('dateresponse').value = new Date().toLocaleDateString('en-CA');
</script>
