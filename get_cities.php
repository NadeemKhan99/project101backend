<?php

include 'connection.php';



$obj = json_decode(file_get_contents('php://input'));  

$cities = array();
$counter = 0;



$query = "SELECT * FROM cities";




$result=mysqli_query($check_conn,$query);
$num=mysqli_num_rows($result);

if($num)
{
    while($row1 = mysqli_fetch_assoc($result))
    {
                    array_push($cities,$row1['city']);
                    $counter = $counter + 1 ;               
    }
         

    $retObj=(object)["signal"=>1,"counter"=>$counter,"cities"=>$cities];
    echo json_encode($retObj);
}

else{
    $message = "Something went wrong!";
    $retObj=(object)["signal"=>2,"message"=>$message];
    echo json_encode($retObj);
}


    
        
?>