<?php
    if($_SESSION['logged_user_type'] === 'user'){
        if(isset($_GET['tglawal'])){
            $tglawal = $_GET['tglawal'];
            $tglakhir = $_GET['tglakhir'];
            $filter = 'date';
            if(isset($_GET['filter'])){
                $filter = $_GET['filter'];
            }
            $queri = "SELECT * FROM tickets WHERE req_date BETWEEN '$tglawal' AND '$tglakhir' AND requestor = '$username' ORDER BY $filter DESC ";
        } else {
           $tglawal = date('Y-m-d');
           $tglakhir = date('Y-m-d');
           $queri = "SELECT * FROM tickets WHERE requestor = '$username' ORDER BY req_date DESC";
        }
    } else if($_SESSION['logged_user_type'] === 'Administrator'){
        if(isset($_GET['tglawal'])){
            $tglawal = $_GET['tglawal'];
            $tglakhir = $_GET['tglakhir'];
            $filter = 'date';
            if(isset($_GET['filter'])){
                $filter = $_GET['filter'];
            }
            $queri = "SELECT * FROM tickets LEFT JOIN response ON tickets.ticket_id = response.ticket_id JOIN user ON user.user_name = tickets.requestor  WHERE req_date BETWEEN '$tglawal' AND '$tglakhir' ORDER BY $filter DESC";
        } else {
           $tglawal = date('Y-m-d');
           $tglakhir = date('Y-m-d');
           $queri = "SELECT * FROM tickets LEFT JOIN response ON tickets.ticket_id = response.ticket_id JOIN user ON user.user_name = tickets.requestor ORDER BY req_date DESC ";
        }
    };
    require "../controller/connection.php"; 
    $query = mysqli_query($connect, $queri);
    $querysu = mysqli_query($connect, $queri);
    $total = mysqli_num_rows($query);
    
?>
<div style="display: flex; flex-direction: column; justify-content: space-between; height: 100vh">
    <div class="pendingBox  ">
        <h1>Semua Request</h1>
        <div class="ticketResult boxFilter">
            <form action="../controller/findData.php" method="get">
                <div>
                    <label for="tglawal">Tanggal Awal</label>
                    <input id="tglawal" name="tglawal" type="date" value="<?php echo $tglawal?>" required >
                </div>
                <div>
                    <label for="tglakhir">Tanggal Akhir</label>
                    <input id="tglakhir" name="tglakhir" type="date" value="<?php echo $tglakhir?>" required>
                </div>
                <div>
                    <select name="filtertype" id="filtertype" class="filters">
                        <option value="req_date" selected>Urut Berdasarkan Tanggal</option>
                        <option value="sn_unit">Urut Berdasarkan Serial Number</option>
                        <option value="status">Urut Berdasarkan Status</option>
                    </select>
                </div>
                <button type="submit" name="filterdate"><i class="fi fi-rs-search adjusts"></i> Filter Request</button>
            </form>
            <div class="allresult">
                <h4>Menampilkan hasil pencarian sebanyak <strong><?php echo $total ?></strong> request.</h4>
                
                <div id="commonuser">
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
                                $no = 1;
                                while($row = mysqli_fetch_array($querysu)){
                                    ?>
                                    <tr index="<?php echo $row['ticket_id']?>">
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $row['sn_unit'] ?></td>
                                        <td><?php echo date_format(date_create($row['req_date']), "d F Y") ?></td>
                                        <td><?php echo $row['job_type'] ?></td>
                                        <td class="mobile"><?php echo $_SESSION['logged_user_comp'] ?></td>
                                        <td class="mobile"><?php echo $row['cp_phone'] ?></td>
                                        <td><span class="<?php echo $row['status'] ?> row"><?php echo $row['status'] ?></span></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div id="superuser">
                    <table>
                        <thead>
                            <tr>
                                <td>No.</td>
                                <td>SN Unit</td>
                                <td class="mobile">Tanggal Request</td>
                                <td >Nama Perusahaan</td>
                                <td class="mobile">No. Handphone</td>
                                <td>Nomor SO</td>
                                <td class="mobile">Nama Teknisi</td>
                                <td>Status Ticket</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                while($row = mysqli_fetch_array($query)){
                                    ?>
                                    <tr index="<?php echo $row['ticket_id']?>">
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $row['sn_unit'] ?></td>
                                        <td class="mobile"><?php echo date_format(date_create($row['req_date']), "d F Y") ?></td>
                                        <td><?php echo $row['company'] ?></td>
                                        <td class="mobile"><?php echo $row['cp_phone'] ?></td>
                                        <td><?php echo $row['so_number'] ?></td>
                                        <td class="mobile"><?php echo $row['tech_name'] ?></td>
                                        <td><span class="<?php echo $row['status'] ?> row"><?php echo $row['status'] ?></span></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php 
                    if($_SESSION['logged_user_type'] === 'user'){
                        echo "
                            <script>
                                document.getElementById('commonuser').style.display = 'block';
                            </script>
                        ";
                    } else if($_SESSION['logged_user_type'] === 'Administrator'){
                        echo "
                            <script>
                                document.getElementById('superuser').style.display = 'block';
                            </script>
                        ";
                    }
                ?>
            </div>
            <a href="summary.php">Kembali ke Halaman Utama</a>
        </div>
    </div>
<div>