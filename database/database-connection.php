<?php
function databaseConnection(){
    $db_connection = mysqli_connect('localhost', 'shaun', 'root', 'psychopathology');
    if(!$db_connection){
        echo 'database error:' . mysqli_connect_error();
    }else {
        return $db_connection;
    } }
?>