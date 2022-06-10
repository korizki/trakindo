<div style="display: flex; flex-direction: column; justify-content: space-between; height: 100vh">
    <div class="pendingBox  ">
        <h1>Semua Ticket</h1>
        <div class="ticketResult boxFilter">
            <form action="../controller/findData.php" method="get">
                <div>
                    <label for="tglawal">Tanggal Awal</label>
                    <input id="tglawal" name="tglawal" type="date" required>
                </div>
                <div>
                    <label for="tglakhir">Tanggal Akhir</label>
                    <input id="tglakhir" name="tglakhir" type="date" required>
                </div>
                <div>
                    <select name="filtertype" id="filtertype">
                        <option value="date" selected>Urut Berdasarkan Tanggal</option>
                        <option value="sn">Urut Berdasarkan Serial Number</option>
                        <option value="status">Urut Berdasarkan Status</option>
                    </select>
                </div>
                <button type="submit" name="filterdate"><i class="fi fi-rs-search adjusts"></i> Filter Ticket</button>
            </form>
            <div class="allresult">
                <?php 
                    $no = 1; 
                    if(isset($_GET['filterdate'])){
                        echo "dipencet";
                    }
                    $query = mysqli_query($connect, "SELECT * FROM tickets WHERE requestor = '$username' ");
                    $total = mysqli_query($connect, "SELECT COUNT(ticket_id) AS TOTALS FROM tickets WHERE requestor = '$username' ")
                ?>
                <h4>Menampilkan hasil pencarian sejumlah <strong><?php echo mysqli_fetch_assoc($total)['TOTALS'] ?></strong> tiket.</h4>
                <table>
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>SN Unit</td>
                            <td>Tanggal Request</td>
                            <td>Jenis Pekerjaan</td>
                            <td class="mobile">Nama Perusahaan</td>
                            <td class="mobile">No. Handphone</td>
                            <td>Status Ticket</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            
                            while($row = mysqli_fetch_array($query)){
                                ?>
                                <tr index="<?php echo $row['ticket_id']?>">
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['sn_unit'] ?></td>
                                    <td><?php echo date_format(date_create($row['req_date']), "d F Y") ?></td>
                                    <td><?php echo $row['job_type'] ?></td>
                                    <td class="mobile"><?php echo $_SESSION['logged_user_comp'] ?></td>
                                    <td class="mobile"><?php echo $row['cp_phone'] ?></td>
                                    <td><span class="<?php echo $row['status'] ?>"><?php echo $row['status'] ?></span></td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <a href="summary.php">Kembali ke Halaman Utama</a>
        </div>
    </div>
<div>