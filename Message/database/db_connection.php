<?php
$connection = mysqli_connect('localhost', 'gatakka', 'qwerty', 'telerik');
if (!$connection) {
    echo mysqli_errno($connection);
    exit;
}

mysqli_set_charset($connection, 'utf8');