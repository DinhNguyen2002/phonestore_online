<?php
   
if(isset($_GET['MaDH'])){  
    $mdh = $_GET['MaDH'];

    $query = 'update webdt.dathang set trangthaiDH =1, NgayGH= ? where MaDH= ?';        
    $ad = $pdo->prepare($query);
    $ad->execute([
        date("Y-m-d", strtotime(' + 10 days')),
        $mdh
    ]);

    $query2 ='UPDATE webdt.hanghoa JOIN webdt.chitietdathang ON hanghoa.MSHH = chitietdathang.MSHH
    SET hanghoa.SoLuongHang = hanghoa.SoLuongHang - chitietdathang.SoLuong
    WHERE chitietdathang.MaDH = ?';
    $up = $pdo->prepare($query2);
    $up->execute([$mdh]);

    
    header("Location: index.php?act=donhang");
}

?>