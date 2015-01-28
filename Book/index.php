<?php
$pageTitle = 'List Books And Authors';
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
<!--<a href="authors.php">Authors</a><br/>
<a href="add_book.php">Books</a>-->
<?php
if (isset($_GET['author_id'])) {
    $author_id = (int)$_GET['author_id'];
    
    $q = mysqli_query($db, 'SELECT * FROM books_authors as ba 
        INNER JOIN books as b ON ba.book_id = b.book_id 
        INNER JOIN books_authors as bba ON bba.book_id = ba.book_id 
        INNER  JOIN authors as a ON bba.author_id = a.author_id
        WHERE ba.author_id  = ' . $author_id . ' ORDER BY b.book_title');
} else {
    $q = mysqli_query($db, 'SELECT * FROM books 
    INNER JOIN books_authors ON books.book_id = books_authors.book_id 
    INNER JOIN authors ON books_authors.author_id = authors.author_id  ORDER BY books.book_title');
}

$result = array();
echo '<table border="1" class="table_rows"><tr><th>Book Names</th><th>Author Names</th></tr>';
while($row = mysqli_fetch_assoc($q)){
   $result[$row['book_id']]['book_name'] = $row['book_title'];
   $result[$row['book_id']]['author_name'][$row['author_id']] = $row['author_name'];
}

//echo '<pre>' . print_r($result, true) . '</pre>';
foreach ($result as $bn) {
    echo '<tr>
        <td>'.$bn['book_name'].'</td><td>';
        $data = array();
        foreach ($bn['author_name'] as $k => $an) {
            $data[] = '<a href="index.php?author_id='.$k.'">'.$an.'</a>';
        }
        echo implode(', ', $data);
       
       echo '</td></tr>';
}

//echo '<pre>' . print_r($result, true) . '</pre>';
?>
     </div>
        </div>

<?php include './inc/footer.php';?>