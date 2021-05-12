<?php

include 'connection.php';



$obj = json_decode(file_get_contents('php://input'));  

$date = $obj->date;

$slot = $obj->time;

$doctor_id = $obj->doctor_id;
$hospital = $obj->hospital_id;
$count = $obj->count;

$user_id = $obj->user_id;

$patients = $obj->patients;

$active = "active";

if(!empty($user_id))
{

    $query = "SELECT * FROM appointment WHERE date='$date' and slot='$slot' and doctor_id='$doctor_id'";

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

        if($count == 0)
        {
            $insert_query = "INSERT INTO appointment(user_id,date,slot,doctor_id,patients,status)VALUES('$user_id','$date','$slot','$doctor_id','$patients','$active')";
        }
        else{
            $insert_query = "INSERT INTO appointment(user_id,date,slot,doctor_id,patients,status,hospital_id)VALUES('$user_id','$date','$slot','$doctor_id','$patients','$active','$hospital')";
        }


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