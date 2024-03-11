<div id="header-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="img-fluid" src="./img/banne/bn1.png" alt="Banner Image 1">
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <a href="index.php?act=product" class="btn btn-light py-2 px-3 rounded showAll">Shop Now</a>
            </div>
        </div>
        <div class="carousel-item">
            <img class="img-fluid" src="img/banne/bn2.png" alt="Banner Image 2">
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <a href="index.php?act=product" class="btn btn-light py-2 px-3 rounded showAll">Shop Now</a>
            </div>
        </div>
        <div class="carousel-item">
            <img class="img-fluid" src="img/banne/bn3.png" alt="Banner Image 3">
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <a href="index.php?act=product" class="btn btn-light py-2 px-3 rounded showAll">Shop Now</a>
            </div>
        </div>
        <div class="carousel-item">
            <img class="img-fluid" src="img/banne/bn4.png" alt="Banner Image 4">
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <a href="index.php?act=product" class="btn btn-light py-2 px-3 rounded showAll">Shop Now</a>
            </div>
        </div>
        <div class="carousel-item">
            <img class="img-fluid" src="img/banne/bn5.png" alt="Banner Image 5">
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <a href="index.php?act=product" class="btn btn-light py-2 px-3 rounded showAll">Shop Now</a>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev pr-5" href="#header-carousel" data-slide="prev">
        <span class="btn border rounded carousel-control-prev-icon p-3"></span>
    </a>
    <a class="carousel-control-next pl-5" href="#header-carousel" data-slide="next">
        <span class="btn border rounded carousel-control-next-icon p-3"></span>
    </a>
</div>


<div class="container mt-5 pt-3 border border-danger">
<div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">PHƯƠNG CHÂM PHỤC VỤ</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Chất Lượng Hàng Đầu</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Miễn Phí Vận Chuyển</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Đổi Trả Trong 14 Ngày</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Tư Vấn Hỗ Trợ 24/7</h5>
            </div>
        </div>
    </div>
</div>

<div class="container offer pt-2">
    <div class="row px-xl-5">
        <div class="col-md-6 pb-4">


        </div>
        <div class="col-md-6 pb-4">


        </div>
    </div>
</div>


<div class="container pt-2 border border-danger rounded">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">SẢN PHẨM MỚI</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">

        <?php
        try {
            // $query = "SELECT * FROM hanghoa ORDER BY MSHH DESC limit 8";
            $query = "SELECT * FROM hanghoa ORDER BY MSHH DESC limit 8";

            $sth = $pdo->query($query);


            while ($row = $sth->fetch()) {
                $htmlspecialchars = 'htmlspecialchars';
                $ten = $htmlspecialchars($row['TenHH']);
                $gia = $htmlspecialchars($row['Gia']);
                $img = $htmlspecialchars($row['TenHinh']);
                $gia = number_format($gia, 0, ",", ".");
                $id = $htmlspecialchars($row['MSHH']);
                ?>

                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-1 mb-4">
                        <div class=" card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="w-100" src="<?= $img ?>" alt="">
                        </div>
                        <div class="card-body border-left border-right p-0 pt-4" style="height: 100px;">
                            <h6 class="mb-2 ml-2">
                                <?= $ten ?>
                            </h6>
                            <div class="d-flex justify-content-center">
                                <h6 class="text-danger">
                                    <?= $gia ?>
                                </h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <form name="chitiet" method="post" action="index.php?act=cart&MSHH=<?php echo $row["MSHH"]; ?>">
                                <input type="hidden" name="MSHH" id="" value="<?= $id ?>">

                                <a href="index.php?act=chitiet&MSHH=<?= $id ?>">Xem chi tiết</a>

                                <button name="sbm" type="submit" class="btn btn-outline-white "> <i
                                        class="fas fa-shopping-cart text-danger"></i></button>
                            </form>

                        </div>
                    </div>
                </div>

                <?php
            }

        } catch (PDOException $e) {
            include '../view/show_error.php';
            $error_message = 'Không thể lấy dữ liệu';
            $reason = $e->getMessage();
            include '../view/show_error.php';
        }
        ?>
    </div>
    <div class="text-center mb-4 py-4">
        <a href="index.php?act=product">
            <h5 class="btn btn-primary p-2 viewAll">
                << Xem thêm>>
            </h5>
        </a>
    </div>
</div>
<div class="container-fluid my-5 pt-2 mx-5">
<div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">THƯƠNG HIỆU HÀNG ĐẦU</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                <div class="vendor-item border p-4">
                    <img src="img/brand/iphone.png" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/brand/samsung.png" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/brand/realme.png" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/brand/xiaomi.png" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/brand/oppo.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/brand/vivo.png" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="img/brand/nokia.jpg" alt="">
                </div>                
            </div>
        </div>
    </div>
</div>


<div class="container mt-5 pt-3 border border-warning rounded">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">ĐƯỢC YÊU THÍCH</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">

        <?php
        try {
            // $query = "SELECT * FROM hanghoa ORDER BY MSHH DESC limit 8";
            $query2 = "SELECT * FROM hanghoa ORDER BY RAND() limit 8";

            $sth2 = $pdo->query($query2);


            while ($row2 = $sth2->fetch()) {
                $htmlspecialchars = 'htmlspecialchars';
                $ten = $htmlspecialchars($row2['TenHH']);
                $gia = $htmlspecialchars($row2['Gia']);
                $img = $htmlspecialchars($row2['TenHinh']);
                $gia = number_format($gia, 0, ",", ".");
                $id = $htmlspecialchars($row2['MSHH']);
                ?>

                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-1 mb-4">
                        <div class=" card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="w-100" src="<?= $img ?>" alt="">
                        </div>
                        <div class="card-body border-left border-right p-0 pt-4" style="height: 100px;">
                            <h6 class="mb-2 ml-2">
                                <?= $ten ?>
                            </h6>
                            <div class="d-flex justify-content-center">
                                <h6 class="text-danger">
                                    <?= $gia ?>
                                </h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <form name="chitiet" method="post" action="index.php?act=cart&MSHH=<?php echo $row["MSHH"]; ?>">
                                <input type="hidden" name="MSHH" id="" value="<?= $id ?>">

                                <a href="index.php?act=chitiet&MSHH=<?= $id ?>">Xem chi tiết</a>

                                <button name="sbm" type="submit" class="btn btn-outline-white "> <i
                                        class="fas fa-shopping-cart text-danger"></i></button>
                            </form>

                        </div>
                    </div>
                </div>

                <?php
            }

        } catch (PDOException $e) {
            include '../view/show_error.php';
            $error_message = 'Không thể lấy dữ liệu';
            $reason = $e->getMessage();
            include '../view/show_error.php';
        }
        ?>


    </div>

    <div class="text-center mb-4 py-4">
        <a href="index.php?act=product">
            <h5 class="btn btn-primary p-2 viewAll">
                << Xem thêm>>
            </h5>
        </a>
    </div>
</div>

