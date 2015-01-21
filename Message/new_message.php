<?php
session_start();
mb_internal_encoding('UTF-8');
$title = 'Ново съобщение';
include './data/data.php';
require './database/db_connection.php';
?>
<?php
include './inc/header.php';

if (isset($_POST['submit'])) {
    if (!empty($_POST['title']) && !empty($_POST['textarea'])) {
        
        $title = trim($_POST['title']);
        $title = mysqli_real_escape_string($connection, $title);
        $message = trim($_POST['textarea']);
        $message = mysqli_real_escape_string($connection,$message);
        $today = date('Y-m-d  H:i:s');
        $errors = array();

        if (mb_strlen($title) < 1 || mb_strlen($message) < 1) {
            $errors[] = '<p class="error">Too short title or message</p>';
        }
        if (mb_strlen($title) > 50 || mb_strlen($message) > 250) {
            $errors[] = '<p class="error">Too long message.</p>';
        }
        if (count($errors) > 0) {
            foreach ($errors as $value) {
                echo $value.'<br/>';
            }
        }else{
            $sql = 'INSERT INTO messages (title, message, date, author)
                VALUES ("'.$title.'", "'.$message.'", "'.$today.'", "'.$_SESSION['user'].'")';
            $query = mysqli_query($connection, $sql);
            if ($query === TRUE) {
                header('Location: messages.php');
            }else{
                echo 'Something went wrong. Please try again!';
            }
        }
    }else{
        echo 'Please enter again!';
    }
}
?>
<a style="font-size: 30px; color: blue;" href="messages.php">Click here to see the messages</a>
<div>
    <form method="post">
        Title:  <br/>
        <input type="text" name="title" placeholder="Title" value="" required="required"/><br/>
        Please enter a Message: <br/>
        <textarea rows="8" cols="50" name="textarea" placeholder="Message" value="" required="required"></textarea><br/>
        <input type="submit" value="Register" name="submit"/><br/>
    </form>
</div>

<?php
include './inc/footer.php';