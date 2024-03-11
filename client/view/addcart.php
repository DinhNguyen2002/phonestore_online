<?php
$MSHH = $_GET['MSHH'];
$sql = "SELECT * FROM hanghoa  WHERE hanghoa.MSHH = ?";
$query = $pdo->prepare($sql);
$query->execute([$MSHH]);

if (isset($_POST["sl"])) {
    $sl = $_POST["sl"];
} else {
    $sl = 1;

}

$product_cart = array();
foreach ($query as $value) {
    $product_cart[$value['MSHH']] = $value;
}
if (isset($_POST["sbm"])) {
    if (!isset($_SESSION["cart"]) || $_SESSION["cart"] == null) {
        $product_cart[$MSHH]["SoLuongHang"] = $sl;
        $_SESSION["cart"][$MSHH] = $product_cart[$MSHH];
    } else {
        if (array_key_exists($MSHH, $_SESSION["cart"])) {
            $_SESSION["cart"][$MSHH]["SoLuongHang"] += $sl;
        } else {
            $product_cart[$MSHH]["SoLuongHang"] = $sl;
            $_SESSION["cart"][$MSHH] = $product_cart[$MSHH];
        }
    }

    header("location: index.php?act=cart_show");

}

?>