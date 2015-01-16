<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Mr. Sport - Admin panel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://localhost/mr-sport/css/bootstrap.min.css">
    <script src="http://localhost/mr-sport/js/bootstrap.min.js"></script>
</head>
<body>
<header class="admin-header">
    <div class="container-fluid">
        <nav id="myNavbar" class="navbar navbar-default" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Mr.Sport</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="">Главная</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Соревнования <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="http://localhost/mr-sport/index.php/admincompetition">Все соревнования</a></li>
                                <li><a href="http://localhost/mr-sport/index.php/admincompetition/competitionEdit">Добавить соревнование</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Люди <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="http://localhost/mr-sport/index.php/adminpersons">Все люди</a></li>
                                <li><a href="http://localhost/mr-sport/index.php/adminpersons/personEdit">Добавить человека</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Города <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="http://localhost/mr-sport/index.php/adminplaces">Все города</a></li>
                                <li><a href="http://localhost/mr-sport/index.php/adminplaces/placeEdit">Добавить город</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
</header>
<main class="admin-main wrapper">
    <div class="container-fluid">