<?php
mb_internal_encoding('UTF-8');
include 'inc/header.php';
$groups = array(1=>'Храна', 2=>'Транспорт', 3=>'Други');
$arr = array('Дата','Име','Сума','Вид');
$menu = array(
       0 => array(
           'name'=>'Начало', 
           'link'=>'index.php'
           ),
    1 => array(
           'name'=>'Нов Разход', 
           'link'=>'form.php'
           ),
    2 => array(
           'name'=>'Разходи', 
           'link'=>'index.php'
           ),
);
//Validation and Normalization of data
if(isset($_GET['submit'])) {
    $name = trim($_GET['name']);
    $sum = floatval($_GET['sum']);
    $selectedGroup = (int)$_GET['group'];//1,2,3
    
    $errors = false;
    if (strlen($name) < 3) {
        echo '<p>Too Short Name</p>';
        $errors = true;
    }
    if(strlen($sum) <= 0){
         echo '<p>Too Short Sum</p>';
        $errors = true;
    }
    if (!array_key_exists($selectedGroup, $groups)) {
          echo '<p>Невалиден вид!</p>';
         $errors = true;
    }
    
    $today = date("d-m-Y");
    
    if (!$errors) {
        $result = $today . '!' . $name. '!' .$sum . '!'. $selectedGroup. "\n";
        if(!file_exists('data.txt')){
            echo 'File not exist!';
        }else{
             if(file_put_contents('data.txt', $result, FILE_APPEND)){
                 echo 'Sucessfully added';
             }else{
                 echo 'Not added';
             }
        }
    }
}

//echo '<pre>' . print_r($_POST, true) . '</pre>';
?>
<div class="wrapper">
    <div class="header">
        <div class="logo">
            <img class="logo1" src="img/p_1.png"></img>
        </div>
        <div class="menu">
            <ul>
                <?php
                foreach ($menu as $value) {
                    echo '<li><a href="'.$value['link'].'">'.$value['name'].'</a></li>';
                }
                ?>
<!--                <li>Начало</li>
                    <li>Нов Разход</li>
                    <li>Разходи</li>-->
            </ul>
        </div>
    </div>
<div class="form">
<h2><a href="index.php">Списък</a></h2>

<form method="GET" action="index.php">
    <div id="leftSide">
    <label for="nameFood">Име:</label>
    <input type="text" name="name" id="nameFood" required="required" class="textField"/><br/>
    <label for="sum">Сума:</label>
    <input type="text" name="sum" required="required" class="textField"><br/>
    <select name="group">
        <?php
        foreach ($groups as $key=> $value) {
            echo '<option value="'.$key.'">'.$value.'</option>';
        }
        ?>
    </select><br/>
    <input class="loginBut" type="submit" name="submit" value="Submit"/> 
    </div>
</form>
</div>
</div>
<?php
include 'inc/footer.php';