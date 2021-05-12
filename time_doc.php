<?php

include 'connection.php';



$user_id = "doctor_6";
$day = "monday";
$start = "9:30am-4:00am";
$end = "9:30pm-4:00pm";


            //  inserting data
    $insert_query = "INSERT INTO timing(user_id,day,start,end)VALUES('$user_id','$day','$start','$end')";
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