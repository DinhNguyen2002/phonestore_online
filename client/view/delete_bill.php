<?php
   
    if(isset($_GET['MaDH'])){
        $xoa = $_GET['MaDH'];
        $chitiet = "DELETE FROM chitietdathang WHERE MaDH = ? ";
        $dathang = "DELETE FROM dathang WHERE MaDH = ? ";
        $stm = $pdo->prepare($chitiet);
        $stm ->execute([$xoa]);

        $stm = $pdo->prepare($dathang);
        $stm ->execute([$xoa]);

        header("Location: index.php?act=bill&MSKH=" . $_GET['MSKH']);
    }
    
?>