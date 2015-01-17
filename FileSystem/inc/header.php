<?php mb_internal_encoding('UTF-8');?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="description" content="File System">
  <meta name="keywords" content="File, Pictures, Uploads">
  <link rel="stylesheet" href="css/style.css"/>
  <title><?=$pageTitle; ?></title>
</head>
<body class="home">
     <div class="container">
            <div class="top">
                <div class="logo">
                    <a href="index.php">
                    <img class="logo1"src="img/r.png"></img>
                    </a>
                </div>
                <div class="date">
                     <?= $today; ?>
                </div>
                <div class="menu">
                    <ul>
                        <?php
                         foreach ($menu as $value) {
                              echo '<li><a href="'.$value['link'].'">'.$value['name'].'</a></li>';
                          }                    
                          ?>
                    </ul> 
                  <div class="greeting">
                    Hello, Anonymous!
                </div>
                </div>
              
            </div>
       <div class="body">
  