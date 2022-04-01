<?php 
		require 'includes/snippet.php';
	require 'includes/db-inc.php';
	include "includes/header.php";


	if (isset($_POST['submit'])) {
		//Получение значений из форм
		$name = sanitize(trim($_POST['name']));
		$username = sanitize(trim($_POST['username']));
		$password1 = sanitize(trim($_POST['password1']));
		$password2 = sanitize(trim($_POST['password2']));
		$email = sanitize(trim($_POST['email']));

	if (isset($_FILES['postimg'])) {
	        $img_size = $_FILES['postimg']['size'];
	        $temp = $_FILES['postimg']['tmp_name'];
	        $img_type = $_FILES['postimg']['type'];
	        $img_name = $_FILES['postimg']['name'];

	        if ($img_size > 500000) {
	            $err_flag = true;
	            $error = "Your image size is too big... Try again.";
	        }

	        $extensions = array('jpg', 'jpeg', 'png', 'gif');
	        $img_ext = explode('/', $img_type);
	        $img_ext = end($img_ext);
	        $img_ext = strtolower($img_ext);
	        if (!(in_array($img_ext, $extensions))) {
	            $err_flag = true;
	            $error = "Unwanted image file type... Only jpg,jpeg,png and gif allowed";
	        }

		$upload_dir = 'posts-images/';
		if(!is_dir($upload_dir)){
			mkdir($upload_dir);
		}
		$img_path = "";
		$img_path = $upload_dir.time().mt_rand(10,99).'.'.$img_ext;

		if (!isset($err_flag)) {
			$send = move_uploaded_file($temp, $img_path);
			if($send){
				echo "<script>alert('File uploaded')</script>";
				// return $img_path;
			} else {
				return false;
			}
		}
    }


		if ($password1 == $password2) {
            //Создание оператора вставки sql;;
		$sql =
		 "INSERT into admin (adminName, password, username, email, photo) values ('$name', '$password1', '$username', '$email', '$img_path')";
		 
		  echo $img_picture;

            //Запрос к базе данных;
		$query = mysqli_query($conn, $sql);
		$error = false;

		if ($query) {
		$error = true;
		}
		else {
		echo "<script>alert('Админ не добавлен!');
					</script>";	
		}

		}

		else {
			echo  "<script>alert('Неверный пароль!')</script>";
		}

		
	}

 ?>


<div class="container">
    <?php include "includes/nav.php"; ?>
	<div class="container  col-lg-9 col-md-11 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1 col-sm-offset-0 col-xs-offset-0  " style="margin-top: 30px">
		<div class="jumbotron login col-lg-10 col-md-11 col-sm-12 col-xs-12">
			<?php if(isset($error)) { ?>
		<div class="alert alert-success alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				  <strong>Запись успешно добавлена!</strong>
			</div>
			<?php } ?>
			<p class="page-header" style="text-align: center">Добавить админа</p>

			<div class="container">
				<form class="form-horizontal" role="form" method="post" action="adduser.php" enctype="multipart/form-data">
				<div class="form-group">
						<label for="Name" class="col-sm-2 control-label">Полное имя</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="name" placeholder="Введите Полное имя" id="name" required>
						</div>		
					</div>
					<div class="form-group">
						<label for="Username" class="col-sm-2 control-label">Логин</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="username" placeholder="Введите Логин" id="username" required>
						</div>		
					</div>
					<div class="form-group">
						<label for="Password" class="col-sm-2 control-label">Пароль</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password1" placeholder="Введите Пароль" id="password" required>
						</div>		
					</div>
					<div class="form-group">
						<label for="Password" class="col-sm-2 control-label">Подтвердите Пароль</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password2" placeholder="Подтвердите Пароль" id="password" required>
						</div>		
					</div>
          <div class="form-group">
            <label for="Password" class="col-sm-2 control-label">Почта</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" name="email" placeholder="Введите почту" id="email" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Картинка</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" name="postimg" placeholder="Вставить картинку" id="password" style="padding: 0" required>
            </div>
          </div>
					
					<div class="form-group ">
						<div class="col-sm-offset-2 col-sm-10 ">
							<button type="submit" class="btn btn-info col-lg-4 " name="submit">
								Подтвердить
							</button>

						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
</div>


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript">
 	window.onload = function () {
		let input = document.getElementById('name').focus();
	}
 </script>
</body>
</html>