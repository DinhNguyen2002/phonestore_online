<?php

if (isset($_GET['MSHH']) && is_numeric($_GET['MSHH']) && ($_GET['MSHH'] > 0)) {
    $query = "select TenHH, ChiTiet, Gia, SoLuongHang, TenHinh, nhan, Screen, CPU, Camera, Memory, Pin from webdt.hanghoa where MSHH= ?";
    $sth = $pdo->prepare($query);
    $sth->execute([$_GET['MSHH']]);

    try {
        $row = $sth->fetch();
    } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
    }
    if (!empty($row)) {
    ?>
    <?php
    } else {
        $error_message = 'Không lấy được trích dẫn này';
        $reason = $pdo_error ?? 'Không rõ nguyên nhân';
        include '../view/show_error.php';
    }

} elseif (isset($_POST['MSHH']) && is_numeric($_POST['MSHH']) && ($_POST['MSHH'] > 0)) {
    if (!empty($_POST['TenHH'])) {
        $TenHinh = $_FILES['TenHinh']['name'];
        $TenHinh_tmp = $_FILES['TenHinh']['tmp_name'];

        try {
            if ($TenHinh != '') {
                $TenHinh = "./img/" . $_FILES['TenHinh']['name'];
                $TenHinh_tmp = $_FILES['TenHinh']['tmp_name'];

                $query = 'update webdt.hanghoa set TenHH =?, ChiTiet =?, Gia=?, SoLuongHang=?, TenHinh=?, nhan=?, Screen=?, CPU=?, Camera=?, Memory=?, Pin=? where MSHH=?';

                $sth = $pdo->prepare($query);
                $sth->execute([
                    $_POST['TenHH'],
                    $_POST['ChiTiet'],
                    $_POST['Gia'],
                    $_POST['SoLuongHang'],
                    $TenHinh,
                    $_POST['nhan'],
                    $_POST['Screen'],
                    $_POST['CPU'],
                    $_POST['Camera'],
                    $_POST['Memory'],
                    $_POST['Pin'],
                    $_POST['MSHH']
                ]);

            } else {
                $query = 'update webdt.hanghoa set TenHH =?, ChiTiet =?, Gia=?, SoLuongHang=?, nhan=?, Screen=?, CPU=?, Camera=?, Memory=?, Pin=? where MSHH=?';

                $sth = $pdo->prepare($query);
                $sth->execute([
                    $_POST['TenHH'],
                    $_POST['ChiTiet'],
                    $_POST['Gia'],
                    $_POST['SoLuongHang'],
                    $_POST['nhan'],
                    $_POST['Screen'],
                    $_POST['CPU'],
                    $_POST['Camera'],
                    $_POST['Memory'],
                    $_POST['Pin'],
                    $_POST['MSHH']
                ]);
            }
            echo '<script>
            alert("Cập nhật thành công ");
            window.location.href="index.php";
            </script>';

        } catch (PDOException $e) {
            $error_message = 'Không thể cập nhật trích dẫn này';
            $reason = $e->getMessage();
            include '../view/show_error.php';
        }
    } else {
        $error_meeage = 'Hãy gõ vào tất cả thông tin';
        include '../view/show_error.php';
    }
} else {
    include '../view/show_error.php';
}

?>

<div id="layoutSidenav_content">
    <div class="container px-5 py-5">
        <div class="card">
            <div class="card-header">
                <h3>Cập nhật thông tin sản phẩm</h3>
            </div>
            <div class="card-body px-5">
                <form id="signupForm" class="form-horizontal" action="index.php?act=edit" method="post"
                    enctype="multipart/form-data">

                    <div class="row px-5">
                        <div class="col-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="TenHinh">Hình ảnh:</label>
                                <div class="col-sm-5">
                                    <img class="w-50" src="<?= $row["TenHinh"] ?>" alt="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="TenHH">Tên sản phẩm:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="TenHH" name="TenHH"
                                        value="<?= $row['TenHH'] ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="Gia">Giá:</label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" id="Gia" name="Gia" min=1000000
                                        step="0.01" value="<?= $row['Gia'] ?>" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="Screen">Screen:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="Screen" name="Screen"
                                        value='<?= $row['Screen'] ?>' />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="Memory">Memory:</label>
                                <div class="col-sm-5">
                                    <textarea type="text" class="form-control" id="Memory"
                                        name="Memory"><?= $row['Memory'] ?> </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="CPU">CPU:</label>
                                <div class="col-sm-5">
                                    <textarea type="text" class="form-control" id="CPU"
                                        name="CPU"><?= $row['CPU'] ?> </textarea>
                                </div>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="TenHinh">(New file:)</label>
                                <div class="col-sm-5">
                                    <input type="file" class="form-control" id="TenHinh" name="TenHinh" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Hãng:</label>
                                <div class="col-sm-5">
                                    <select name="nhan">
                                        <option value="<?= $row['nhan'] ?>">---
                                            <?= $row['nhan'] ?>---
                                        </option>
                                        <option value="iphone">IPHONE</option>
                                        <option value="oppo">OPPO</option>
                                        <option value="vivo">VIVO</option>
                                        <option value="xiaomi">XIAOMI</option>
                                        <option value="samsung">SAMSUNG</option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="Camera">Camera:</label>
                                <div class="col-sm-5">
                                    <textarea type="text" class="form-control" id="Camera"
                                        name="Camera"><?= $row['Camera'] ?> </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="Pin">Pin:</label>
                                <div class="col-sm-5">
                                    <textarea type="text" class="form-control" id="Pin"
                                        name="Pin"><?= $row['Pin'] ?> </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="SoLuongHang">Số lượng:</label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" id="SoLuongHang" name="SoLuongHang" min=10
                                        value="<?= $row['SoLuongHang'] ?>" />
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="row mx-3">
                        <label class="col-form-label" for="ChiTiet">Chi tiết:</label>

                        <textarea rows="5" class="form-control" id="ChiTiet"
                            name="ChiTiet"><?= $row['ChiTiet'] ?> </textarea>

                    </div>
                    <div class="row col-2 py-2">
                        <input type="hidden" name="MSHH" value="<?= $_GET['MSHH'] ?>">
                        <button type="submit" class="btn btn-primary" name="submit">
                            Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        
        <script type="text/javascript">

            $(document).ready(function () {
                $("#signupForm").validate({
                    rules: {
                        TenHH: "required",
                        Gia: "required",
                        ChiTiet: "required",
                        SoLuongHang: "required",
                        confirm_password: { required: true, minlength: 5, equalTo: "#password" },
                        email: { required: true, email: true },
                        agree: "required" //test

                    },
                    messages: {
                        TenHH: "Vui lòng nhập tên hàng hóa",
                        Gia: "Vui lòng nhập giá bán",
                        ChiTiet: "Vui lòng nhập thông tin chi tiết sản phẩm",
                        SoLuongHang: "Vui lòng nhập số lượng sản phẩm",
                        email: "Hộp thư điện tử không hợp lệ",
                        agree: "Bạn phải đồng ý với các quy định của chúng tôi"

                    },
                    errorElement: "div",
                    errorPlacement: function (error, element) {
                        error.addClass("invalid-feedback");
                        if (element.prop("type") === "checkbox") {
                            error.insertAfter(element.siblings("label"));
                        } else {
                            error.insertAfter(element);
                        }

                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).addClass("is-invalid").removeClass("is-valid");
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).addClass("is-valid").removeClass("is-invalid");
                    }

                });

            }); 
        </script>

    </div>