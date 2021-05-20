<?php

include 'connection.php';


$obj = json_decode(file_get_contents('php://input'));   
$user_id = $obj->id;

$counter = 0;
$active = "active";

$query = "SELECT * FROM appointment WHERE user_id='$user_id' AND lab_id LIKE 'lab_%' AND status = '$active'";

$result=mysqli_query($check_conn,$query);

if($result)
{
    while($row = mysqli_fetch_assoc($result))
    {
        $counter = $counter + 1;
    }

    if($counter >= 2)
    {
        $message = "You have reached maximum 2 appointments!";
        $retObj=(object)["signal"=>1,"message"=>$message];
        echo json_encode($retObj);
    }
    else{
        $retObj=(object)["signal"=>2];
        echo json_encode($retObj);
    }



}


else
{

    //  count number of rows for unique category id----------

    
    $message="Connection Problem, Try again later!";
    $retObj=(object)["signal"=>2,"id"=>$message];
    echo json_encode($retObj);
      

    

}






?>