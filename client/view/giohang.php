<?php
if (isset($_POST["update"])) {
    foreach ($_SESSION["cart"] as $value) {
        if ($_POST["SoLuongHang" . $value["MSHH"]] <= 0) {
            unset($_SESSION["cart"][$value["MSHH"]]);
        } else {
            $_SESSION["cart"][$value["MSHH"]]["SoLuongHang"] = $_POST["SoLuongHang" . $value["MSHH"]];
        }
    }
}
if (isset($_POST["checkout"])) {
    $MSKH = $_SESSION['username']['MSKH'];
    if (isset($_SESSION["cart"]) || $_SESSION["cart"] != null) {
        
        $query = "INSERT INTO dathang(MSKH,  NgayDH, TrangThaiDH) 
        VALUES(?, ?,'0')";
        $sqlDatHang= $pdo->prepare($query);
        $sqlDatHang->execute([
            $MSKH,
            date("Y-m-d"),
        ]);


        $sodonDH = $pdo->lastInsertId();
        foreach ($_SESSION["cart"] as $var) {
            $queryCT = "INSERT INTO chitietdathang(MaDH,MSHH,SoLuong,GiaDatHang) 
            VALUES(?, ?, ?, ?)";

            $CTDatHang = $pdo->prepare($queryCT);
            $CTDatHang->execute([
                $sodonDH,
                $var["MSHH"],
                $var["SoLuongHang"],
                $var["Gia"] 
            ]);
        }
    }
    unset($_SESSION["cart"]);
    echo '<script>
            alert("Đặt hàng thành công ");
            window.location.href="index.php";
            </script>';
}
?>
<?php
if (isset($_SESSION["cart"]) && $_SESSION["cart"] != null) { ?>
    <div class="container pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <form action="index.php?act=cart_show" method="POST">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="bg-primary text-dark">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="datarow" class="align-middle bg-secondary">
                            <?php if (isset($_SESSION["cart"])) {
                                $total = 0;
                                foreach ($_SESSION["cart"] as $value) {
                                    $sum = 0;
                                    $sum = $value["Gia"] * $value["SoLuongHang"];
                                    $total += $sum;
                                    ?>
                                    <tr>
                                        <td class="align-middle">
                                            <img src="<?php echo $value["TenHinh"] ?>" alt="" style="width: 50px;">
                                            <p>
                                                <?php echo $value["TenHH"] ?>
                                            </p>
                                        </td>
                                        <td class="align-middle">
                                            <?php echo number_format($value["Gia"], 0, ",", ".") ?>đ
                                        </td>
                                        <td class="align-middle">
                                            <div class="form-outline">
                                                <input min="1" max="200" type="number" id="typeNumber" class="form-control"
                                                    value="<?php echo $value["SoLuongHang"] ?>"
                                                    name="SoLuongHang<?php echo $value["MSHH"] ?>" />
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <?php echo number_format($sum, 0, ",", "."); ?>đ
                                        </td>
                                        <td class="align-middle">
                                            <a href="index.php?act=delete_cart&MSHH=<?php echo $value["MSHH"]; ?>"
                                                class="btn rounded btn-outline-danger">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td class="align-middle"><button class="btn rounded btn-outline-warning" name="update"><i
                                                    class="fas fa-pencil-alt"></i></button></td>
                                    </tr>
                                <?php }
                            } ?>
                        </tbody>
                    </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control p-4" placeholder="Mã giảm giá">
                        <div class="input-group-append">
                            <button class="btn btn-primary">code</button>
                        </div>
                    </div>
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Dơn hàng</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-medium">Tổng tiền: </h6>
                                <h6 class="font-weight-medium">
                                    <?php echo number_format($total, 0, ",", "."); ?>đ
                                </h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Khuyến mãi</h6>
                                <h6 class="font-weight-medium">0đ</h6>
                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-medium">Kết đơn: </h5>
                                <h5 class="font-weight-bold">
                                    <?php echo number_format($total, 0, ",", "."); ?>đ
                                </h5>
                            </div>

                            <?php if (isset($_SESSION['username'])) { ?>

                                <button name="checkout" class="btn btn-block btn-success my-3 py-3"> Đặt hàng</button>

                            <?php } else { ?>

                                <div class="alert alert-primary" style="margin: 5px 0 ;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>Vui lòng <a href="index.php?act=login" style="text-decoration: none; ">đăng nhập</a>
                                        để thanh toán</strong>
                                </div>

                            <?php } ?>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>

<?php } else { ?>
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <img src="./img/no_cart.png" alt="" class="mx-auto d-block">
                <h5> Chưa có sản phẩm </h5>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <a href="index.php" class="btn btn-warning">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    &nbsp;Quay về trang chủ
                </a>
            </div>
        </div>
    </div>
<?php }
?>