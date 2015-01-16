<?php
include 'inc/header.php';
$groups = array(1=>'Храна', 2=>'Транспорт', 3=>'Други',);
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
//echo '<pre>' . print_r($menu, true) . '</pre>';
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
    <div class="body">
        <h2><a href="form.php">Добави нов разход</a></h2>
        <form method="GET">
          <select name="group" class="select">
              <option value="0">Всички</option>
                <?php
                foreach ($groups as $key=> $value) {
                     echo '<option value="'.$key.'">'.$value.'</option>';
                }
                    ?>
          </select>
        <input type="submit" value="Филтрирай"/>
        </form>
<table border="1">
    <tr>
        <?php
        foreach ($arr as $value) {
            echo "<td>$value</td>";
        }
        ?>
<!--        <td>Дата</td>
        <td>Име</td>
        <td>Сума</td>
        <td>Вид</td>-->
    </tr>
 <?php
if (file_exists('data.txt')) {
    if(file_get_contents('data.txt')){
        $row = file('data.txt');//rows of data.txt
        //echo '<pre>' . print_r($row, true) . '</pre>';
        $sum = 0;
        foreach ($row as $value) {
            $result = explode("!",$value);
         //  echo '<pre>' . print_r($result, true) . '</pre>';
            
       if (isset($_GET['group']) && $_GET['group'] > 0 && (int)$_GET['group']!=(int)$result[3]) { //t.e shte napravim obratnoto - ako != , continue- t.e preskochi iteraciqta
                    continue;
       
       }
           $sum += $result[2]; 
           echo '<tr>
                <td>'.$result[0].'</td>
                <td>'.$result[1].'</td>
                <td>'.number_format($result[2],2, '.', '').'</td>
                <td>'.$groups[trim($result[3])].'</td>
                </tr>';
        }
        echo '<tr>
            <td></td>
            <td></td>
            <td>Обша сума :  '.$sum.'<td>
            </tr>'; 
    }
}else{
    echo 'File not existed';
}
?>
    </div>
</div>
<?php
include 'inc/footer.php';