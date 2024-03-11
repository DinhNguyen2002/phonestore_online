<div class="container">
    <?php
    $mshh = $_GET['MSHH'];
    $query = 'SELECT * FROM hanghoa hh  WHERE hh.MSHH = ?';

    try {
        $sth = $pdo->prepare($query);
        $sth->execute([$mshh]);
        $row = $sth->fetch();
        $htmlspecialchars = 'htmlspecialchars';
        $ten = $htmlspecialchars($row['TenHH']);
        $nhan = $htmlspecialchars($row['nhan']);


        $gia = $htmlspecialchars($row['Gia']);
        $img = $htmlspecialchars($row['TenHinh']);
        $gia = number_format($gia, 0, ",", ".");
        $id = $htmlspecialchars($row['MSHH']);
        $noidung = $htmlspecialchars($row['ChiTiet']);

        $screen = $htmlspecialchars($row['Screen']);
        $cpu = $htmlspecialchars($row['CPU']);
        $memory = $htmlspecialchars($row['Memory']);
        $cam = $htmlspecialchars($row['Camera']);
        $pin = $htmlspecialchars($row['Pin']);

    } catch (PDOException $e) {
        $error_message = 'Không thể lấy dữ liệu';
        $reason = $e->getMessage();
        include '../view/show_error.php';
    }
    ?>
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="<?= $img ?>" alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="<?= $img ?>" alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="<?= $img ?>" alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="<?= $img ?>" alt="Image">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">
                    <?= $ten ?>
                </h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">(50 Reviews)</small>
                </div>
                <p class="font-weight-semi-bold mb-4">
                    <strong class="text-danger">
                        <?= $gia ?>
                    </strong> VND
                </p>

                <div class="d-flex mb-4">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Màu sắc:</p>
                    <form>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-1" name="color">
                            <label class="custom-control-label" for="color-1">Đen</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-2" name="color">
                            <label class="custom-control-label" for="color-2">Trắng</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-3" name="color">
                            <label class="custom-control-label" for="color-3">Xám</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-4" name="color">
                            <label class="custom-control-label" for="color-4">Lam</label>
                        </div>

                    </form>
                </div>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <form name="chitiet" method="post" action="index.php?act=cart&MSHH=<?php echo $row["MSHH"]; ?>">
                        <input type="hidden" name="MSHH" id="" value="<?= $id ?>">

                        <p>Số lượng: <input class="w-25" type="number" min=1 name="sl" />
                            <button name="sbm" class="btn rounded btn-outline-white px-5">
                                <h1 class="text-danger"> <i class="fa fa-shopping-cart"></i></h1>
                            </button>

                        </p>
                    </form>
                </div>
            </div>
        </div>
        <div class="row px-5">
            <div class="col">
                <div class="nav nav-tabs text-center  mb-4 ">
                    <a class="nav-link head active" data-toggle="tab" href="#tab-pane-1">Giới thiệu</a>
                    <a class="nav-link head" data-toggle="tab" href="#tab-pane-2">Cấu hình</a>
                    <a class="nav-link head" data-toggle="tab" href="#tab-pane-3">Đánh giá (1)</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Giới thiệu về sản phẩm</h4>
                        <p>
                            <?= $noidung ?>
                        </p>
                    </div>
                    <div class="tab-pane fade " id="tab-pane-2">

                        <h4 class="mb-3">Thông tin cấu hình</h4>
                        <table class="table table-striped bg-secondary">
                            <tbody>
                                <tr>
                                    <td>Screen:</td>
                                    <td>
                                        <?= $screen ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>CPU:</td>
                                    <td>
                                        <?= $cpu ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Memory:</td>
                                    <td>
                                        <?= $memory ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Camera:</td>
                                    <td>
                                        <?= $cam ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pin:</td>
                                    <td>
                                        <?= $pin ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">1 review for "
                                    <?= $ten ?>"
                                </h4>
                                <div class="media mb-4">
                                    <img src="./img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1"
                                        style="width: 45px;">
                                    <div class="media-body">
                                        <h6>Sơn Tùng<small> - <i>20 Nov 2023</i></small></h6>
                                        <div class="text-primary mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <p>Điện thoại bền đẹp</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Bình luận mới</h4>
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Đánh giá * :</p>
                                    <div class="text-primary">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <form>
                                    <div class="form-group">
                                        <label for="message">Nội dung *</label>
                                        <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Họ tên *</label>
                                        <input type="text" class="form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Địa chỉ email *</label>
                                        <input type="email" class="form-control" id="email">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Bình luận" class="btn btn-primary px-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">SẢN PHẨM LIÊN QUAN</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    <?php
                    $query = 'SELECT * FROM hanghoa hh  WHERE hh.nhan = ?';
                    try {
                        $sth = $pdo->prepare($query);
                        $sth->execute([$nhan]);
                        while ($row = $sth->fetch()) {
                            $htmlspecialchars = 'htmlspecialchars';
                            $ten = $htmlspecialchars($row['TenHH']);
                            $gia = $htmlspecialchars($row['Gia']);
                            $img = $htmlspecialchars($row['TenHinh']);
                            $gia = number_format($gia, 0, ",", ".");
                            $id = $htmlspecialchars($row['MSHH']);
                            ?>
                            <div class="card product-item border-0">
                                <div
                                    class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" src="<?= $img ?>" alt="">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3">
                                        <?= $ten ?>
                                    </h6>
                                    <div class="d-flex justify-content-center">
                                        <h6 class="text-muted ml-2"><del>38.967.000đ</del></h6>

                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <h5 class="text-danger">
                                            <?= $gia ?>đ
                                        </h5>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <form name="chitiet" method="post"
                                        action="index.php?act=cart&MSHH=<?php echo $row["MSHH"]; ?>">
                                        <input type="hidden" name="MSHH" id="" value="<?= $id ?>">

                                        <a href="index.php?act=chitiet&MSHH=<?= $id ?>">Xem chi tiết</a>

                                        <button name="sbm" type="submit" class="btn btn-outline-white "> <i
                                                class="fas fa-shopping-cart text-danger"></i></button>
                                    </form>

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

                </div>
            </div>
        </div>
    </div>
</div>