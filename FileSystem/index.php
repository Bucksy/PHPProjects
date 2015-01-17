<?php
/*
Описание на страницата index
В тази страница трябва да има форма за въвеждане на име и парола.
При въвеждане на грешни такива, потребителят трябва да вижда съобщение за грешка.
--Ако потребител, който вече е влезнал в системата (има валидна сесия) влезе в тази
страница, трябва да бъде пренасочен към страницата със списъка на файловете
 */

session_set_cookie_params(3600, "/", 'localhost', false, true);
session_start();
$pageTitle = 'Вход за потребители';
require 'inc/data.php';
include 'inc/header.php';
?>
<?php
if (isset($_SESSION['logged'])) {
    header('Location: files.php');
    exit;
}else{
    if ($_POST) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    $errors = false;
    if (strlen($username) < 2) {
        echo '<p class="error">Too short Name</p>';
        $errors = true;
    }
    
    if (strlen($password) < 2) {
       echo '<p class="error">Too short Password</p>';
        $errors = true;
    }
    
    if($username == 'user' && $password == 'qwerty') {
        $_SESSION['logged'] = $username;
        header('Location: files.php ');
        exit;
    }else{
            echo '<p class="error">Invalid username or password. Please enter again!</p>';
        }  
}

?>
<div class="post">
<form method="POST">
    <label for="name">Username: </label><br/>
    <input type="text" name="username" id="name" require="required"/><br/>
    <label for="pass">Password: </label><br/>
    <input type="password" name="password" id="pass" require="required"><br/> 
    <input type="submit" class="loginBtn" value="Login"/>
</form>
 </div>
   </div>
   </div>
<?php
//echo '<pre>' . print_r($_POST, true) . '</pre>';
}
include 'inc/footer.php';
