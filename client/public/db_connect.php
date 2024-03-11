<?php

try {
	$pdo = new PDO('mysql:host=localhost;dbname=webdt', 'root', '');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	$error_message = 'Không thể kết nối đến CSDL';
	$reason = $e->getMessage();
    include '../view/header.php';
	include '../view/show_error.php';

    include '../view/footer.php';
	exit();
}

