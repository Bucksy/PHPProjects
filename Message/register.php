<?php
session_start();
mb_internal_encoding('UTF-8');
$title = 'Регистрация';
include './data/data.php';
require './database/db_connection.php';
?>
<?php
include './inc/header.php';
if (isset($_POST['submit'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = htmlentities($_POST['password']);
        $username = mysqli_real_escape_string($connection,$username);
        $password = mysqli_real_escape_string($connection,$password); 
        
          // Минималната дължина на името и паролата е 5 символа
         //Не може да има потребители с еднакво име
        
        $errors = false;
        if (mb_strlen($username) < 4) {
            echo '<p>Too short name!</p>';
            $errors = true;
        }
        if (mb_strlen($password) < 4) {
              echo '<p>Too short password!</p>';
              $errors = true;
        }
        //ako nqmame grshka togava zapisvame v bazata 
        //proverka dali imame ednakvi potrebiteli
        
        $sql = 'SELECT * FROM user WHERE username = "'.$username.'"';
        $query = mysqli_query($connection, $sql);
        
        if (!$errors) {
            if ($query->num_rows > 0) {
                 echo '<p class="error">The username exists. Please choose something else!</p>';
            }
        }else{
           header('Location: register.php');
        }
        
        $sql1 = 'INSERT INTO user (username, password)
                 VALUES ("'.$username.'", "'.$password.'")';
        $query1 = mysqli_query($connection, $sql1);
        if ($query1 === TRUE) {
            //echo "New record created successfully";
            header('Location: index.php');
        }else{
            echo "Error: " . $query1 . "<br>" . mysqli_error($connection);
        }
                 
       
    }else{
        echo '<p class="error">Invalid username or password. Please try again!</p>.';
    }
}
//echo '<pre>' . print_r($_POST, true) . '</pre>';
?>

<div class="register">
    <h1>Register</h1>
    <form method="post" action="">
           <p><input type="text" name="username" placeholder="Username" value="" required="required"/></p>
           <p><input type="password" name="password" value="" placeholder="Password" required="required"/></p>
           <p class="submit"><input type="submit" value="Register" name="submit"</p>
    </form>
</div>


<?php
include './inc/footer.php';