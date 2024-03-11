<div class="row mt-5">
	<div class="col-sm-8 offset-sm-2">
		<?php if (isset($message))
			echo $message;
		?>

		<div class="card bg-secondary">
			<div class="card-header bg-primary text-white">
				<h3 class="mb-0">Đăng ký thành viên</h3>
			</div>
			<div class="card-body">

				<form id="signupForm" method="post" class="row g-3" action="index.php?act=register">

					<div class="col-md-6">
						<label for="HoTen" class="form-label mt-3">Họ tên của bạn:</label>
						<input type="text" class="form-control" id="HoTen" name="HoTen" placeholder="Họ tên của bạn" />
					</div>

					<div class="col-md-6">
						<label for="username" class="form-label mt-3">Username:</label>
						<input type="text" class="form-control" id="username" name="username"
							placeholder="Tên đăng nhập" />
					</div>

					<div class="col-md-6">
						<label for="DiaChi" class="form-label mt-3">Địa chỉ:</label>
						<input type="text" class="form-control" id="DiaChi" name="DiaChi" placeholder="Địa chỉ" />
					</div>

					<div class="col-md-6">
						<label for="SoDienthoai" class="form-label mt-3">Số điện thoại:</label>
						<input type="text" class="form-control" id="SoDienthoai" name="SoDienthoai"
							placeholder="Nhập số điện thoại" />
					</div>

					<div class="col-md-6">
						<label for="pass" class="form-label mt-3">Mật khẩu:</label>
						<input type="password" class="form-control" id="pass" name="pass" placeholder="Nhập mật khẩu" />
					</div>

					<div class="col-md-6">
						<label for="confirm_password" class="form-label mt-3">Nhập lại mật khẩu:</label>
						<input type="password" class="form-control" id="confirm_password" name="confirm_password"
							placeholder="Nhập lại mật khẩu" />
					</div>

					<div class="col-md-6 my-3 ">
						<div class="form-check mb-3">
							<input class="form-check-input" type="checkbox" id="agree" name="agree" value="agree" />
							<label class="form-check-label" for="agree">Đồng ý với các điều khoản dịch vụ</label>
						</div>

						<button type="submit" class="btn btn-primary">Đăng ký</button>

					</div>

				</form>
			</div>
		</div>

	</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">

	$(document).ready(function () {
		$("#signupForm").validate({
			rules: {
				HoTen: "required",
				DiaChi: "required",
				SoDienthoai: "required",
				username: { required: true, minlength: 2 },
				pass: { required: true, minlength: 5 },
				confirm_password: { required: true, minlength: 5, equalTo: "#pass" },
				email: { required: true, email: true },
				agree: "required" //test

			},
			messages: {
				HoTen: "Bạn chưa nhập vào họ và tên của bạn",
				DiaChi: "Bạn chưa nhập vào địa chỉ của bạn",
				SoDienthoai: "Bạn chưa nhập vào số điện thoại",
				username: {
					required: "Bạn chưa nhập vào tên đăng nhập",
					minlength: "Tên đăng nhập phải có ít nhất 2 ký tự"
				},
				pass: {
					required: "Bạn chưa nhập mật khẩu",
					minlength: "Mật khẩu phải có ít nhất 5 ký tự",
				},
				confirm_password: {
					required: "Bạn chưa nhập mặt khẩu",
					minlength: "Mật khẩu phải có ít nhất 5 ký tự",
					equalTo: "Mật khẩu không trùng khớp với mặt khấu đã nhập"
				},

				email: "Hộp thư điện tử không hợp lệ",
				agree: "Bạn nên đồng ý với các điều khoản của chúng tôi"

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

<?php
$location = false;
if (isset($_POST['signup']) && $_SERVER['REQUEST_METHOD'] = 'POST') {
	if (!empty($_POST['HoTen'])) {
		$query = 'Select * from webdt.khachhang';
		$error = false;
		try {
			$sth = $pdo->prepare($query);
			$sth->execute([]);
			while ($row = $sth->fetch()) {
				if ($row['username'] == $_POST['username']) {
					$error = true;
					$message =
						'<div class="alert alert-danger" role="alert">
								Username đã tồn tại
					</div>';
					break;
				}
				if ($row['SoDienThoai'] == $_POST['SoDienthoai']) {
					$error = true;
					$message =
						'<div class="alert alert-danger" role="alert">
								Tài khoản đã tồn tại
					</div>';
					break;
				}
			}

		} catch (PDOException $e) {
			$pdo_error = $e->getMessage();
		}

	} else {
		include '../view/show_error.php';
	}
	if (!$error) {
		$query = 'INSERT INTO khachhang (HoTen, DiaChi, SoDienthoai, username, pass) VALUES (?, ?, ?, ?, ?)';
		try {
			$sth = $pdo->prepare($query);
			$sth->execute([
				$_POST['HoTen'],
				$_POST['DiaChi'],
				$_POST['SoDienthoai'],
				$_POST['username'],
				$_POST['pass']

			]);

		} catch (PDOException $e) {
			$pdo_error = $e->getMessage();
		}
		if ($sth && $sth->rowCount() == 1) {
			// echo "<script>alert('Đăng ký thành công ');</script>";			
			//  header('Location: index.php?act=login');
			$message = '<div class="alert alert-success" role="alert">
			<b><a href="indec.php?act=login">Đăng nhập</a></b>
		</div>';

		} else {
			$error_message = 'Không thể lưu trữ trích dẫn';
			$reason = $pdo_error ?? 'không rõ nguyên nhân';
			include '../view/show_error.php';
		}
	}
}
?>