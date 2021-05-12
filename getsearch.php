<?php

include 'connection.php';


$obj = json_decode(file_get_contents('php://input'));   
$city = $obj->city;
$speciality = $obj->speciality;

// $city = "Gujranwala";
// $speciality ="child";


//  for doctors with clinic

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
$day = array();
$start = array();
$end = array();
$counter = 0;
$nothing = "nothing";

//  for doctors with no clinic

$name1 = array();
$email1 = array();
$doctor_id1 = array();
$hospital_id1 = array();
$hospital_id1_name = array();
$cities1 = array();
$address1 = array();
$phone1 = array();
$experience1 = array();
$fees1 = array();
$special1 = array();
$start1 = array();
$end1 = array();
$counter1 = 0;

//  clinic doctors with hospital--------


$name2 = array();
$email2 = array();
$doctor_id2 = array();
$hospital_id2 = array();
$hospital_id2_name = array();
$cities2 = array();
$address2 = array();
$phone2 = array();
$experience2 = array();
$fees2 = array();
$special2 = array();
$start2 = array();
$end2 = array();
$counter2 = 0;






//   get doctors with clinic----------------------------

$query = "SELECT * FROM ((all_user INNER JOIN doctor ON all_user.user_id=doctor.user_id AND all_user.city='$city' AND doctor.speciality='$speciality' AND doctor.clinic != '$nothing') INNER JOIN timing ON all_user.user_id=timing.user_id)";

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
        array_push($clinic,$row["clinic"]);
        array_push($experience,$row["experience"]);
        array_push($fees,$row["fees"]);
        array_push($special,$row["speciality"]);
        array_push($day,$row["day"]);
        array_push($start,$row["start"]);
        array_push($end,$row["end"]);
        $counter = $counter + 1;
    }

    // $retObj=(object)["signal"=>1,"counter"=>$counter,"name"=>$name,"email"=>$email,"city"=>$cities,"phone"=>$phone,"address"=>$address,"clinic"=>$clinic,"experience"=>$experience,"fees"=>$fees,"speciality"=>$special,"day"=>$day,"start"=>$start,"end"=>$end,"doctor_id"=>$doctor_id];


}


else
{

    //  count number of rows for unique category id----------

    
    $message="Connection Problem, Try again later!";
    $retObj=(object)["signal"=>2,"id"=>$message];
    echo json_encode($retObj);
      

    

}


// get doctors without clinic-----------------------

//  getting all doctors data-----------


$query1 = "SELECT * FROM ((all_user INNER JOIN doctor ON all_user.user_id=doctor.user_id AND all_user.city='$city' AND doctor.speciality='$speciality' AND doctor.clinic = '$nothing') INNER JOIN hospital_doc ON all_user.user_id=hospital_doc.doctor_id)";
$result1=mysqli_query($check_conn,$query1);

if($result1)
{
    while($row1 = mysqli_fetch_assoc($result1))
    {
        array_push($name1,$row1["name"]);
        array_push($doctor_id1,$row1["user_id"]);
        array_push($hospital_id1,$row1["hospital_id"]);
        array_push($email1,$row1["email"]);
        array_push($cities1,$row1["city"]);
        array_push($phone1,$row1["phone"]);
        array_push($address1,$row1["address"]);
        array_push($experience1,$row1["experience"]);
        array_push($fees1,$row1["fees"]);
        array_push($special1,$row1["speciality"]);
        array_push($start1,$row1["start"]);
        array_push($end1,$row1["end"]);
        $counter1 = $counter1 + 1;

        //   getting hospital name

        $ids = $row1["hospital_id"];
        $query2 = "Select hospital_name from hospital where user_id = '$ids'";
        $result2 = mysqli_query($check_conn,$query2);
        if($result2)
        {
            $row2=$result2->fetch_assoc();

            array_push($hospital_id1_name,$row2["hospital_name"]);
        }








    }

    // $retObj=(object)["signal"=>1,"counter"=>$counter,"name"=>$name,"email"=>$email,"city"=>$cities,"phone"=>$phone,"address"=>$address,"clinic"=>$clinic,"experience"=>$experience,"fees"=>$fees,"speciality"=>$special,"day"=>$day,"start"=>$start,"end"=>$end,"doctor_id"=>$doctor_id,"counter1"=>$counter1,"name1"=>$name1,"email1"=>$email1,"city1"=>$cities1,"phone1"=>$phone1,"address1"=>$address1,"experience1"=>$experience1,"fees1"=>$fees1,"speciality1"=>$special1,"start1"=>$start1,"end1"=>$end1,"doctor_id1"=>$doctor_id1,"hospital_id1"=>$hospital_id1,"hospital_name1"=>$hospital_id1_name];


}

else
{

    //  count number of rows for unique category id----------

    
    $message="Connection Problem, Try again later!";
    $retObj=(object)["signal"=>2,"id"=>$message];
    echo json_encode($retObj);
      

    

}


$query3 = "SELECT * FROM ((all_user INNER JOIN doctor ON all_user.user_id=doctor.user_id AND all_user.city='$city' AND doctor.speciality='$speciality' AND doctor.clinic != '$nothing') INNER JOIN hospital_doc ON all_user.user_id=hospital_doc.doctor_id)";
$result3=mysqli_query($check_conn,$query3);

if($result3)
{
    while($row3 = mysqli_fetch_assoc($result3))
    {
        array_push($name2,$row3["name"]);
        array_push($doctor_id2,$row3["user_id"]);
        array_push($hospital_id2,$row3["hospital_id"]);
        array_push($email2,$row3["email"]);
        array_push($cities2,$row3["city"]);
        array_push($phone2,$row3["phone"]);
        array_push($address2,$row3["address"]);
        array_push($experience2,$row3["experience"]);
        array_push($fees2,$row3["fees"]);
        array_push($special2,$row3["speciality"]);
        array_push($start2,$row3["start"]);
        array_push($end2,$row3["end"]);
        $counter2 = $counter2 + 1;

        //   getting hospital name

        $ids1 = $row3["hospital_id"];
        $query4 = "Select hospital_name from hospital where user_id = '$ids1'";
        $result4 = mysqli_query($check_conn,$query4);
        if($result4)
        {
            $row5=$result4->fetch_assoc();

            array_push($hospital_id2_name,$row5["hospital_name"]);
        }








    }

    $retObj=(object)["signal"=>1,"counter"=>$counter,"name"=>$name,"email"=>$email,"city"=>$cities,"phone"=>$phone,"address"=>$address,"clinic"=>$clinic,"experience"=>$experience,"fees"=>$fees,"speciality"=>$special,"day"=>$day,"start"=>$start,"end"=>$end,"doctor_id"=>$doctor_id,"counter1"=>$counter1,"name1"=>$name1,"email1"=>$email1,"city1"=>$cities1,"phone1"=>$phone1,"address1"=>$address1,"experience1"=>$experience1,"fees1"=>$fees1,"speciality1"=>$special1,"start1"=>$start1,"end1"=>$end1,"doctor_id1"=>$doctor_id1,"hospital_id1"=>$hospital_id1,"hospital_name1"=>$hospital_id1_name,"counter2"=>$counter2,"name2"=>$name2,"email2"=>$email2,"city2"=>$cities2,"phone2"=>$phone2,"address2"=>$address2,"experience2"=>$experience2,"fees2"=>$fees2,"speciality2"=>$special2,"start2"=>$start2,"end2"=>$end2,"doctor_id2"=>$doctor_id2,"hospital_id2"=>$hospital_id2,"hospital_name2"=>$hospital_id2_name];
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