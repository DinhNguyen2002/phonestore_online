<div id="header-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="" src="img/banne/bn1.png" alt="Image">
        </div>
        <div class="carousel-item">
            <img class="img-fluid" src="img/banne/bn2.png" alt="Image">
        </div>
        <div class="carousel-item">
            <img class="img-fluid" src="img/banne/bn3.png" alt="Image">
        </div>
        <div class="carousel-item">
            <img class="img-fluid" src="img/banne/bn4.png" alt="Image">
        </div>

    </div>
    <a class="carousel-control-prev pr-5" href="#header-carousel" data-slide="prev">
        <span class="btn-secondary border rounded carousel-control-prev-icon p-3"></span>
    </a>
    <a class="carousel-control-next pl-5" href="#header-carousel" data-slide="next">
        <span class="btn-secondary border rounded carousel-control-next-icon p-3"></span>
    </a>
</div>

<div class="row mx-5">
    <div class="owl-carousel vendor-carousel">
        <div class="vendor-item brand border border-success rounded p-0">
            <a href="index.php?act=product&iphone"><img src="img/brand/iphone.png" alt=""></a>
        </div>
        <div class="vendor-item brand border border-success rounded p-0">
        <a href="index.php?act=product&samsung"><img src="img/brand/samsung.png" alt=""></a>
        </div>
        <div class="vendor-item brand border border-success rounded p-0">
            <img src="img/brand/realme.png" alt="">
        </div>
        <div class="vendor-item brand border border-success rounded p-0">
        <a href="index.php?act=product&xiaomi"><img src="img/brand/xiaomi.png" alt=""></a>
        </div>
        <div class="vendor-item brand border border-success rounded p-0">
        <a href="index.php?act=product&oppo"><img src="img/brand/oppo.jpg" alt=""></a>
        </div>
        <div class="vendor-item brand border border-success rounded p-0">
        <a href="index.php?act=product&vivo"><img src="img/brand/vivo.png" alt=""></a>
        </div>
        <div class="vendor-item brand border border-success rounded p-0">
            <img src="img/brand/nokia.jpg" alt="">
        </div>
        <div class="vendor-item brand border border-success rounded p-0">
            <img src="img/brand/Masstel.png" alt="">
        </div>
        <div class="vendor-item brand border border-success rounded p-0">
            <img src="img/brand/Itel.jpg" alt="">
        </div>
        <div class="vendor-item brand border border-success rounded p-0">
            <img src="img/brand/Mobell.jpg" alt="">
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-5 pb-3">
        <div class="col-12 pb-1 px-5 mb-5">
            <div class="d-flex align-items-center justify-content-between ">


                <div class="dropdown mr-5">
                    <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        _Sort by_
                    </button>
                    <form action="index.php?act=product" method="post">
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                            <input type="submit" class="dropdown-item" value="Mới nhất" name="latest" />
                            <input type="submit" class="dropdown-item" value="Bán chạy nhất" name="popular" />
                            <input type="submit" class="dropdown-item" value="Giá giảm dần" name="expensive" />
                            <input type="submit" class="dropdown-item" value="Giá tăng dần" name="cheap" />

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
       

        if (isset($_POST["popular"])) {
            $query = "SELECT * FROM hanghoa ORDER BY SoLuongHang ASC";
        } elseif (isset($_POST["cheap"])) {
            $query = "SELECT * FROM hanghoa ORDER BY Gia ASC";
        } elseif (isset($_POST["expensive"])) {
            $query = "SELECT * FROM hanghoa ORDER BY Gia DESC";


        } elseif (isset($_GET["oppo"])) {
            $query = "SELECT * FROM hanghoa WHERE nhan='oppo' ";
        } elseif (isset($_GET["iphone"])) {
            $query = "SELECT * FROM hanghoa WHERE nhan='iphone' ";
        } elseif (isset($_GET["samsung"])) {
            $query = "SELECT * FROM hanghoa WHERE nhan='samsung' ";
        } elseif (isset($_GET["vivo"])) {
            $query = "SELECT * FROM hanghoa WHERE nhan='vivo' ";
        } elseif (isset($_GET["xiaomi"])) {
            $query = "SELECT * FROM hanghoa WHERE nhan='xiaomi' ";

        } elseif (isset($_GET["search"])) {
            $query = "SELECT * FROM hanghoa WHERE TenHH LIKE '%".$_GET["search"]."%' ";

        } else {
            $query = "SELECT * FROM hanghoa ORDER BY MSHH DESC";
        }
    
        try {
            $sth = $pdo->query($query);        

            while ($row = $sth->fetch()) {
                $htmlspecialchars = 'htmlspecialchars';
                $ten = $htmlspecialchars($row['TenHH']);
                $gia = $htmlspecialchars($row['Gia']);
                $img = $htmlspecialchars($row['TenHinh']);
                $gia = number_format($gia, 0, ",", ".");
                $id = $htmlspecialchars($row['MSHH']);
                ?>


                <div class="article-loop col-xl-3 col-lg-4 col-md-5  col-6">
                    <div class="card product-item border-0 mb-4">
                        <div class=" card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="pro-img img-fluid w-100" src="<?= $img ?>" alt="">
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

                                <button name="sbm" type="submit" class="btn btn-outline-white mx-auto"> <i
                                        class="fas fa-shopping-cart text-danger"></i></button>
                            </form>

                        </div>
                    </div>
                </div>
                <?php
            }
        } catch (PDOException $e) {
            $error_message = 'Không thể lấy dữ liệu';
            $reason = $e->getMessage();
            include '../view/show_error.php';
        }
        ?>

        <div class="col-12 pb-1">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mb-3">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>
</div>