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

writeTasks($tasks);
}

//init();

function listTasks(){ //Tasks Array
    
   $json =  file_get_contents('./data/tasks.json');
   $tasks = json_decode($json,true);//ot json -> masiv
   return $tasks;
   
}


function createTasks() {
    $tasks = listTasks(); //read file 1 and 2
    //step 3 
    if(empty($_POST)) {
        //echo 'Empty Post array, plese fill the fields!!!!!!!!!!!<br/>';
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
        $tasks[] = fetchPostData();
        writeTasks($tasks);
    }
}

function updateTasks() {

    $tasks = listTasks();
    $id = $_GET['id'];

    foreach ($tasks as $key => $task) {
        if ($id == $task['id']) {
            if (empty($_POST)) {
                return $tasks[$key]; //data
            } else {
                $tasks[$key] = fetchPostData();
            }
            writeTasks($tasks);
        }
        redirectToDefaultPage();
    }
}

function deleteTasks(){
    
    $tasks = listTasks();
    if (empty($_GET['id'])) {
        $_GET['id']= '';
    }
    $id = $_GET['id'];
    
    foreach ($tasks as $key => $task) {
        if ($id == $task['id']) {
            unset($tasks[$key]);
            break;
        }
    }
    
    writeTasks($tasks);
 
    redirectToDefaultPage();
}

function writeTasks($tasks){
   $json = json_encode($tasks);//CONVERT INTO JSON and put it in the file
   file_put_contents('./data/tasks.json', $json);
}

function fetchPostData() {
    return array(
            'id' => $_POST['id'], //TODO Generate sequent ID
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'priority' => $_POST['priority'],
            'created' => $_POST['created'],
            'dueDate' => $_POST['dueDate'],
        );
}

function redirectToDefaultPage(){
     header('Location: index.php?page=tasks&action=list');
     exit;
}

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


function getAllParams(){
    if(isset($_GET['action'])){
       return "page=".$_GET['page']. "&" ."action=". $_GET['action'];
    }
    return "page=".$_GET['page'];
}