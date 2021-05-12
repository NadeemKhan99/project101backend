<?php

include 'connection.php';



$obj = json_decode(file_get_contents('php://input'));  

$doctor = $obj->doctor_id;

$hospital = $obj->hospital_id;

$start = $obj->start;

$end = $obj->end;


   
if(!empty($hospital))
{


    $query = "SELECT * FROM hospital_doc WHERE hospital_id='$hospital' AND doctor_id = '$doctor'";

    $result=mysqli_query($check_conn,$query);
    $num=mysqli_num_rows($result);

    if($num)
    {

        $query_update = "UPDATE hospital_doc SET start='$start', end='$end' WHERE hospital_id='$hospital' AND doctor_id='$doctor'";
        $running = mysqli_query($check_conn,$query_update);

        if($running)
        {
            $message = "Doctor slots have been updated...";
        $retObj=(object)["id"=>$message,"signal"=>2];
        echo json_encode($retObj);
        }
        else{
            $message = "Try again later...";
            $retObj=(object)["id"=>$message,"signal"=>2];
            echo json_encode($retObj);
        }

        
    }
    else
    {

        $insert_query = "INSERT INTO hospital_doc(hospital_id,doctor_id,start,end)VALUES('$hospital','$doctor','$start','$end')";
        $insert_query_run = mysqli_query($check_conn,$insert_query);
        if($insert_query_run)
        {
            // mysqli_close($check_conn);
            $message="Slots added successfully! Add another doctor";
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
else{
    $message="Unsuccessfull, plz try again later!";
    $retObj=(object)["signal"=>2,"id"=>$message];
    echo json_encode($retObj);
}


    
    




    
        
?>