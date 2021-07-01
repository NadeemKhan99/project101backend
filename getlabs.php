<?php

include 'connection.php';


$obj = json_decode(file_get_contents('php://input'));   
$city = $obj->city;

// $city = "gujranwala";



$name = array();
$email = array();
$doctor_id = array();
$cities = array();
$address = array();
$phone = array();
$clinic = array();
$experience = array();
$fees = array();
$special = array();
$start = array();
$end = array();
$counter = 0;
$fee = array();
$active = "active";







//   get doctors with clinic----------------------------

$query = "SELECT * FROM ((all_user INNER JOIN lab ON all_user.user_id=lab.user_id AND all_user.city='$city' AND all_user.status='$active') INNER JOIN timing ON all_user.user_id=timing.user_id)";

$result=mysqli_query($check_conn,$query);

if($result)
{
    while($row = mysqli_fetch_assoc($result))
    {
        array_push($name,$row["name"]);
        array_push($doctor_id,$row["user_id"]);
        array_push($email,$row["email"]);
        array_push($cities,$row["city"]);
        array_push($phone,$row["phone"]);
        array_push($address,$row["address"]);
        array_push($special,$row["services"]);
        array_push($start,$row["start"]);
        array_push($end,$row["end"]);
        array_push($fee,$row["fee"]);
        $counter = $counter + 1;
    }

    $retObj=(object)["signal"=>1,"counter"=>$counter,"name"=>$name,"email"=>$email,"city"=>$cities,"phone"=>$phone,"address"=>$address,"speciality"=>$special,"start"=>$start,"end"=>$end,"lab_id"=>$doctor_id,"fee"=>$fee];
    echo json_encode($retObj);
}


else
{

    //  count number of rows for unique category id----------

    
    $message="Connection Problem, Try again later!";
    $retObj=(object)["signal"=>2,"id"=>$message];
    echo json_encode($retObj);
      

    

}



















?>