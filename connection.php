<?php 

    //-------------------------database data
    $server_name = "localhost";
    $user_name = "root";
    $password = "";
    
    //----------------connection string

    $check_conn = mysqli_connect($server_name,$user_name,$password);
    if($check_conn)
    {
        $database_name = "docforyou";
        $conn = mysqli_select_db($check_conn,$database_name);
        if(!$conn)
        {
            die("Unable to connect to Mysql".mysqli_error());
        }
    
    }
    else
        die("Unable to connect to Mysql".mysqli_error());


?>