<?php

include 'connection.php';



$user_id = "hospital_4";
$no_doctors = "12";
$hospital_name = "mayo, lahore"
$disease_treated = "asthma,skindesease,tonsils";

            //  inserting data
    $insert_query = "INSERT INTO hospital(user_id,no_doctors,hospital_name,disease_treated)VALUES('$user_id','$no_doctors','$hospital_name','$disease_treated')";
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