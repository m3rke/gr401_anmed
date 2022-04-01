<?php 
require 'includes/db-inc.php';
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
            <a class="navbar-brand" href="studentportal.php">Library</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example">
            <ul class="nav navbar-nav">
                <li ><a href="studentportal.php">Главная</a></li>
            <li><a href="profile.php">Просмотреть профиль</a></li>
                    <li><a href="borrow-student.php">Заимствовать книги</a></li>
					<li><a href="fine-student.php">Мои книги</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">Выход</a></li>
            </ul>
        </div>
    </div>
</nav>