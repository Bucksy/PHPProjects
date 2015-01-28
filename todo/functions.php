<?php

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

