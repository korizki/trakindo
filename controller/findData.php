<?php 
    if(isset($_GET['filterdate'])){
        // mendapatkan nilai berdasarkan inputan
        $tglawal = $_GET['tglawal'];
        $tglakhir = $_GET['tglakhir'];
        $filter = $_GET['filtertype'];
        // mengarahkan kembali ke page summary dengan tambahan data inputan
        header("Location: ../pages/summary.php?page=all-ticket&tglawal=$tglawal&tglakhir=$tglakhir&filter=$filter");
    }

?>