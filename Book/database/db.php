<?php
 mb_internal_encoding('UTF-8');

$db = mysqli_connect('localhost','root', '', 'books');
if (!$db) {
    echo 'No Database';
    exit;
}

mysqli_set_charset($db, 'utf8');