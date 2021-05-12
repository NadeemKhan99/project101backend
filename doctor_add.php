<?php

include 'connection.php';



$user_id = "doc_7";
$experience = 2;
$fees = 5000;
$speciality = "Fever,asthama,heart";
$qualification = "matric,fsc,mbbs";
$clinic = "AqeelChand";
$hospital_name = "abc";

            //  inserting data
    $insert_query = "INSERT INTO doctor(user_id,experience,fees,speciality,qualification,clinic)VALUES('$user_id','$experience','$fees','$speciality','$qualification','$clinic')";
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