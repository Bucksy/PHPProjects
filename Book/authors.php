<?php
//Описание на страницата
//"Нов автор"
//В този екран потребителят трябва да може да въведе нов автор, като и да вижда списък
//с всички налични автори.
//Името на автора не трябва да е по-малко от 3 символа.
//Трябва да се направи проверка, дали автора, който се опитваме да добавим, вече не
//съществува в списъка. Ако съществува, трябва да се покаже съответното съобщение.
//Имената а авторите са линкове,които водят към страницата със списък на всички книги
//за даден автор

$pageTitle = 'List of Authors';
include './database/db.php'; 
include './inc/data.php';
include './functions.php';
include './inc/header.php';
?>
 <div class="container">
            <div class="top">
                <div class="logo">
                    <a href="index.php">
                        <img class="logo1"src="img/book-logo.png"></img>
                    </a>
                </div>
                <div class="date">
                
                </div>
                <div class="menu">
                    <ul>
                        <?php
                        foreach ($menu as $value) {
                            echo '<li><a href="' . $value['link'] . '">' . $value['name'] . '</a></li>';
                        }
                        ?>
                    </ul> 
                    <div class="greeting">
                        <?//= 'Hello, ' . $username . '!';
                        ?>
                    </div>
                </div>
            </div>
     <div class="body">
   <div class="login">
        <form id="loginForm" method="POST" action="authors.php">
            <label for="username">Author Name:</label><br/>
            <input type="text" name="author_name" class="textField"/><br/>
            <input type="submit" name="submit" value="Add Author" id="loginBut"/>
        </form>
 </div>
<?php

//Проверка дали имаме инфо. пратена от POST- заявка
if(isset($_POST['submit'])) {
    if (!empty($_POST['author_name'])) {
        $author_name = trim($_POST['author_name']);
        $errors = array();
        
        if (mb_strlen($author_name) < 2) {
//           echo '<p>Invalid author name!</p>';
            $errors[] = '<p>Invalid author name!</p>';
        }
        if (count($errors) > 0) {
            foreach ($errors as $value) {
                echo '<p class="err">'.$value.'</p>';
            }
        }
        else {
        $author_esc = mysqli_real_escape_string($db,$author_name);
        //Проверка Трябва да се направи проверка, дали автора, който се опитваме да добавим, вече не
       //съществува в списъка.
        $q = mysqli_query($db, 'SELECT * FROM authors 
          WHERE author_name = "'.$author_esc.'"'); 
        
        if(checkDBForError($db)){
            echo 'Error';
        }
    
        if (mysqli_num_rows($q) > 0) {
            echo '<p class="exist">Author Name exists! . Please try another name!</p>';
            //header('Location: authors.php');
        }else{
            //insert in db
           $q = mysqli_query($db, 'INSERT INTO authors (author_name)
                               VALUES("'.$author_esc.'")');
           
           if(checkDBForError($db)){
            echo 'Error';
                }
            }
           
          }
    }else{
        echo '<p class="error">Please type the name of author<p>';
    }
}

$authors = getAuthors($db);
if ($authors === false) {
    echo 'Error';
}
?>
         <div class="table">
<table border="1">
    <tr><th>Authors</th></tr>
        <?php
        foreach ($authors as $author) {
              echo '<tr>
                  <td>'.$author['author_name'].'</td>
                 </tr>';
      }
        
//         while($row = mysqli_fetch_assoc($q)){
//             echo '<tr>
//                   <td>'.$row['author_name'].'</td>
//                  </tr>';
//         }
        ?>
</table>
         </div>
     </div>
 </div>
<?php include './inc/footer.php';?>