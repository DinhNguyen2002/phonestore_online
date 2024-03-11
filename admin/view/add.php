<div id="layoutSidenav_content">
	<div class="container px-5 pt-5">
		<div class="card">
			<div class="card-header">
				<h3>Thêm sản phẩm</h3>
			</div>
			<div class="card-body px-5">
				<form id="signupForm" class="form-horizontal" action="index.php?act=add" method="post"
					enctype="multipart/form-data">
					<div class="row px-5">
						<div class="col-6">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="TenHH">Tên sản phẩm:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="TenHH" name="TenHH" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Hãng:</label>
								<div class="col-sm-5">
									<select name="nhan">
										<option>--Thương hiệu--</option>
										<option value="iphone">IPHONE</option>
										<option value="oppo">OPPO</option>
										<option value="vivo">VIVO</option>
										<option value="xiaomi">XIAOMI</option>
										<option value="samsung">SAMSUNG</option>
									</select>

								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="TenHinh">Hình ảnh:</label>
								<div class="col-sm-5">
									<input type="file" class="form-control" id="TenHinh" name="TenHinh" />
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="Gia">Giá:</label>
								<div class="col-sm-5">
									<input type="number" class="form-control" id="Gia" name="Gia" min=1000000 />
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="Screen">Screen:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="Screen" name="Screen" />
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="Memory">Memory:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="Memory" name="Memory" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="CPU">CPU:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="CPU" name="CPU" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="Camera">Camera:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="Camera" name="Camera" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="Pin">Pin:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="Pin" name="Pin" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="password">Số lượng:</label>
								<div class="col-sm-5">
									<input type="number" class="form-control" id="password" name="SoLuongHang" min=10 />
								</div>
							</div>
						</div>
					</div>
					<div class="row mx-4">
						<label class="col-form-label" for="ChiTiet">Chi tiết:</label>
						<textarea rows="5" class="form-control px-5" id="ChiTiet" name="ChiTiet"></textarea>
					</div>
					<div class="row py-2 col-2 mx-4">
						<button type="submit" class="btn btn-primary" name="submit">Thêm sản
							phẩm</button>
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
						TenHinh: "required",
						Gia: "required",

						SoLuongHang: "required",
						confirm_password: { required: true, minlength: 5, equalTo: "#password" },
						email: { required: true, email: true },
						agree: "required" //test

					},
					messages: {
						TenHH: "Vui lòng nhập tên hàng hóa",
						TenHinh: "Vui lòng thêm ảnh sản phẩm",
						Gia: "Vui lòng nhập giá bán",

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

	<?php
	if ($_SERVER['REQUEST_METHOD'] = 'POST') {
		if (!empty($_POST['TenHH'])) {

			$TenHinh = "./img/" . $_FILES['TenHinh']['name'];
			$TenHinh_tmp = $_FILES['TenHinh']['tmp_name'];

			$query = 'INSERT INTO hanghoa (TenHH, Screen, Memory, CPU, Camera, Pin, Gia, SoLuongHang, TenHinh, nhan, ChiTiet) 
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

			try {
				$sth = $pdo->prepare($query);

				$sth->execute([
					$_POST['TenHH'],
					$_POST['Screen'],
					$_POST['Memory'],
					$_POST['CPU'],
					$_POST['Camera'],
					$_POST['Pin'],

					$_POST['Gia'],
					$_POST['SoLuongHang'],
					$TenHinh,
					$_POST['nhan'],
					$_POST['ChiTiet']

				]);

			} catch (PDOException $e) {
				$pdo_error = $e->getMessage();
			}
			if ($sth && $sth->rowCount() == 1) {

				echo '<script>
				           alert("Đã thêm thành công ");
            window.location.href="index.php";
            </script>';

			} else {
				$error_message = 'Không thể lưu sản phẩm dẫn';
				$reason = $pdo_error ?? 'không rõ nguyên nhân';
				include '../view/show_error.php';
			}

		}
	}

	?>