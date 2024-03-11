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
        $error_message = 'Không thể xóa trích dẫn này';
        $reason = $pdo_error ?? 'Không rõ nguyên nhân';
        include '../view/show_error.php';
    }
}
?>
<div id="layoutSidenav_content">
        <div class="container px-5 pt-5">                
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Hình Ảnh</th>
                                <th>Giá Bán</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Hình Ảnh</th>
                                <th>Giá Bán</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (isset($_GET['nhan'])) {
                                $nhan = $_GET['nhan'];
                                $query = "SELECT * FROM hanghoa h  WHERE h.nhan = ?";
                                $sth = $pdo->prepare($query);
                                $sth->execute([$nhan]);

                            } else {
                                $query = "SELECT * FROM hanghoa ";
                                $sth = $pdo->query($query);
                            }
                            try {
                                while ($row = $sth->fetch()) {
                                    $htmlspecialchars = 'htmlspecialchars';
                                    $ten = $htmlspecialchars($row['TenHH']);
                                    $gia = $htmlspecialchars($row['Gia']);
                                    $img = $htmlspecialchars($row['TenHinh']);
                                    $gia = number_format($gia, 0, ",", ".");
                                    $id = $htmlspecialchars($row['MSHH']);
                                    ?>
                                    <tr>
                                        <td><h6><?= $ten?></h6></td>
                                        <td><img class="w-25" src="<?= $img?>" alt=""></td>
                                        <td ><strong class="text-danger"><?= $gia?></strong> VND</td>
                                        <td>
                                            <button type="submit" name="submit" class="btn btn-success">
                                                <a class="text-white " href="index.php?act=edit&MSHH=<?= $id?>">
                                                <i     class="fas fa-pencil-alt"></i>
                                            </a>
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#Modal<?= $id?>">
                                                <i class="fa fa-trash" ></i> </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="Modal<?= $id?>" tabindex="-1" role="dialog"
                                                aria-labelledby="Modal<?= $id?>Label" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="Modal<?= $id?>Label">
                                                                Xóa sản phẩm <?= $ten?>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>                                                        
                                                        <div class="modal-footer">
                                                            <form action="index.php?act=delete" method="post">
                                                                <input type="hidden" name="MSHH" value="<?= $id?>">
                                                                <button type="submit" name="submit"
                                                                    class="btn btn-danger">Xóa</button>

                                                                <button type="button" class="btn btn-primary"
                                                                    data-dismiss="modal">Thoát</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } catch (PDOException $e) {
                                $error_message = 'Không thể lấy dữ liệu';
                                $reason = $e->getMessage();
                                include '../partials/show_error.php';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
