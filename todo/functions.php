<?php

//VIEW - tasks = array(); or 
function init(){
$tasks = array(
    0=>array(
        'id'=>'1',
        'name'=> 'Task 1',
        'description'=> 'Description for Task 1',
        'priority'=>'High',
        'created'=> '2015-01-20 17:00',
        'dueDate'=> '2015-01-20 05:00' // date($timeFormat, mktime(22, 0, 0, 1, 20, 2015)),// date($timeFormat , strtotime(+1 day));
    ),
     1=>array(
        'id'=>'2',
        'name'=> 'Task 2',
        'description'=> 'Description for Task 2',
        'priority'=>'Low',
        'created'=>'2015-01-19 12:00',
        'dueDate'=>'2015-01-20 09:00'
    ),
     2=>array(
        'id'=>'3',
        'name'=> 'Task 3',
        'description'=> 'Description for Task 3',
        'priority'=>'Medium',
        'created'=>'2015-01-15 12:07',
        'dueDate'=>'2015-01-20 15:00'
    ),
);

$json = json_encode($tasks);//convertiravame masiv kum json
file_put_contents('./data/tasks.json', $json);

}

function listTasks(){
// return array(
//    0=>array(
//        'id'=>'1',
//        'name'=> 'Task 1',
//        'description'=> 'Description for Task 1',
//        'priority'=>'High',
//        'created'=> '2015-01-20 17:00',
//        'dueDate'=> '2015-01-20 05:00' // date($timeFormat, mktime(22, 0, 0, 1, 20, 2015)),// date($timeFormat , strtotime(+1 day));
//    ),
//     1=>array(
//        'id'=>'2',
//        'name'=> 'Task 2',
//        'description'=> 'Description for Task 2',
//        'priority'=>'Low',
//        'created'=>'2015-01-19 12:00',
//        'dueDate'=>'2015-01-20 09:00'
//    ),
//     2=>array(
//        'id'=>'3',
//        'name'=> 'Task 3',
//        'description'=> 'Description for Task 3',
//        'priority'=>'Medium',
//        'created'=>'2015-01-15 12:07',
//        'dueDate'=>'2015-01-20 15:00'
//    ),
//);
    
   //init();
   $json =  file_get_contents('./data/tasks.json');
   $tasks = json_decode($json,true);//ot json -> masiv
//   echo '<pre>' . print_r($tasks, true) . '</pre>';
   return $tasks;
 
}


function createTasks() {
    $tasks = listTasks(); //read file 1 and 2
    //
    //step 3 
    if(empty($_POST)) {
        echo 'Empty Post array, plese fill the fields!!!!!!!!!!!<br/>';
        return; //izliza ot funkciqta no koda si produljava 
    } else {
    //TODO Validation of data
        $task = array(
            'id' => $_POST['id'], //TODO Generate sequent ID
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'priority' => $_POST['priority'],
            'created' => $_POST['created'],
            'dueDate' => $_POST['dueDate'],
        );
        $tasks[] = $task;
        $json = json_encode($tasks); //convertiravame masiv kum json 
        file_put_contents('./data/tasks.json', $json);
//        print_r($json);
    }
}
//funciqtta koqto sortira vs fields in array , 0 - vuzhodqsht 

/**
 * Compare two arrays by date
 * 
 * @param two arrays
 * $param int $order 0 for ascending order. 1  - descending order
 * @return 0 - if the dates are equal
 * @return -1 - if the first date is smaller than the second date
 * return 1 - if the first date is  bigger than the second date 
 */

function toggle() {
    if (isset($_GET['order'])) {
        return $_GET['order'] == 0 ? 1 : 0;
//          return (int)!$_GET['order'];, poneje ni vrushta kato bool(false) ili bool(true)
    }
    return 1; 
}


//Sort all fields in array tasks
function sortAll(&$tasks, $order) {
    if (isset($_GET['field']) && isset($_GET['order'])){
        if ($order == 0) {
            uasort($tasks, function ($a, $b) {
               return strcmp($a[$_GET['field']] ,$b[$_GET['field']]);//0 - 1, 1 
                    });
        } else{
            uasort($tasks, function($a, $b) {
                        return strcmp($b[$_GET['field']] ,$a[$_GET['field']]);
                    });
        }
    }
}

function updateTasks(){
    //TODO
}

function deleteTasks(){
    //TODO
    header('Location: /todo/index.php?page=tasks&action=list');
    exit;
}
//
//function jsonPutInFile($arr){
//   $json = json_encode($arr);
//   file_put_contents('data/tasks.json', $json);
//}
//
//function jsonGetFromFile($file){
//    $text = file_get_contents($file);
//    $arr = json_decode($text, true);
//    return $arr;
//}
//
//print_r(jsonGetFromFile('data/tasks.json'));
//jsonPutInFile($tasks);

//function listTasks() {
//    echo 'Tasks';//zarejdane na dannite
//}

//page = tasks , TAzi funckiq ,kogato q vikame - togava imame v body - tablicata 
//MVC- shablona na design, vs frameworks rabotqt s tozi shablon 
//CONTROLLER - processRequest();
//ListTasks () - Model
//View =  include "./$includeFile.php";//list.php;


function proccessRequest(){
    if (isset($_GET['page'])) { //http://localhost/todo/functions.php?page=tasks
        $defaultAction = 'list';// 
        $page = $_GET['page']; // $page=tasks
        
        echo "Page: . $page<br/>" ;
        
        if (isset($_GET['action'])) { //http://localhost/todo/functions.php?page=tasks&action=list
            $action = $_GET['action']; // action = list
            //trqbva da zaredim dannite s listTask() ; za primer
            echo "Action : $action";
            
           $function = $action. ucfirst($page);//list.Tasks() = function listTasks(); = $data = masiv s taskovete otgore
           echo '<br/>';
           echo "Function name: $function ()<br/>";
          
          // $data = $function(); //listTask();
//           switch ($action) {
//               case 'list': listTasks();
//                   break;
//               case 'update': updateTasks();
//               default: 
//                   break;
//           }
//           updateTask();
//           deleteTask();
            
            $includeFile =  "$page/$action"; //tasks/list
            //include "./$includeFIle.php";
        }else{
            
             $function = $defaultAction . ucfirst($page);//listTasks
             echo "Function name:  $function()<br/>";
             $includeFile = "$page/$defaultAction"; // tasks / action = list , ako nqmame tasks a samo action - nqma da raboti, tui kato ne sme proverili za tozi sluchai
        }
       
        $data = $function();//listTasks(); - return array of tasks 
          
        echo "Include File: $includeFile.php<br/>";//Include File: tasks/list.php
        include "./$includeFile.php";//list.php;
    }
}

//celta koda ni e da guvkav i da ne stane hardcorenato kakto otdolu : 

//function processFileHardcore(){
//    if (isset($_GET['page']) == 'tasks') {
//        if (isset($_GET['action'])) {
//            switch ($_GET['action']){
//                case 'list':
//                    $data = listTasks();//table ot list.php
//                    include '/tasks/list.php';//vikame faila koito da go vizualizira
//                    break;
//                case 'create':
//                    $data = createTasks();//table ot list.php
//                    include '/tasks/create.php';//vikame faila koito da go vizualizira
//                    break;
//                case 'update':
//                    $data = updateTasks();//table ot list.php
//                    include '/tasks/update.php';//vikame faila koito da go vizualizira
//                    break;
//            }
//           
//        }
//    }else if(isset($_GET['page']) && $_GET['page'] == 'users'){
//         switch ($_GET['action']){
//                case 'list':
//                    $data = listTasks();//table ot list.php
//                    include '/tasks/list.php';//vikame faila koito da go vizualizira
//                    break;
//                case 'create':
//                    $data = createTasks();//table ot list.php
//                    include '/tasks/create.php';//vikame faila koito da go vizualizira
//                    break;
//                case 'update':
//                    $data = updateTasks();//table ot list.php
//                    include '/tasks/update.php';//vikame faila koito da go vizualizira
//                    break;
//            }
//           
//    }
//}

function getAllParams(){
    if(isset($_GET['action'])){
       return "page=".$_GET['page']. "&" ."action=". $_GET['action'];
    }
    return "page=".$_GET['page'];
}