<?php

include 'connection.php';


$obj = json_decode(file_get_contents('php://input'));   
$hospital_id = $obj->id;

$name = array();
$email = array();
$doctor_id = array();
$cities = array();
$address = array();
$phone = array();
// $hospital_name = "";
$experience = array();
$fees = array();
$special = array();
$day = array();
$start = array();
$end = array();
$counter = 0;


//  getting id's od all doctors from hospital


$query_doc = "SELECT * FROM hospital_doc WHERE hospital_id = '$hospital_id'";
$result_doc=mysqli_query($check_conn,$query_doc);

if($result_doc)
{
    while($row1 = mysqli_fetch_assoc($result_doc))
    {
        array_push($doctor_id,$row1["doctor_id"]);
        array_push($start,$row1["start"]);
        array_push($end,$row1["end"]);
        
        
    }



    //  getting all doctors data-----------


    $query = "SELECT * FROM ((all_user INNER JOIN hospital_doc ON all_user.user_id=hospital_doc.doctor_id AND hospital_doc.doctor_id IN (SELECT doctor_id from hospital_doc where hospital_id='$hospital_id') AND hospital_doc.hospital_id='$hospital_id') INNER JOIN doctor ON all_user.user_id=doctor.user_id)";
    $result=mysqli_query($check_conn,$query);

    if($result)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            array_push($name,$row["name"]);
            // array_push($doctor_id,$row["user_id"]);
            array_push($email,$row["email"]);
            array_push($cities,$row["city"]);
            array_push($phone,$row["phone"]);
            array_push($address,$row["address"]);
            // array_push($clinic,$row["clinic"]);
            array_push($experience,$row["experience"]);
            array_push($fees,$row["fees"]);
            array_push($special,$row["speciality"]);
            // array_push($day,$row["day"]);
            // array_push($start,$row["start"]);
            // array_push($end,$row["end"]);
            $counter = $counter + 1;
        }

        $retObj=(object)["signal"=>1,"counter"=>$counter,"name"=>$name,"email"=>$email,"city"=>$cities,"phone"=>$phone,"address"=>$address,"experience"=>$experience,"fees"=>$fees,"speciality"=>$special,"day"=>$day,"start"=>$start,"end"=>$end,"doctor_id"=>$doctor_id];
        echo json_encode($retObj);

    }

    







}



// end


// $query = "SELECT * FROM ((all_user INNER JOIN doctor ON all_user.user_id=doctor.user_id AND all_user.city='$city' AND doctor.speciality='$speciality') INNER JOIN timing ON all_user.user_id=timing.user_id)";

// $result=mysqli_query($check_conn,$query);

// if($result)
// {
//     while($row = mysqli_fetch_assoc($result))
//     {
//         array_push($name,$row["name"]);
//         array_push($doctor_id,$row["user_id"]);
//         array_push($email,$row["email"]);
//         array_push($cities,$row["city"]);
//         array_push($phone,$row["phone"]);
//         array_push($address,$row["address"]);
//         array_push($clinic,$row["clinic"]);
//         array_push($experience,$row["experience"]);
//         array_push($fees,$row["fees"]);
//         array_push($special,$row["speciality"]);
//         array_push($day,$row["day"]);
//         array_push($start,$row["start"]);
//         array_push($end,$row["end"]);
//         $counter = $counter + 1;
//     }

//     $retObj=(object)["signal"=>1,"counter"=>$counter,"name"=>$name,"email"=>$email,"city"=>$cities,"phone"=>$phone,"address"=>$address,"clinic"=>$clinic,"experience"=>$experience,"fees"=>$fees,"speciality"=>$special,"day"=>$day,"start"=>$start,"end"=>$end,"doctor_id"=>$doctor_id];
//     echo json_encode($retObj);

// }


// else
// {

//     //  count number of rows for unique category id----------

    
//     $message="Connection Problem, Try again later!";
//     $retObj=(object)["signal"=>2,"id"=>$message];
//     echo json_encode($retObj);
      

    

// }




// // Check if user is exit already or not-------------

// // $query = "SELECT * FROM all_user WHERE email='$email'";

// // $result=mysqli_query($check_conn,$query);
// // $num=mysqli_num_rows($result);

// // if($num)
// // {
// //     $row=$result->fetch_assoc();
// //     if($row['password']==$password)
// //     {
// //         $message = "Login Successfully!";
// //         $fname = $row['fname'];
// //         $lname = $row['lname'];
// //         $city = $row['city'];
// //         $address = $row['address'];
// //         $phone = $row['phone'];
// //         $retObj=(object)["signal"=>1,"id"=>$message,"fname"=>$fname,"lname"=>$lname,"city"=>$city,"address"=>$address,"phone"=>$phone,"email"=>$email,"password"=>$password];
// //         echo json_encode($retObj);
// //     }
// //     else{
// //         $message="Invalid password or email!";
// //         $retObj=(object)["signal"=>2,"id"=>$message];
// //         echo json_encode($retObj);
// //     }
    
// // }
// // else
// // {

// //     //  count number of rows for unique category id----------

    
// //     $message="Email not found. Plz sign up!";
// //     $retObj=(object)["signal"=>2,"id"=>$message];
// //     echo json_encode($retObj);
      

    

// // }


?>