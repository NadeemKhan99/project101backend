
<?php

include 'connection.php';



$user_id = "lab_8";
$services = "if you have disease, then we have tests..";

            //  inserting data
    $insert_query = "INSERT INTO lab(user_id,services)VALUES('$user_id','$services')";
    $insert_query_run = mysqli_query($check_conn,$insert_query);
    if($insert_query_run)
    {
        // mysqli_close($check_conn);
        $message="Data Added successfully!";
        echo $message;
        // $retObj=(object)["id"=>$message];
        // echo json_encode($retObj);
    }
    
        
?>