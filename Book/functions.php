<?php

function checkDBForError($db) {
    return (bool)mysqli_error($db); // return string ,  else () - false 
}

function getAuthors($db){
     $q = mysqli_query($db, 'SELECT * FROM authors');
     if(checkDBForError($db)){
         return false;
     }
     $result = array();
     while ($row = mysqli_fetch_assoc($q)) {
         $result[] = $row;
      }
      return $result;
}

//Check if the array authors has the right ids
function isAuthorIdExist($db, $ids){
    if (!is_array($ids)) {
        return false;
    }
    $q = mysqli_query($db, 'SELECT * FROM authors WHERE 
        author_id IN ('.implode(',', $ids).')');
            
    if (checkDBForError($db)) {
        return false;
    }
    //echo mysqli_num_rows($q);
    if (mysqli_num_rows($q) == count($ids)) {
        return true;
    }
    return false; 
}

