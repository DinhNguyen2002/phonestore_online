<?php
if (isset($_GET['MSKH'])) {
    $user_query = "SELECT * FROM khachhang  WHERE khachhang.MSKH =?";
    $user = $pdo->prepare($user_query);
    $user->execute([$_GET['MSKH']]);

    $row2 = $user->fetch();
    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5 ">
                <h4 class="mb-3">Thông tin khách hàng</h4>
                <table class="table table-striped">
                    <tr>
                        <th scope="row">Họ và tên</th>
                        <td>
                            <?php echo $row2["HoTen"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Địa chỉ</th>
                        <td>
                            <?php echo $row2["DiaChi"]; ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Số điện thoại</th>
                        <td>
                            <?php echo $row2["SoDienThoai"]; ?>
                        </td>
                    </tr>
                </table>

            </div>
            <?php
            $id = $_GET['MSKH'];
            $sql_query = "SELECT * FROM dathang WHERE MSKH = " . $_GET['MSKH'] . " ";
            $query = $pdo->query($sql_query);
            ?>
            <div class="col-md-7  mb-4">
                <h4 class="mb-3">Lịch sử mua hàng</h4>
                <?php
                $total_sum = 0;
                while ($row = $query->fetch()) {
                    $mdh = $row['MaDH'];
                    $product = "SELECT * FROM dathang d, chitietdathang c, hanghoa h  
                                    WHERE d.MaDH = c.MaDH 
                                    AND c.MSHH = h.MSHH AND d.MaDH = " . $mdh . " ";
                    $product = $pdo->query($product);
                    ?>
                    <ul class="list-group mb-3">
                        <?php
                        $total = 0;
                        foreach ($product as $value) {
                            $sum = 0;
                            $sum = $value["SoLuong"] * $value["GiaDatHang"];
                            $total += $sum;
                            ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h5>
                                        <?php echo $value["TenHH"]; ?>
                                    </h5>
                                    <h6>
                                        <?php echo number_format($value["GiaDatHang"], 0, ",", ".") ?>đ x
                                        <?php echo $value["SoLuong"]; ?>
                                    </h6>
                                </div>
                                <h5>
                                    <?php echo number_format($sum, 0, ",", ".") ?>đ
                                </h5>
                            </li>
                        <?php }
                        $total_sum += $total;
                        ?>

                        <li class="list-group-item d-flex justify-content-between">
                            <h5 class="fw-bold">Tổng thành tiền</h5>
                            <h5 class="text-danger">
                                <?php echo number_format($total, 0, ",", ".") ?>đ
                            </h5>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <?php if ($value["TrangThaiDH"] == 1) { ?>
                                <h5 class="fw-bold">Trạng thái
                                <span class="badge">
                                    (<i class="far fa-check-circle"></i>
                                    Đã duyệt)
                                </span>
                                </h5>
                                <h5 >Ngày giao hàng: <?php echo $value["NgayGH"];?></h5>
                            <?php } elseif ($value["TrangThaiDH"] == 2) { ?>
                                <h5 class="fw-bold">Trạng thái
                                <span class="badge ">
                                    (<i class="fas fa-box-open"></i>
                                    Đã giao hàng)
                                </span>
                                </h5>
                                <h5 >Ngày nhận hàng: <?php echo $value["NgayGH"];?></h5>

                            <?php } else { ?>
                                <h5 class="fw-bold">Trạng thái
                                <span class="badge ">                                    
                                  (Chưa duyệt)
                                </span>
                                </h5>
                                <a href="index.php?act=delete_bill&MaDH=<?php echo $value["MaDH"]; ?>&MSKH=<?php echo $value["MSKH"]; ?>"
                                    class="btn btn-danger rounded"> Hủy đơn hàng </a>
                                <?php unset($_GET["MaDH"]); ?>
                            <?php } ?>
                        </li>
                    </ul>

                <?php }
            }?>

            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between">
                    <h4> Tổng giá trị mua hàng:</h4>
                    <h4> <strong class="text-danger">
                            <?php echo number_format($total_sum, 0, ",", ".") ?>
                        </strong>đ</h4>

                </li>
            </ul>
        </div>
    </div>
</div>