<?php

session_start();
include "../helpers/connections.php";
include "../helpers/functions.php";
$user_data = check_login($con);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //TODO: serverside insert if !empty location back to patients
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
    <div class="row">
                    <form class="login-form" method="post">
                        <input id="doctorName" type="text" placeholder="Enter doctor's name" name="doctorName"/>
                        <input id="patientName" type="text" placeholder="Enter patient's name" name="patientName"/>
                        <input id="disease" type="text" placeholder="Enter patient's disease" name="disease"/>
                        <button id="btnSubmit">Submit</button>              
                    </form>
    </body>
</html>