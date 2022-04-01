<?php 
require 'includes/snippet.php';
require 'includes/db-inc.php';
include "includes/header.php"; 

if(isset($_POST['del'])){

	$id = sanitize(trim($_POST['id']));

	$sql_del = "DELETE from books where BookId = $id"; 
	$error = false;
	$result = mysqli_query($conn,$sql_del);
			if ($result)
			{
			$error = true;
			}

 }

?>

<div class="container">
    <?php include "includes/nav.php"; ?>
	<div class="alert alert-warning col-lg-7 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-0 col-sm-offset-1 col-xs-offset-0" style="margin-top:70px">
	    <strong>Таблица Книг</strong>
	</div>

	</div>
	<div class="container">
		<div class="panel panel-default">
		  <div class="panel-heading">
		  	 <?php if(isset($error)===true) { ?>
        <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong>Запись успешно удалена</strong>
            </div>
            <?php } ?>
		  	<div class="row">
		  	  <a href="addbook.php"><button class="btn btn-success col-lg-3 col-md-4 col-sm-11 col-xs-11 button" style="margin-left: 15px;margin-bottom: 5px"><span class="glyphicon glyphicon-plus-sign"></span> Добавить книгу</button></a>
			  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
			  </div>
			</div>
		  </div>
		  <table class="table table-bordered">
	 <thead>
	 <tr>
		 <th>BookId</th>	
			  <th>bookTitle</th>
			  <th>author</th>
			  <th>ISBN</th>
			  <th>bookCopies</th>
			  <th>publisherName</th>
			  <th>available</th>
			  <th>categories</th>
			  <th>callNumber</th>
			   <th>Delete</th>
	 </tr>
</thead>

  <?php 


if(isset($_POST['search'])){
	
	$text = sanitize(trim($_POST['text']));

	 $sql = "SELECT * FROM books where BookId = $text ";

	 $query = mysqli_query($conn, $sql);

	 

	 while($row=mysqli_fetch_array($query)){ ?>
		<tbody>
			
		<td><?php echo $row['bookId']; ?></td>
		<td><?php echo $row['bookTitle']; ?></td>
		<td><?php echo $row['author']; ?></td>
		<td><?php echo $row['ISBN']; ?></td>	
		<td><?php echo $row['bookCopies']; ?></td>
		<td><?php echo $row['publisherName']; ?></td>
		<td><?php echo $row['available']; ?></td>
		<td><?php echo $row['categories']; ?></td>
		<td><?php echo $row['callNumber']; ?></td>
		<form method='post' action='bookstable.php'>
		<input type='hidden' value="<?php echo $row['bookId']; ?>" name='id'>
		<td><button name='del' type='submit' value='Delete' class='btn btn-warning' onclick='return Delete()'>УДАЛИТЬ</button></td>
		</form>
		</tbody>
	<?php  }
 }
 else{
	$sql2 = "SELECT * from books";

	$query2 = mysqli_query($conn, $sql2); 
	$counter = 1;
	while ($row = mysqli_fetch_array($query2)) { ?>
	<tbody>
		<td><?php echo $counter++; ?></td>
		<td><?php echo $row['bookTitle']; ?></td>
		<td><?php echo $row['author']; ?></td>
		<td><?php echo $row['ISBN']; ?></td>	
		<td><?php echo $row['bookCopies']; ?></td>
		<td><?php echo $row['publisherName']; ?></td>
		<td><?php echo $row['available']; ?></td>
		<td><?php echo $row['categories']; ?></td>
		<td><?php echo $row['callNumber']; ?></td>
		<form method='post' action='bookstable.php'>
		<input type='hidden' value="<?php echo $row['bookId']; ?>" name='id'>
		<td><button name='del' type='submit' value='Delete' class='btn btn-warning' onclick='return Delete()'>УДАЛИТЬ</button></td>
		</form>
		</tbody>
	
<?php 	}
	
 } 

 ?>
		   </table>
		 
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
		




<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>	
<script>
 function Delete() {
            return confirm('Вы хотите удалить новость?');
        }
</script>
</body>
</html>