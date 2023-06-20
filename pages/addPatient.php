<?php

session_start();
include "../helpers/connections.php";
include "../helpers/functions.php";
$user_data = check_login($con);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $doctorName = $_POST['doctorName'];
    $doctor_query = mysqli_query($con,"SELECT * FROM doctors WHERE name = '$doctorName' limit 1");
    $doctor_id = null;
    if($doctor_query && mysqli_num_rows($doctor_query) > 0){
        $doctor = mysqli_fetch_assoc($doctor_query);
        $doctor_id = $doctor['id'];
    }
    $patientName = $_POST['patientName'];
    $disease = $_POST['disease'];
    if(!empty($doctorName) && !empty($patientName) && !empty($disease)){
        $query = "INSERT INTO patients (id_doctors, name, disease) VALUES ('$doctor_id', '$patientName', '$disease')";
        mysqli_query($con, $query);
        header("Location: patients.php");
        die;
    }
}
?>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=0.8">
        <title>Add Patient</title>
        <link href="../assets/style/login.css" rel="stylesheet" />
    </head>
    <body>
    <div id="pRow" class="row">
                    <form class="login-form" method="post">
                        <input class="input" id="doctorName" type="text" placeholder="Enter doctor's full name" name="doctorName"/>
                        <input class="input" id="patientName" type="text" placeholder="Enter patient's name" name="patientName"/>
                        <input class="input" id="disease" type="text" placeholder="Enter patient's disease" name="disease"/>
                        <button id="btnSubmit">Submit</button>              
                    </form>
    </body>
</html>