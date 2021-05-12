<?php

include 'connection.php';



$obj = json_decode(file_get_contents('php://input'));  

$id = $obj->id;   // user_idn


$date = array();
$slot = array();
$name = array();
$email = array();
$phone = array();

$patients = array();
$doctor_id = array();
$user_id = array();

$appointment_id = array();
$appointment_status = array();
$counter = 0;


$name1 = array();
$email1 = array();
$phone1 = array();
$address1 = array();
$city1 = array();



$query = "SELECT * FROM appointment WHERE hospital_id='$id' ORDER BY date ASC";

$result=mysqli_query($check_conn,$query);
$num=mysqli_num_rows($result);

if($num)
{



    while($row = mysqli_fetch_assoc($result))
    {
        
        
            array_push($date,$row['date']);
            array_push($slot,$row['slot']);
            array_push($patients,$row['patients']);
            array_push($doctor_id,$row['doctor_id']);
            array_push($user_id,$row['user_id']);
            array_push($appointment_id,$row['id']);
            array_push($appointment_status,$row['status']);
            $my_doctor = $row['doctor_id'];


            $query1 = "SELECT * FROM all_user INNER JOIN doctor ON all_user.user_id=doctor.user_id AND doctor.user_id='$my_doctor'";

            $result1=mysqli_query($check_conn,$query1);
            if($result1)
            {
    
    
    
                    $row1 = $result1->fetch_assoc();
                
                    array_push($name,$row1['name']);
                    array_push($email,$row1['email']);
                    array_push($phone,$row1['phone']);             
                
            }

            // getting hospital name address

            $ids = $row["user_id"];
            $query2 = "SELECT * FROM all_user WHERE all_user.user_id='$ids'";
            $result2 = mysqli_query($check_conn,$query2);
            if($result2)
            {
                $row2=$result2->fetch_assoc();

                array_push($name1,$row2["name"]);
                array_push($email1,$row2["email"]);
                array_push($city1,$row2["city"]);
                array_push($phone1,$row2["phone"]);
                array_push($address1,$row2["address"]);
            }
            $counter = $counter + 1;
            
        
        
    }


    $retObj=(object)["signal"=>1,"counter"=>$counter,"name"=>$name,"email"=>$email,"phone"=>$phone,"date"=>$date,"slot"=>$slot,"patients"=>$patients,"doctor_id"=>$doctor_id,"user_id"=>$user_id,"appointment_id"=>$appointment_id,"status"=>$appointment_status,"name1"=>$name1,"email1"=>$email1,"city1"=>$city1,"phone1"=>$phone1,"address1"=>$address1];
    echo json_encode($retObj);
}

else{
    $retObj=(object)["signal"=>2];
    echo json_encode($retObj);
}


    
        
?>