<?php 
    $connection = new mysqli('localhost', 'root', '', 'user_database');
    if(!$connection){
        die('Database Connection Error:' .$connection->connect_error);
    }
    