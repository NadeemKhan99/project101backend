<?php

include 'connection.php';



$obj = json_decode(file_get_contents('php://input'));  

$id = $obj->id;   // user_id
// $id = "lab_19";   // user_id


$date = array();
$slot = array();
$name = array();
$email = array();
$phone = array();
$address = array();
$city = array();
$patients = array();
$lab_id = array();
$appointment_id = array();
$appointment_status = array();
$counter = 0;



$query = "SELECT * FROM appointment WHERE lab_id='$id' ORDER BY date ASC";

$result=mysqli_query($check_conn,$query);
$num=mysqli_num_rows($result);

if($num)
{



    while($row = mysqli_fetch_assoc($result))
    {
        
        

            array_push($date,$row['date']);
            array_push($slot,$row['slot']);
            array_push($patients,$row['patients']);
            array_push($lab_id,$row['user_id']);
            array_push($appointment_id,$row['id']);
            array_push($appointment_status,$row['status']);
            $my_user = $row['user_id'];


            $query1 = "SELECT * FROM all_user WHERE all_user.user_id='$my_user'";

            $result1=mysqli_query($check_conn,$query1);
            if($result1)
            {
    
    
    
                    $row1 = $result1->fetch_assoc();
                
                    array_push($name,$row1['name']);
                    array_push($email,$row1['email']);
                    array_push($phone,$row1['phone']);
                    array_push($city,$row1['city']);
                    array_push($address,$row1['address']);          
                
            }

       $counter = $counter + 1;
        
        
    }


    $retObj=(object)["signal"=>1,"counter"=>$counter,"name"=>$name,"email"=>$email,"city"=>$city,"phone"=>$phone,"date"=>$date,"slot"=>$slot,"patients"=>$patients,"appointment_id"=>$appointment_id,"status"=>$appointment_status,"address"=>$address];
    echo json_encode($retObj);
}

else{
    $retObj=(object)["signal"=>2];
    echo json_encode($retObj);
}


    
        
?>