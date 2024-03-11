<?php
   
if(isset($_GET['MaDH'])){  
    $mdh = $_GET['MaDH'];

    $query = 'update webdt.dathang set trangthaiDH =2 where MaDH= ?';        
    $ad = $pdo->prepare($query);
    $ad->execute([ $mdh ]);
       
    header("Location: index.php?act=donhang");
}

?>