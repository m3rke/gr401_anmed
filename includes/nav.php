<?php 
session_start();

if (isset($_SESSION['admin'])) {
     $admin = $_SESSION['admin'];
}

if (isset($_SESSION['student-name'])) {
     $student = $_SESSION['student-name'];
   
}
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example">
                <span class="sr-only">:</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Library Management System</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example">
            <ul class="nav navbar-nav">
                <?php if(isset($admin)) { ?>  
                <li class="active"><a href="admin.php">Главная</a></li>
                <li><a href="bookstable.php">Книги</a></li>
                <li><a href="users.php">Администраторы</a></li>
                <li><a href="viewstudents.php">Студенты</a></li>
                <li><a href="borrowedbooks.php">Заимствованные книги</a></li>
                <li><a href="fines.php">Возвращённые книги</a></li>
                <?php } ?>
                <?php if(isset($student)) { ?>
              <li class="active"><a href="studentportal.php">Главная</a></li>
            <li><a href="profile.php">Просмотреть профиль</a></li>
            <li><a href="borrow-student.php">Заимствовать книги</a></li>
            <li><a href="fine-student.php">Мои книги</a></li>
            </ul> 
            <?php } ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">Выход</a></li>
            </ul>
        </div>
    </div>
</nav>