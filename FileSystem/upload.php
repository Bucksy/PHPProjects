<?php
/*
Описание на страницата upload
В този екран трябва да има форма, която да позволява на потребителя да качи нов файл.
 */
session_start();
$pageTitle = 'Нов файл';
require 'inc/data.php';
include 'inc/header.php';
?>
 <?php
           
if (!isset($_SESSION['logged'])) {
    echo 'Your session expired. Please log in again.
        <a href="index.php">Вход</a>';
   
    exit;
}
?>
<a class="files" href="files.php">Списък на файлове</a><br/>
<?php

    if (count($_FILES) > 0) {
    if (move_uploaded_file($_FILES['picture']['tmp_name'], 'pics'.DIRECTORY_SEPARATOR.$_FILES['picture']['name'])) {
      echo 'Успешно качване на файла!';
}else{
      echo 'Неуспешно качване на файла!';
}
  }
  
?>
<div class="newfile">
<form method="post" enctype="multipart/form-data" action="files.php">
    <label for="pic">Нов файл: </label><br/>
    <input type="file" name="picture"/><br/>
    <input type="submit" value="Качи файла"/>
</form>
</div>
       </div>
   </div>
<?php

include 'inc/footer.php';
