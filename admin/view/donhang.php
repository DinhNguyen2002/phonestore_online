<div id="layoutSidenav_content">
    <div class="container px-4 pt-5">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Ngày đặt</th>
                    <th></th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Ngày đặt</th>
                    <th></th>                
                </tr>
            </tfoot>

            <tbody>
                <?php
                $query = "SELECT * FROM dathang d, khachhang k WHERE d.MSKH=k.MSKH";

                try {
                    $sth = $pdo->query($query);
                    while ($row = $sth->fetch()) {
                        $htmlspecialchars = 'htmlspecialchars';
                        $ten = $htmlspecialchars($row['HoTen']);
                        $madh = $htmlspecialchars($row['MaDH']);
                        $ngaydat = $htmlspecialchars($row['NgayDH']);
                        $trangthai = $htmlspecialchars($row['TrangThaiDH']);
                        ?>
                        <tr>
                            <td>
                                <?= $madh ?>
                            </td>
                            <td>
                                <?= $ten ?>
                            </td>
                            <td>
                                <?= $ngaydat ?>
                            </td>
                            <td>
                                <?php if ($trangthai == 1) { ?>
                                    <span class="label bg-green">
                                        <a href="index.php?act=check_bill&MaDH=<?= $madh ?>" class="btn py-0 btn-warning">
                                        <i class="far fa-check-circle"></i>
                                        Đã nhận hàng </a>

                                    </span>

                                <?php } elseif ($trangthai == 2) { ?>
                                    <span class="label bg-green">
                                        <i class="fas fa-box-open"></i>
                                        Đã giao hàng</span>

                                <?php } else { ?>
                                    <a href="index.php?act=add_bill&MaDH=<?= $madh ?>" class="btn py-0 btn-danger">Duyệt </a>
                                <?php } ?>
                            </td>
                        </tr>

                    <?php }

                } catch (PDOException $e) {
                    $error_message = 'Không thể lấy dữ liệu';
                    $reason = $e->getMessage();
                    include '../view/show_error.php';
                }
                ?>
            </tbody>
        </table>
    </div>