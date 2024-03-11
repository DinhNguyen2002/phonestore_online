<?php
session_start();
ob_start();

include 'db_connect.php';
include '../view/header.php';
if (!isset($_SESSION['admin'])) {
    header('Location: ../view/login.php');

}

if (isset($_GET['act'])) {
    $act = $_GET['act'];

    switch ($act) {

        case 'add':
            include '../view/add.php';
            break;

        case 'check_bill':
            include '../view/checkbill.php';
            break;
        case 'add_bill':
            include '../view/add_bill.php';
            break;

        case 'edit':
            include '../view/edit.php';
            break;

        case 'delete':
            include '../view/delete.php';
            break;

        case 'logout':
            include '../view/logout.php';
            break;

        case 'donhang':
            include '../view/donhang.php';
            break;

        case 'home':
            include '../view/home.php';
            break;


    }
} else {
    include '../view/home.php';
}
include '../view/footer.php';
?>