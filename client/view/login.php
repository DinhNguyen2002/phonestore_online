<?php

if (($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['login']))) {

    $query = 'SELECT * FROM webdt.khachhang';

    $sth = $pdo->query($query);

    if (!empty($_POST['username']) && !empty($_POST['pass'])) {
        while ($row = $sth->fetch()) {
            $htmlspecialchars = 'htmlspecialchars';
            $user = $htmlspecialchars($row['username']);
            $pass = $htmlspecialchars($row['pass']);

            if ((strtolower($_POST['username']) == $user)) {
                if (($_POST['pass'] == $pass)) {
                    $_SESSION['username'] = $row;

                    $loggedin = true;
                    header('Location: index.php');
                    break;

                } else {
                    $error_message =
                        '<div class="alert alert-danger" role="alert">
								Mật khẩu không chính xác
					</div>';
                    break;
                }
            } else {
                $error_message =
                    '<div class="alert alert-danger" role="alert">
                    Tài khoản không tồn tại
                </div>';
            }
        }

    } else {
        $error_message =
            '<div class="alert alert-danger" role="alert">
                    Vui lòng nhập đầy đủ thông tin!
                </div>';
    }
}

?>

<div class="container my-5 w-50">
    <?php
    if (isset($error_message)) {
        echo $error_message;
    }
    ?>
    <h4 class="text-center bg-info py-3 px-5">ĐĂNG NHẬP</h4>

    <form action="index.php?act=login" method="post" class="mt-3 px-5 bg-secondary py-3">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input id="username" type="text" name="username" placeholder="Tên đăng nhập" class="form-control" />
        </div>

        <div class="mb-3">
            <label for="pass" class="form-label">Password:</label>
            <input id="pass" type="password" name="pass" placeholder="Mật khẩu" class="form-control" />
        </div>

        <input type="submit" class="btn btn-success d-block w-100" value="Đăng nhập" name="login">

        <div class="text-center mt-3">
            <p>Bạn chưa có tài khoản? <a href="index.php?act=register" class="text-warning">Đăng ký</a>
            </p>
        </div>
    </form>
</div>