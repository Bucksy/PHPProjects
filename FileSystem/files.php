<?php

/*
Описание на страницата files
В този екран трябва да има спъсик на всички файлове, които са качени от потребителя
Всеки файл трябва да се визуализира със своето име, и трябва да бъде линк.
Когато бъде натиснат линка, файла трябва да може да бъде свалян
 */
session_start();
$pageTitle = 'Списък Файлове';
require 'inc/data.php';
include 'inc/header.php';
?>

           
     <?php
if (!isset($_SESSION['logged'])) {
    echo 'Your session expired .Please log in again. <a href="index.php">Вход</a>';
   
    exit;
}

?>
<a class="destroy" href="inc/destroy.php">Изход</a>

<div class="upload">
    <table border="1">
        <tr>
            <td>Качени файлове</td>
        </tr>
        <?php
            $files = scandir('pics');
            foreach ($files as $value) {
                echo '<tr><td><a href="pics/'.$value.'" download='.$value.'"><br />'.$value.'</a></td></tr>';
            }
         ?> 
    </table>
</div>
</div>
   </div>
<?php
include 'inc/footer.php';
