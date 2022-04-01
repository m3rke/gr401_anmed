<?php
// session_start(); 
// session_destroy();
// if (!(isset($_SESSION['auth']) && $_SESSION['auth'] === true)) {
// 	header("Location: admin.php?access=false");
// 	exit();
// }
// else {
 	// $admin = $_SESSION['admin'];
// }
require 'includes/snippet.php';
require 'includes/db-inc.php';
 include "includes/header.php";


 if(isset($_POST['submit'])){

    $news = sanitize(trim($_POST['news']));

    $sql = "INSERT into news (announcement) values ('$news')"; 

    $query = mysqli_query($conn,$sql);
    $error = false;

       if($query){
       $error = true;
      }
      else{
        echo "<script>alert('Не успешно! Попробуйте снова.');
                    </script>"; 
      }
 }

     if(isset($_POST['UpDat'])){
		$id = sanitize(trim($_POST['id']));
        $text = sanitize(trim($_POST['text']));

        $sql_up = "UPDATE news set announcement = '$text' where newsId = '$id'";
		echo mysqli_error($sql_up);
         $result = mysqli_query($conn,$sql_del);
                if ($result)
                {
                    echo "<script>
            
           
                   alert('Обновление выполнено успешно');

         </script>";
                }


     }

     if(isset($_POST['del'])){

        $id = sanitize(trim($_POST['id']));

        $sql_del = "DELETE from news where newsId = $id"; 

        $result = mysqli_query($conn,$sql_del);
                if ($result)
                {
                }

     }

  ?>

<div class="container">
    <?php include "includes/nav.php"; ?>

	<div class="alert alert-warning col-lg-7 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-0 col-sm-offset-1 col-xs-offset-0" style="margin-top:70px">

	    <h4 class="center-block"><strong> Добро пожаловать </strong> <span>
		 <?php echo $admin; ?></span> </h4>
	</div>
	

	</div>
	<div class="container">
		<div class="panel panel-default">

             <?php if(isset($error)===true) { ?>
        <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong>Запись успешно обновлена!</strong>
            </div>
            <?php } ?>
		  <div class="panel-heading">
		  	<div class="row">
		  		<h3 class="center-block">Опубликованные объявления</h3>
			</div>
		  </div>
		  <table class="table table-bordered">
         

      		<thead>
                <tr>
                    <th>NewsId</th>
                         <th>Объявление</th>
                          
                          <th>Удалить</th>
                </tr>
          </thead>

           <?php 

          $sql2 = "SELECT * from news";

      $query2 = mysqli_query($conn, $sql2);
      $counter = 1;
      while ($row = mysqli_fetch_array($query2)) {  ?>


        <tbody>
          <td><?php echo $counter++; ?></td>
          <td><?php echo $row['announcement']; ?></td>
         <form method='post' action='admin.php'>
        <input type='hidden' value="<?php echo $row['newsId']; ?>" name='id'>
       
        <td><button name='del' type='submit' value='Delete' class='btn btn-warning' onclick='return Delete()'>Удалить</button></td>
        </form>
        </tbody>

     <?php }
           ?>
		        
		         </tbody> 
		   </table>
		 
	  </div>

			<div class="panel panel-default">
				  <div class="panel-heading">
				    <h2 class="panel-title center-block">Публиковать новые объявления</h2>
				  </div>
	  <div class="panel-body">
	    <form role="form" action="admin.php" method="post">
				<div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					 <div class="form-group ">
					      <label for="name">Объявление</label>
					       <textarea class="form-control" rows="3" draggable="false" name="news">
					       </textarea>  
					  </div> 
					
				</div><br>
	<div class="input-group pull-right">
		<div class="form-group">
			<button class="btn btn-primary" name="submit">Подтвердить</button>
		</div>
	</div>
        				
        				</form>
				  </div>
			</div>
	</div>

	<div class="mod modal fade" id="popUpWindow">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal">&times;</button>
        				<h3 class="modal-title"> Предупреждение</h3>
        			</div>

        			<div class="modal-body">
        				<p>Вы уверены, что хотите удалить эту книгу?</p>
        			</div>

        			<div class="modal-footer ">
        				<button class="col-lg-4 col-sm-4 col-xs-6 col-md-4 btn btn-warning pull-right"  style="margin-left: 10px" class="close" data-dismiss="modal">
        					Нет
        				</button>&nbsp;
        				<button class="col-lg-4 col-sm-4 col-xs-6 col-md-4 btn btn-success pull-right"  class="close" data-dismiss="modal" data-toggle="modal" data-target="#info">
        					Да
        				</button>
        			</div>
        		</div>
        	</div>
        </div>
        <div class="modal fade" id="info">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal">&times;</button>
        				<h3 class="modal-title"> Предупреждение</h3>
        			</div>

        			<div class="modal-body">
        				<p>Книга удалена <span class="glyphicon glyphicon-ok"></span></p>
        			</div>

        		</div>
        	</div>
        </div>

        <div class="modal fade" id="update">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal">&times;</button>
        				<h2 class="modal-title"> Обновить</h2>
        			</div>

					<form role="form" action="admin.php" method="post" enctype="multipart/form-data">
        			<div class="modal-body">
        					<div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
        						<label for="name">Введите Id </label>
        						<input type="text" name="id" value=" <?php
								 echo $row['newsId'];
								 ?>
								">
								 <div class="form-group ">
        						      <label for="name">Объявление</label>
        						       <textarea class="form-control" rows="3" draggable="false" name="text" value="
									    ">
        						       </textarea>  
        						  </div> 
        						
        					</div>

        				
						
        			</div>

        			<div class="modal-footer">
        				<button  name ="UpDat" class="col-lg-12 col-sm-12 col-xs-12 col-md-12 btn btn-success" data-target="alert">
        					Обновить
        				</button>
        			</div>
					</form>
					
        		</div>
        	</div>
        </div>


  <script type="text/javascript">
        
        function Delete() {
            return confirm('Вы хотите удалить новость?');
        }

         function Update() {
            return confirm('Хотите обновить новости?');
        }

      </script>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>	
</body>
</html>