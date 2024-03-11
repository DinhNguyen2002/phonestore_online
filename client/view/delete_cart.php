<?php
     
    $MSHH = $_GET["MSHH"];
    if(isset($_SESSION["cart"][$MSHH])){
        unset($_SESSION["cart"][$MSHH]);
    }
    header("location: index.php?act=cart_show");
?>