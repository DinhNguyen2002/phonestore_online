<?php
session_start();
ob_start();


include 'db_connect.php';

if (isset($_POST['timkiem']) && $_POST['timkiem'] != "") {
    $search = $_POST['timkiem'];
    header("Location: index.php?act=product&search=".$search."");
}

$error = false;
if (isset($_GET['error'])) {
    $error = true;
}

if (!$error) {
    if (isset($_GET['act'])) {
        $act = $_GET['act'];
        include '../view/header.php';
        switch ($act) {
            case 'bill':
                include '../view/hoadon.php';
                break;

            case 'chitiet':
                include '../view/chitiet.php';
                break;

            case 'cart_show':
                include '../view/giohang.php';
                break;
            case 'cart':
                include '../view/addcart.php';
                break;

            case 'delete_cart':
                include '../view/delete_cart.php';
                break;
            case 'delete_bill':
                include '../view/delete_bill.php';
                break;

            case 'login':
                include '../view/login.php';
                break;

            case 'register':
                include '../view/register.php';
                break;

            case 'logout':
                include '../view/logout.php';
                break;

            case 'contact':
                include '../view/contact.php';
                break;

            case 'product':
                include '../view/product.php';
                break;

            case 'home':
                include '../view/home.php';
                break;

            default:
                include '../view/home.php';
                break;

        }

    } else {
        include '../view/header.php';
        include '../view/home.php';
    }
    include '../view/footer.php';

} else {
    include 'show_error.php';
}
?>