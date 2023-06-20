<?php
include "connections.php";
function check_login($con)
{
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";
        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    header("Location: signin.php");
    die;
}
function random_num($length)
{
    $text = "";
    if($length < 5)
    {
        $length = 5;
    }
    $len = rand(4,$length);
    for ($i=0; $i < $len; $i++) {
        $text .= rand(0,9);
    }
return $text;
}
function addPatient($con){
    //TODO: add patient to database
    if(isset($_SESSION['patientName']) && isset($_SESSION['doctorName']) && isset($_SESSION['disease']))
    {
        $patient = $_SESSION['patientName'];
        $doctor = $_SESSION['doctorName'];
        $disease = $_SESSION['disease'];
        $sql = "select id from doctors where doctors.name='$doctor' limit 1";
        $doctor_id = mysqli_query($con, $sql);
        $query = "insert into patients (id_doctors,name,disease) values ('$doctor_id','$patient','$disease')";
        $result = mysqli_query($con, $query);
    }
}