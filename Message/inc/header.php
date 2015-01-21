<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="styles/style.css"/>
        <title><?= $title;?></title>
    </head>
    <body>
        <div class="wrapper">
            <div class="top">
                <div class="logo">
                    <a href="index.php">
                        <img class="logo1" src="img/m1.jpg"></img>
                    </a>
                </div>
                <div class="date">
                    <a href="register.php"><strong>Register</strong></a>
                </div>
                <div class="date">
                    <a href="inc/destroy.php"><strong>Log out</strong></a>
                </div>
                <div class="menu">
                    <ul>
                        //<?php
//                        foreach ($menu as $li) {
//                            echo '<li><a href="'.$li['link'].'">'.$li['name'].'</a></li>';
//                        }
//                        ?>
                    </ul>
                    <div class="greeting">
                        <?php
                        if (isset($_SESSION['isLogged'])) {
                            echo '<p class="username">Hello ,'. $_SESSION['user'] .'!</p>';
                        }else{
                            echo '<p class="username">Hello, Anonymous!<p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="container">