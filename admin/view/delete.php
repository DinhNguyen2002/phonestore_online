<?php
if (isset($_POST['MSHH']) && is_numeric($_POST['MSHH']) && ($_POST['MSHH'] > 0)) {
    $query = "delete from webdt.hanghoa where MSHH=? limit 1";

    try {
        $sth = $pdo->prepare($query);
        $sth->execute([$_POST['MSHH']]);
    } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
    }

    if ($sth && $sth->rowCount() == 1) {
        echo '<script> alert("Đã xóa thành công ");
        window.location.href="index.php";
        </script>';
    } else {
        $error_message = 'Không thể xóa sản phẩm này';
        $reason = $pdo_error ?? 'Không rõ nguyên nhân';
        include '../view/show_error.php';
    }
} else {
    include '../view/show_error.php';
}
?>