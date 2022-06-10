<?php 
    if(isset($_GET['filterdate'])){
        $tglawal = $_GET['tglawal'];
        $tglakhir = $_GET['tglakhir'];
        $filter = $_GET['filtertype'];
        header("Location: ../pages/summary.php?page=all-ticket&tglawal=$tglawal&tglakhir=$tglakhir&filter=$filter");
    }

?>