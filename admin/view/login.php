<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .login-container {
      max-width: 400px;
      margin: auto;
      padding: 30px;
      background-color: #ffffff;
      border: 1px solid #dee2e6;
      border-radius: 5px;
      margin-top: 50px;
      box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.1);
    }

    .form-group {
      margin-bottom: 20px;
    }

    .text {
      width: 100%;
      padding: 10px;
      border: 1px solid #ced4da;
      border-radius: 5px;
    }

    .text:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .signin {
      background-color: #007bff;
      color: #fff;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
    }

    .signin:hover {
      background-color: #0056b3;
    }

    hr {
      border: 1px solid #ced4da;
    }
  </style>
</head>

<body>
  <?php
  session_start();
  ob_start();
  include '../public/db_connect.php';
  if (isset($_SESSION['admin'])) {
    header('Location: ../public/index.php');

  }
  if (($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['login']))) {

    $query = 'SELECT * FROM webdt.admin';
    $sth = $pdo->query($query);

    if (!empty($_POST['username']) && !empty($_POST['pass'])) {
      while ($row = $sth->fetch()) {
        $htmlspecialchars = 'htmlspecialchars';
        $user = $htmlspecialchars($row['username']);
        $pass = $htmlspecialchars($row['pass']);

        if ((strtolower($_POST['username']) == $user)) {
          if (($_POST['pass'] == $pass)) {
            $_SESSION['admin'] = $row;

            $loggedin = true;
            header('Location: ../public/index.php');
            break;

          } else {
            $error_message = 'Mật khẩu không chính xác	';
            break;
          }
        } else {
          $error_message = 'Tài khoản không tồn tại  ';
        }
      }
    } else {
      $error_message = ' Vui lòng nhập đầy đủ thông tin! ';
    }
  }
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="login-container">
          <h2 class="py-3"> Đăng nhập </h2>

          <form action="login.php" method="post">
            <?php if (isset($error_message)) {
              ?>
              <p class="text-danger">
                <?= $error_message ?>
              </p>
              <?php
            }
            ?>
            <div class="form-group">
              <label for="username">Username</label>
              <input id="username" type="text" class="form-control text" name="username" placeholder="Tên đăng nhập"
                required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input id="password" type="password" class="form-control text" name="pass" placeholder="Mật khẩu"
                required>
            </div>

            <button type="submit" class="btn btn-primary btn-block signin" name="login">Đăng nhập</button>
            <hr>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>

</html>