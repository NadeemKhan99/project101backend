<?php

include 'connection.php';



$obj = json_decode(file_get_contents('php://input'));  

$doctor = $obj->doctor_id;

$start = $obj->start;

$end = $obj->end;


   
if(!empty($doctor))
{


    $query = "UPDATE timing SET start='$start', end= '$end' WHERE user_id='$doctor'";

    $result=mysqli_query($check_conn,$query);

    if($result)
    {

        


        $message = "Updated Succesfully! To see changes, plz login again";
        $retObj=(object)["id"=>$message,"signal"=>1];
        echo json_encode($retObj);
    }
    else
    {

       
            $message="Unsuccessfull, plz try again later!";
            $retObj=(object)["signal"=>2,"id"=>$message];
            echo json_encode($retObj);
        

    }

}
else{
    $message="Unsuccessfull, plz try again later!";
    $retObj=(object)["signal"=>2,"id"=>$message];
    echo json_encode($retObj);
}


    
    




    
        
?>