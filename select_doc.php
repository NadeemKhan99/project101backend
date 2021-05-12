<?php

include 'connection.php';

$id = "doctor_7";


$query = "SELECT * FROM (((all_user INNER JOIN doctor ON all_user.user_id=doctor.user_id) INNER JOIN timing ON all_user.user_id=timing.user_id) INNER JOIN appointment ON doctor.user_id=appointment.doctor_id)";

$result=mysqli_query($check_conn,$query);

if($result)
{
    while($row = mysqli_fetch_assoc($result))
    {
        echo $row["fname"]."\n";
        echo $row["lname"]."\n";
        echo $row["category_id"]."\n";
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
        echo $row["slot"]."\n";
        echo "<br>";
    }
}





// getting appointments of particular doctor------------


// $query = "SELECT * FROM appointments WHERE doctor_id='".$id."'";

// $result=mysqli_query($check_conn,$query);

// if($result)
// {
//     while($row = mysqli_fetch_assoc($result))
//     {
//         echo $row["user_id"]."\n";
//         echo $row["date"]."\n";
//         echo $row["slot"]."\n";
//         echo "<br>";
//     }
// }



?>