<?php
session_start();
mb_internal_encoding('UTF-8');
$title = 'Съобщения';
include './data/data.php';
require './database/db_connection.php';
?>
<?php
include './inc/header.php';
?>
<a style="font-size: 30px; color: blue;" href="new_message.php">New Message</a>
<?php
$sql = 'SELECT title AS Title, message AS Message, date AS Date, author AS Author
       FROM messages 
       ORDER BY Date ASC';
$mysql = mysqli_query($connection, $sql);
//echo '<pre>' . print_r($mysql, true) . '</pre>';

if ($mysql->num_rows > 0) {
        echo '<table border="1"><tr><td>Title</td><td>Message</td><td>Date</td><td>Author</td></tr>';
        while($row = $mysql->fetch_assoc()){
            echo '<tr>
                   <td>'.$row['Title'].'</td>
                   <td>'.$row['Message'].'</td>
                   <td>'.$row['Date'].'</td>
                   <td>'.$row['Author'].'</td>
                 </tr>'; 
            }
        echo '<table>';
    }else{
        echo 'No messages are added';
    }
?>
<?php

include './inc/footer.php';