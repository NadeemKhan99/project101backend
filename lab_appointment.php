<?php

include 'connection.php';



$obj = json_decode(file_get_contents('php://input'));  

$date = $obj->date;

$slot = $obj->time;

$doctor_id = $obj->lab_id;

$user_id = $obj->user_id;

$patients = $obj->patients;

$service = $obj->service;

$fee = $obj->fee;

$active = "active";

if(!empty($user_id))
{

    $query = "SELECT * FROM appointment WHERE date='$date' and slot='$slot' and status='$active' and lab_id='$doctor_id'";

    $result=mysqli_query($check_conn,$query);
    $num=mysqli_num_rows($result);

    if($num)
    {
        $message = "This slot is already booked!";
        $retObj=(object)["id"=>$message,"signal"=>2];
        echo json_encode($retObj);
    }
    else
    {

       
        $insert_query = "INSERT INTO appointment(user_id,date,slot,lab_id,patients,status,services,lab_fee)VALUES('$user_id','$date','$slot','$doctor_id','$patients','$active','$service','$fee')";
       


        $insert_query_run = mysqli_query($check_conn,$insert_query);
        if($insert_query_run)
        {
            // mysqli_close($check_conn);
            $message="Appointment made successfully!";
            $retObj=(object)["signal"=>1,"id"=>$message];
            echo json_encode($retObj);
        }
        else{
            $message="Unsuccessfull, plz try again later!";
            $retObj=(object)["signal"=>2,"id"=>$message];
            echo json_encode($retObj);
        }
    }
}
    
    




    
        
?>