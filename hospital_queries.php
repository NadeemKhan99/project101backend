<?php

include 'connection.php';


//     get hospital data--------------------

// $query = "SELECT * FROM all_user INNER JOIN hospital ON all_user.user_id=hospital.user_id";

// $result=mysqli_query($check_conn,$query);

// if($result)
// {
//     while($row = mysqli_fetch_assoc($result))
//     {
//         echo $row["fname"]."\n";
//         echo $row["lname"]."\n";
//         echo $row["category_id"]."\n";
//         echo $row["email"]."\n";
//         echo $row["password"]."\n";
//         echo $row["city"]."\n";
//         echo $row["phone"]."\n";
//         echo $row["address"]."\n";
//         echo $row["status"]."\n";
//         echo $row["hospital_name"]."\n";
//         echo $row["no_doctors"]."\n";
//         echo $row["disease_treated"]."\n";
//         echo "<br>";
//     }
// }


//   -----------------------get doctors of a particular hospitals with their appointments--------------------




// $hospital_id = "hospital_3";
// $query = "SELECT user_id FROM doctor where hospital_id='".$hospital_id."'";



// $result=mysqli_query($check_conn,$query);

// if($result)
// {
//     while($row1 = mysqli_fetch_assoc($result))
//     {

//         $doctors=$row1["user_id"];

//         $query1 = "SELECT * FROM (((all_user INNER JOIN doctor ON all_user.user_id=doctor.user_id) INNER JOIN timing ON all_user.user_id=timing.user_id) INNER JOIN appointment ON doctor.user_id=appointment.doctor_id) where doctor.user_id='".$doctors."'";

//         $result1=mysqli_query($check_conn,$query1);
        
//         if($result1)
//         {
//             while($row = mysqli_fetch_assoc($result1))
//             {
//                 echo $row["fname"]."\n";
//                 echo $row["lname"]."\n";
//                 echo $row["category_id"]."\n";
//                 echo $row["email"]."\n";
//                 echo $row["password"]."\n";
//                 echo $row["city"]."\n";
//                 echo $row["phone"]."\n";
//                 echo $row["address"]."\n";
//                 echo $row["status"]."\n";
//                 echo $row["experience"]."\n";
//                 echo $row["fees"]."\n";
//                 echo $row["speciality"]."\n";
//                 echo $row["day"]."\n";
//                 echo $row["start"]."\n";
//                 echo $row["end"]."\n";
//                 echo $row["date"]."\n";
//                 echo $row["slot"]."\n";
//                 echo "<br>";
//             }
//         }



//     }
// }



//------------------------search doctor------------------


$city = "Gujranwala";
$speciality = "child specialist";
$query = "SELECT * FROM ((all_user INNER JOIN doctor ON all_user.user_id=doctor.user_id AND all_user.city='$city' AND doctor.speciality='$speciality') INNER JOIN timing ON all_user.user_id=timing.user_id)";

$result=mysqli_query($check_conn,$query);

if($result)
{
    while($row = mysqli_fetch_assoc($result))
    {
        echo $row["category_id"];
        echo "<br></br>";
        echo $row["email"]."\n";
        echo $row["password"]."\n";
        echo $row["city"]."\n";
        echo $row["phone"]."\n";
        echo $row["address"]."\n";
        echo $row["status"]."\n";
        echo $row["experience"]."\n";
        echo $row["fees"]."\n";
        echo $row["speciality"]."\n";
        echo $row["day"]."\n";
        echo $row["start"]."\n";
        echo $row["end"]."\n";
        echo "<br>";
    }
}






    


        // $doctor_id = $row['user_id'];



        // $query_doctor_data = "SELECT * FROM (doctor INNER JOIN timing ON doctor.user_id=timing.user_id AND doctor.user_id='$doctor_id')";

        // $result_doctor=mysqli_query($check_conn,$query_doctor_data);
        
        // if($result_doctor)
        // {
        //     while($row1 = mysqli_fetch_assoc($result_doctor))
        //     {

                
        //         $experience =  $row1["experience"];
        //         $fees = $row1["fees"];
        //         $speciality = $row1["speciality"];
        //         $qualification = $row1["qualification"];
        //         $clinic = $row1["clinic"];
        //         $day =  $row1["day"];
        //         $start =  $row1["start"];
        //         $end = $row1["end"];
        //     }
        // }





        //  getting doctor reegister data

        // $message = "Login Successfully!";
        
        // $name = $row['name'];
        // $city = $row['city'];
        // $address = $row['address'];
        // $phone = $row['phone'];
        // $retObj=(object)["signal"=>1,"id"=>$message,"name"=>$name,"user_id"=>$doctor_id,"city"=>$city,"address"=>$address,"phone"=>$phone,"email"=>$email,"password"=>$password,"experience"=>$experience,"fees"=>$fees,"qualification"=>$qualification,"speciality"=>$speciality,"clinic"=>$clinic,"day"=>$day,"start"=>$start,"end"=>$end];
        // echo json_encode($retObj);
    
    
    

else
{

    //  count number of rows for unique category id----------

    
    $message="Email not found. Plz sign up as a doctor!";
    $retObj=(object)["signal"=>2,"id"=>$message];
    echo json_encode($retObj);
      

    

}








?>