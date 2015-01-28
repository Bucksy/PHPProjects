<?php
/*В този екран потребителят трябва да може да въведе нова книга,като и да избере авторите
на книгата
Името на книгата не трябва да е по-малко от 3 символа.
Избора на автори става със <select multiple>
Връзката “Книги” ни връща в екрана със списък на всички книги
 */

$pageTitle = 'List of Books';
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
<form method="POST" action="add_book.php">
    <label for="book_name">Book Name:</label><br/>
    <input type="text" name="book_name" id="textField"/><br/>
     <?php 
           $q = mysqli_query($db, 'SELECT * FROM authors');
           if(checkDBForError($db)){
              echo '<p class="errors"Something went wrong!. Please try again!></p>';
           }
           ?>
  
        <label for="auth">Authors </label><br/>
          <select name="authors[]" multiple="multiple" class="authors_name">
              <?php
              $authors = getAuthors($db);
              if($authors === false){
                  echo 'Error';
                 // header('Location: 500.php'); //output buffering - 
                 //exit;
              }else{
                  foreach($authors as $author){
                      echo '<option value="'.$author['author_id'].'">'.$author['author_name'].'</option>';
                  }
              }
              ?>
               </select>
   
      <input type="submit" name="submit" value="Add Book" id="log"/>
</form>
         </div>
<?php
if ($_POST) {
    $book_name = trim($_POST['book_name']);
    $book_esc = mysqli_real_escape_string($db, $book_name);
    if (!isset($_POST['authors'])) {
        $_POST['authors'] = '';
    }
    $authors = $_POST['authors'];
    $errors = array();
    if (mb_strlen($book_name) < 3) {
        $errors[] = '<p class="errors">Invalid book name!</p>';
    }
    //check if we have added authors in POST
    if (!is_array($authors) || count($authors) == 0) {
        $errors[] = '<p class="errors">Invalid authors!</p>';
    }
    //Check if the array authors has the right ids
//    foreach ($authors as $value) {
//        if (!isAuthorIdExist($db, $value)) {
//            $errors[] = '<p>Invalid id author!</p>';
//        }
//    }
    if (!isAuthorIdExist($db, $authors)) {
         $errors[] = '<p class="errors">Please try again!</p>';
    }
    if (count($errors) > 0) {
        foreach ($errors as $value) {
            echo $value . '<br/>';
        }
    }else{
        $q1 = mysqli_query($db, 'SELECT * FROM books WHERE book_title = "'.$book_esc.'"');
        if(checkDBForError($db)){
            echo 'Error';
        }
        if (mysqli_num_rows($q1) > 0) {
            echo 'Book Name exists! . Please try other names!';
        }else{
        mysqli_query($db, 'INSERT INTO books (book_title) VALUES("'.  mysqli_real_escape_string($db, $book_name).'")');
        if (checkDBForError($db)) {
            echo 'Error';
        }
        //osven  s select book_id from books - 
        $book_id = mysqli_insert_id($db);//last id in books
        //poneje moje da imame poveche ot 1 edin author_id trqbva da foreach
        foreach ($authors as $authorId) {
                mysqli_query($db, 'INSERT INTO books_authors (book_id, author_id)
                VALUES(' . $book_id . ', ' . $authorId . ')');
                if (checkDBForError($db)) {
                    echo 'Error';
                }
            }

            echo '<p class="errors">Book is added!</p>';
        }
    }
}


?>
     </div>
 </div>
<?php include './inc/footer.php';?>