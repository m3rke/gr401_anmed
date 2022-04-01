<?php 
require 'includes/snippet.php';
    require 'includes/db-inc.php';
include "includes/header.php"; 

if(isset($_POST['submit'])) {

    $matric = sanitize(trim($_POST['matric_no']));
    $password = sanitize(trim($_POST['password']));
    $password2 = sanitize(trim($_POST['password2']));
    $username = sanitize(trim($_POST['username']));
    $email = sanitize(trim($_POST['email']));
    $dept = sanitize(trim($_POST['dept']));
    $books = sanitize(trim($_POST['num_books']));
    $money = sanitize(trim($_POST['money_owed']));
    $phone = sanitize(trim($_POST['email']));
    $name = sanitize(trim($_POST['name']));
    $filename =''; 

if (isset($_FILES['postimg'])) {
        $img_size = $_FILES['postimg']['size'];
        $temp = $_FILES['postimg']['tmp_name'];
        $img_type = $_FILES['postimg']['type'];
        $img_name = $_FILES['postimg']['name'];

        if ($img_size > 500000) {
            $err_flag = true;
            $error = "Твоя картинка слишком большая, попробуй другую!";
        }

        $extensions = array('jpg', 'jpeg', 'png', 'gif');
        $img_ext = explode('/', $img_type);
        $img_ext = end($img_ext);
        $img_ext = strtolower($img_ext);
        if (!(in_array($img_ext, $extensions))) {
            $err_flag = true;
            $error = "Нежелательный тип файла изображения... Разрешены только jpg, jpeg, png и gif";
        }
        $imgFile = 'posts-images/';
        $filename = rand(1000, 8000) . '_' .time() . '.' . $img_ext;
        $filepath = $imgFile . $filename;
    }


   if ($password == $password2) {
      $sql = "INSERT INTO students( matric_no, password, username, email, dept, numOfBooks, moneyOwed, photo, phoneNumber, name)
 VALUES ('$matric', '$password', '$username', '$email', '$dept', '$books', '$money', '$filename', '$phone', '$name' ) ";

      $query = mysqli_query($conn, $sql);
      $error = false;
      if($query){
       $error = true;
      }
      else{
        echo "<script>alert('Не зарегестрирован, попробуй снова!');
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
    
    <div class="container  col-lg-9 col-md-11 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1 col-sm-offset-0 col-xs-offset-0  " style="margin-top: 20px">
        <div class="jumbotron login3 col-lg-10 col-md-11 col-sm-12 col-xs-12">

              <?php if(isset($error)===true) { ?>
        <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong>Запись успешно добавлена!</strong>
            </div>
            <?php } ?>
        
            <p class="page-header" style="text-align: center">Добавить студента</p>

            <div class="container">
                <form class="form-horizontal" role="form" action="addstudent.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="Username" class="col-sm-2 control-label">Полное имя</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Полное имя" id="name" required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label for="Password" class="col-sm-2 control-label">Номер чит.билета</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="matric_no" placeholder="Номер чит.билета" id="password" required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label for="Password" class="col-sm-2 control-label">Отделение</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="dept" placeholder="Отделение" id="Address" required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label for="Password" class="col-sm-2 control-label">Почта</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="Почта" id="password" required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label for="Password" class="col-sm-2 control-label">Логин</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" placeholder="Логин" id="password" required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label for="Password" class="col-sm-2 control-label">Пароль</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" placeholder="Пароль" id="password" required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label for="Password" class="col-sm-2 control-label">Подтверждение Пароля</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password2" placeholder="Подтверждение Пароля" id="password" required>
                        </div>      
                    </div>
                     
                     <input type="hidden" class="form-control" name="num_books" placeholder="Книги" id="password" required value="null">
                     <input type="hidden" class="form-control" name="money_owed" placeholder="Деньги" id="password" required value="null">
                    <div class="form-group">
                        <label for="Password" class="col-sm-2 control-label">Номер телефона</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone" placeholder="Номер телефона" id="password" required>
                        </div>      
                    </div>     
                         
                    
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Фото профиля</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="postimg" placeholder="Добавить фото" id="password" style="padding: 0" required>
                        </div>      
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button  class="btn btn-info col-lg-12" data-toggle="modal" data-target="#info" name="submit">
                                Добавить Студента
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