<?php

include 'connection.php';



$obj = json_decode(file_get_contents('php://input'));  

$id = $obj->id;   // user_id
// $id = "user_1";   // user_id

//  for doctors appointment

$date = array();
$slot = array();
$name = array();
$email = array();
$phone = array();
$address = array();
$city = array();
$patients = array();
$doctor_id = array();
$experience = array();
$fee = array();
$speciality = array();
$qualification = array();
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
$experience1 = array();
$fee1 = array();
$speciality1 = array();
$qualification1 = array();
$hospital = array();
$appointment_id1 = array();
$appointment_status1 = array();
$counter1 = 0;
$status_appoint = 'active';


$query = "SELECT * FROM appointment WHERE user_id='$id' AND status='$status_appoint' ORDER BY date ASC";

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
            array_push($doctor_id1,$row['doctor_id']);
            array_push($appointment_id1,$row['id']);
            array_push($appointment_status1,$row['status']);
            $my_doctor = $row['doctor_id'];


            $query1 = "SELECT * FROM all_user INNER JOIN doctor ON all_user.user_id=doctor.user_id AND doctor.user_id='$my_doctor'";

            $result1=mysqli_query($check_conn,$query1);
            if($result1)
            {
    
    
    
                    $row1 = $result1->fetch_assoc();
                
                    array_push($name1,$row1['name']);
                    array_push($email1,$row1['email']);
                    array_push($phone1,$row1['phone']);
                    array_push($city1,$row1['city']);
                    array_push($experience1,$row1['experience']);
                    array_push($fee1,$row1['fees']);
                    array_push($speciality1,$row1['speciality']);
                    array_push($qualification1,$row1['qualification']);                
                
            }

            // getting hospital name address

            $ids = $row["hospital_id"];
            $query2 = "SELECT * FROM all_user INNER JOIN hospital ON all_user.user_id=hospital.user_id AND hospital.user_id='$ids'";
            $result2 = mysqli_query($check_conn,$query2);
            if($result2)
            {
                $row2=$result2->fetch_assoc();

                array_push($hospital,$row2["hospital_name"]);
                array_push($address1,$row2["address"]);
            }
            $counter1 = $counter1 + 1;
            
        }
        else if($row['doctor_id'])
        {
            array_push($date,$row['date']);
            array_push($slot,$row['slot']);
            array_push($patients,$row['patients']);
            array_push($doctor_id,$row['doctor_id']);
            array_push($appointment_id,$row['id']);
            array_push($appointment_status,$row['status']);
            $my_doctor = $row['doctor_id'];

            $query3 = "SELECT * FROM all_user INNER JOIN doctor ON all_user.user_id=doctor.user_id AND doctor.user_id='$my_doctor'";

            $result4=mysqli_query($check_conn,$query3);
            if($result4)
            {
    
    
    
                    $row1 = $result4->fetch_assoc();
                
                    array_push($name,$row1['name']);
                    array_push($email,$row1['email']);
                    array_push($phone,$row1['phone']);
                    array_push($city,$row1['city']);
                    array_push($experience,$row1['experience']);
                    array_push($fee,$row1['fees']);
                    array_push($speciality,$row1['speciality']);
                    array_push($qualification,$row1['qualification']);  
                    array_push($address,$row1['address']);
                    array_push($clinic,$row1['clinic']);                
                
            }

            $counter = $counter + 1;


        }
        
        
    }


    $retObj=(object)["signal"=>1,"counter"=>$counter,"name"=>$name,"email"=>$email,"city"=>$city,"phone"=>$phone,"date"=>$date,"slot"=>$slot,"patients"=>$patients,"doctor_id"=>$doctor_id,"experience"=>$experience,"fees"=>$fee,"qualification"=>$qualification,"speciality"=>$speciality,"clinic"=>$clinic,"appointment_id"=>$appointment_id,"status"=>$appointment_status,"address"=>$address,"counter1"=>$counter1,"name1"=>$name1,"email1"=>$email1,"city1"=>$city1,"phone1"=>$phone1,"date1"=>$date1,"slot1"=>$slot1,"patients1"=>$patients1,"doctor_id1"=>$doctor_id1,"experience1"=>$experience1,"fees1"=>$fee1,"qualification1"=>$qualification1,"speciality1"=>$speciality1,"hospital"=>$hospital,"appointment_id1"=>$appointment_id1,"status1"=>$appointment_status1,"address1"=>$address1];
    echo json_encode($retObj);
}

else{
    $retObj=(object)["signal"=>2];
    echo json_encode($retObj);
}


    
        
?>