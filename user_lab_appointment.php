<?php

include 'connection.php';



$obj = json_decode(file_get_contents('php://input'));  

$id = $obj->id;   // user_id
// $id = "user_1";   // user_id


$date = array();
$slot = array();
$name = array();
$email = array();
$phone = array();
$address = array();
$city = array();
$patients = array();
$lab_id = array();
$speciality = array();
$appointment_id = array();
$appointment_status = array();
$counter = 0;



$query = "SELECT * FROM appointment WHERE user_id='$id' AND lab_id LIKE 'lab_%' ORDER BY date ASC";

$result=mysqli_query($check_conn,$query);
$num=mysqli_num_rows($result);

if($num)
{



    while($row = mysqli_fetch_assoc($result))
    {
        
        

            array_push($date,$row['date']);
            array_push($slot,$row['slot']);
            array_push($patients,$row['patients']);
            array_push($lab_id,$row['lab_id']);
            array_push($appointment_id,$row['id']);
            array_push($appointment_status,$row['status']);
            $my_lab = $row['lab_id'];


            $query1 = "SELECT * FROM all_user INNER JOIN lab ON all_user.user_id=lab.user_id AND lab.user_id='$my_lab'";

            $result1=mysqli_query($check_conn,$query1);
            if($result1)
            {
    
    
    
                    $row1 = $result1->fetch_assoc();
                
                    array_push($name,$row1['name']);
                    array_push($email,$row1['email']);
                    array_push($phone,$row1['phone']);
                    array_push($city,$row1['city']);
                    array_push($address,$row1['address']);
                    array_push($speciality,$row1['services']);              
                
            }

       $counter = $counter + 1;
        
        
    }


    $retObj=(object)["signal"=>1,"counter"=>$counter,"name"=>$name,"email"=>$email,"city"=>$city,"phone"=>$phone,"date"=>$date,"slot"=>$slot,"patients"=>$patients,"speciality"=>$speciality,"appointment_id"=>$appointment_id,"status"=>$appointment_status,"address"=>$address];
    echo json_encode($retObj);
}

else{
    $retObj=(object)["signal"=>2];
    echo json_encode($retObj);
}


    
        
?>