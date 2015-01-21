<?php
session_start();
mb_internal_encoding('UTF-8');
$title = 'Вход';
include './data/data.php';
require './database/db_connection.php';
?>
<?php
include './inc/header.php';
if (isset($_SESSION['isLogged']) == true) {
    header('Location: messages.php');
}
if (isset($_POST['submit'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
        
        $query = 'SELECT * FROM user WHERE username="'.$username.'" AND password = "'.$password.'"';
        $sql = mysqli_query($connection, $query);
       
        if ($sql->num_rows > 0) {
           //imame lognat potrebitel
            $rows = mysqli_fetch_assoc($sql);
          //  echo '<pre>' . print_r($rows, true) . '</pre>';   
            $_SESSION['isLogged'] = true;
            header('Location: messages.php');
            $_SESSION['user'] = $username;


        }else{
           echo 'Invalid name or password. Please try again!';
        }
       
              
    } else {
        echo 'Please try again!.Invalid name or password';
    }
} 

?>
 <div class="login">
        <h1>Login to Web App</h1>
        <form method="post" action="">
           <p><input type="text" name="username" placeholder="Username" value="" required="required"/></p>
           <p><input type="password" name="password" value="" placeholder="Password" required="required"/></p>
           <p class="submit"><input type="submit" value="Login" name="submit"</p>
        </form>
  </div>

<?php
include './inc/footer.php';
