<?php

include 'connection.php';



$obj = json_decode(file_get_contents('php://input'));  

$id = $obj->id;

$date = array();
$slot = array();
$name = array();
$email = array();
$phone = array();
$address = array();
$city = array();
$patients = array();
$doctor_id = array();
$clinic = array();
$appointment_id = array();
$appointment_status = array();
$counter = 0;

//  forhospitals appintment

$date1 = array();
$slot1 = array();
$name1 = array();
$email1 = array();
$phone1 = array();
$address1 = array();
$city1 = array();
$patients1 = array();
$doctor_id1 = array();
$hospital = array();
$appointment_id1 = array();
$appointment_status1 = array();
$counter1 = 0;

$query = "SELECT * FROM appointment WHERE doctor_id='$id' ORDER BY date ASC";

$result=mysqli_query($check_conn,$query);
$num=mysqli_num_rows($result);

if($num)
{



    



    while($row = mysqli_fetch_assoc($result))
    {
        
        if($row['hospital_id'])
        {

            array_push($date1,$row['date']);
            array_push($slot1,$row['slot']);
            array_push($patients1,$row['patients']);
            array_push($doctor_id1,$row['user_id']);
            array_push($appointment_id1,$row['id']);
            array_push($appointment_status1,$row['status']);
            $my_user = $row['user_id'];


            $query1 = "SELECT * FROM all_user WHERE all_user.user_id='$my_user'";

            $result1=mysqli_query($check_conn,$query1);
            if($result1)
            {
    
    
    
                    $row1 = $result1->fetch_assoc();
                
                    array_push($name1,$row1['name']);
                    array_push($email1,$row1['email']);
                    array_push($phone1,$row1['phone']);
                    array_push($city1,$row1['city']);
                    array_push($address1,$row1['address']);
              
                
            }

            // getting hospital name address

            $ids = $row["hospital_id"];
            $query2 = "SELECT * FROM all_user INNER JOIN hospital ON all_user.user_id=hospital.user_id AND hospital.user_id='$ids'";
            $result2 = mysqli_query($check_conn,$query2);
            if($result2)
            {
                $row2=$result2->fetch_assoc();

                array_push($hospital,$row2["hospital_name"]);
            }
            $counter1 = $counter1 + 1;
            
        }
        else if($row['doctor_id'])
        {
            array_push($date,$row['date']);
            array_push($slot,$row['slot']);
            array_push($patients,$row['patients']);
            array_push($doctor_id,$row['user_id']);
            array_push($appointment_id,$row['id']);
            array_push($appointment_status,$row['status']);
            $my_user = $row['user_id'];

            $query3 = "SELECT * FROM all_user WHERE all_user.user_id = '$my_user'";

            $result3=mysqli_query($check_conn,$query3);
            if($result3)
            {
    
    
    
                    $row3 = $result3->fetch_assoc();
                
                    array_push($name,$row3['name']);
                    array_push($email,$row3['email']);
                    array_push($phone,$row3['phone']);
                    array_push($city,$row3['city']);
                    array_push($address,$row3['address']);
              
                
            }

            $query_doctor = "SELECT * from all_user INNER JOIN doctor ON all_user.user_id = doctor.user_id and all_user.user_id = '$id'";
            $running = mysqli_query($check_conn,$query_doctor);
            if($running)
            {
                $row4 = $running -> fetch_assoc();
                array_push($clinic,$row4['clinic']);
            }

            $counter = $counter + 1;


        }
        
        
    }

    
    


    $retObj=(object)["signal"=>1,"counter"=>$counter,"name"=>$name,"email"=>$email,"city"=>$city,"phone"=>$phone,"date"=>$date,"slot"=>$slot,"patients"=>$patients,"user_id"=>$doctor_id,"clinic"=>$clinic,"appointment_id"=>$appointment_id,"status"=>$appointment_status,"address"=>$address,"counter1"=>$counter1,"name1"=>$name1,"email1"=>$email1,"city1"=>$city1,"phone1"=>$phone1,"date1"=>$date1,"slot1"=>$slot1,"patients1"=>$patients1,"user_id1"=>$doctor_id1,"hospital"=>$hospital,"appointment_id1"=>$appointment_id1,"status1"=>$appointment_status1,"address1"=>$address1];
    echo json_encode($retObj);
}

else{
    $retObj=(object)["signal"=>2];
    echo json_encode($retObj);
}


    
        
?>