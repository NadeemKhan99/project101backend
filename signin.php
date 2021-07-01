<?php

include 'connection.php';


$obj = json_decode(file_get_contents('php://input'));   
$email = $obj->email;
$password = $obj->password;
// $email = "khadija.malik@gmail.com";
// $password = "123456";
$status = "active";

// Check if user is exit already or not-------------

$query = "SELECT * FROM all_user WHERE email='$email' AND user_id LIKE 'doctor_%' AND status='$status'";

$result=mysqli_query($check_conn,$query);
$num=mysqli_num_rows($result);


$hospital_id = array();
$names_hospital = array();

$start = array();
$end = array();


if($num)
{
    $row=$result->fetch_assoc();
    if($row['password']==$password)
    {


        $doctor_id = $row['user_id'];

        // check for doctor clinic-----------------


        $check_query = "SELECT * from doctor where user_id = '$doctor_id'";
        $check_query_run=mysqli_query($check_conn,$check_query);

        if($check_query_run)
        {
            $row_check = $check_query_run->fetch_assoc();
            if($row_check["clinic"] == "nothing")
            {


                            $experience =  $row_check["experience"];
                            $fees = $row_check["fees"];
                            $speciality = $row_check["speciality"];
                            $qualification = $row_check["qualification"];
                            $clinic = $row_check["clinic"];







            }
            //   getting  clinic's data---------------
            else{


                    $query_doctor_data = "SELECT * FROM (doctor INNER JOIN timing ON doctor.user_id=timing.user_id AND doctor.user_id='$doctor_id')";

                    $result_doctor=mysqli_query($check_conn,$query_doctor_data);
                    
                    if($result_doctor)
                    {
                        while($row1 = mysqli_fetch_assoc($result_doctor))
                        {
            
                            
                            $experience =  $row1["experience"];
                            $fees = $row1["fees"];
                            $speciality = $row1["speciality"];
                            $qualification = $row1["qualification"];
                            $clinic = $row1["clinic"];
                            $row1["start"];
                            array_push($start,$row1['start']);
                            array_push($end,$row1["end"]);
                        }
                    }


                    //  getting doctor reegister data

                    




            }

        }


        //   getting doctors of hospital---------------data[---------]


        $query_hospital = "SELECT * from hospital_doc where doctor_id='$doctor_id'";
        $query_hospital_run = mysqli_query($check_conn,$query_hospital);
        $number_of_hospitals = mysqli_num_rows($query_hospital_run);
        
        if($number_of_hospitals)
        {

            while($row2 = mysqli_fetch_assoc($query_hospital_run))
            {

                array_push($hospital_id,$row2['hospital_id']);
                array_push($start,$row2['start']);
                array_push($end,$row2["end"]);




            }

            $get_hospital_name_query = "SELECT hospital_name from hospital where user_id in (Select hospital_id from hospital_doc where doctor_id='$doctor_id')";
            $query_run = mysqli_query($check_conn,$get_hospital_name_query);

            while($row3 = mysqli_fetch_assoc($query_run))
            {


                array_push($names_hospital,$row3["hospital_name"]);




            }



        }


        $message = "Login Successfully!";
                    
            $name = $row['name'];
            $city = $row['city'];
            $address = $row['address'];
            $phone = $row['phone'];
            $counter = sizeof($start);
            $retObj=(object)["signal"=>1,"id"=>$message,"counter"=>$counter,"name"=>$name,"user_id"=>$doctor_id,"city"=>$city,"address"=>$address,"phone"=>$phone,"email"=>$email,"password"=>$password,"experience"=>$experience,"fees"=>$fees,"qualification"=>$qualification,"speciality"=>$speciality,"clinic"=>$clinic,"start"=>$start,"end"=>$end,"hospital_ids"=>$hospital_id,"hospital_name"=>$names_hospital];
            echo json_encode($retObj);







       





        
    }
    else{
        $message="Invalid password or email!";
        $retObj=(object)["signal"=>2,"id"=>$message];
        echo json_encode($retObj);
    }
    
}
else
{

    //  count number of rows for unique category id----------

    
    $message="Email not found. Plz sign up as a doctor!";
    $retObj=(object)["signal"=>2,"id"=>$message];
    echo json_encode($retObj);
      

    

}


?>