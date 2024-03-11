<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SPhone - shop</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <!-- <link href="./img/payments.png" rel="icon">
    <link href="img/bn6" rel="icon"> -->

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/css.css" rel="stylesheet">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row bg-secondary">
            <div class="container py-1 pr-5 text-right">
                <a class="text-dark px-2" href="">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="text-dark pl-2" href="">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>

        <div class="row bg-success">
            <div class="container">
                <div class="row align-items-center py-3 px-xl-5">
                    <div class="col-lg-3 d-none d-lg-block">
                        <a href="index.php" class="text-decoration-none">
                            <h1 class="m-0 display-5 font-weight-semi-bold"><span
                                    class="text-danger bg-warning font-weight-bold border px-3 mr-1">S</span>Phone</h1>
                        </a>
                    </div>
                    <div class="col-lg-6 col-6 ml-auto">
                        <form action="index.php" method="POST">
                            <div class="input-group w-75">
                                <input type="text" name="timkiem" class="mr-2 form-control rounded" placeholder="tìm kiếm">

                                <button class="btn btn-dark rounded" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 col-6 text-right">
                        <a href="index.php?act=cart_show" class="btn border rounded">
                            <i class="fas fa-shopping-cart text-white"></i>
                            <span class="badge bg-danger rounded text-white">
                                <?php if (isset($_SESSION["cart"])) {
                                    echo count($_SESSION["cart"]);
                                } else {
                                    echo '0';
                                }
                                ?>

                            </span>
                        </a>
                    </div>
                </div>
                <div class="align-items-center border-top px-5 py-3 ">
                    <nav class="navbar navbar-expand-lg  py-3 py-lg-0 px-0">
                        <a href="index.php" class="text-decoration-none d-block d-lg-none">
                            <h1 class="m-0 display-5 font-weight-semi-bold"><span
                                    class="text-danger bg-warning font-weight-bold border px-3 mr-1">S</span>Phone</h1>
                        </a>
                        <button type="button" class="navbar-dark navbar-toggler color-black" data-toggle="collapse"
                            data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between pt-3" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <a href="index.php?act=home" class="nav-item nav-link <?php if ($act == 'home')
                                    echo 'active'; ?>">Trang chủ</a>
                                <a href="index.php?act=product" class="nav-item nav-link <?php if ($act == 'product')
                                    echo 'active'; ?>">Điện thoại</a>
                                <a href="index.php?act=contact" class="nav-item nav-link <?php if ($act == 'contact')
                                    echo 'active'; ?>">Liên hệ</a>
                                <div class="dropdown">
                                    <a href="#" class="nav-item nav-link dropdown-toggle <?php if (($act == 'faqs') || ($act == 'help') || ($act == 'support'))
                                        echo 'active'; ?>" data-toggle="dropdown">Support</a>
                                    <div class="dropdown-menu border-primary text-center rounded bg-success m-0">
                                        <a href="index.php?act=faqs" class=" nav-item nav-link">FAQs</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="index.php?act=help" class=" nav-item nav-link">Help</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="index.php?act=support" class=" nav-item nav-link">Support</a>
                                    </div>
                                </div>
                            </div>
                            <div class="navbar-nav ml-auto py-0">
                                <?php
                                if (isset($_SESSION['username']) && $_SESSION['username'] != "") { ?>
                                    <div class="dropdown">
                                        <a href="#" class="nav-item nav-link dropdown-toggle" data-toggle="dropdown">
                                            <?= $_SESSION['username']['HoTen'] ?>
                                        </a>
                                        <div class="dropdown-menu border-primary text-center rounded bg-success m-0">
                                            <a href="index.php?act=bill&MSKH=<?php echo $_SESSION['username']['MSKH'] ?>"
                                                class=" nav-item nav-link">Hóa đơn</a>                                            
                                            <div class="dropdown-divider"></div>
                                            <a href="index.php?act=logout" class=" nav-item nav-link">Thoát</a>
                                        </div>
                                    </div>
                                    <?php
                                } else { ?>
                                    <a href="index.php?act=login" class="nav-item nav-link <?php if ($act == 'login')
                                        echo 'active'; ?>">Đăng nhập</a>
                                    <a href="index.php?act=register" class="nav-item nav-link <?php if ($act == 'register')
                                        echo 'active'; ?>">Đăng ký</a>

                                <?php } ?>

                            </div>

                        </div>
                    </nav>

                </div>
            </div>
        </div>
    </div>