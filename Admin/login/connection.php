<?php 

    $username = $_POST['username'];
    $password = $_POST['password'];

     $connection = new mysqli('localhost', 'root', '', 'user_database');
     if($connection->connect_error){
        die('Database connection error:' . $connection->connect_error);
     }else{
        $insert_data = $connection->prepare('INSERT INTO admin_table(username, password)');
        $insert_data ->bind_param('ss', $username, $password);
        $insert_data ->execute();

        if($insert_data > 0){
            echo "login successfully";
        }else{
            echo "login failed";
        }
     }