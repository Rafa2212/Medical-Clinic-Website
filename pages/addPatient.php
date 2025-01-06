<?php

session_start();
include "../helpers/connections.php";
include "../helpers/functions.php";
$user_data = check_login($con);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $doctorName = $_POST['doctorName'];
    $patientName = $_POST['patientName'];
    $disease = $_POST['disease'];
    
    if(!empty($doctorName) && !empty($patientName) && !empty($disease)){
        $doctor_query = mysqli_query($con,"SELECT * FROM doctors WHERE name = '$doctorName' limit 1");
        $doctor_id = null;
        if($doctor_query && mysqli_num_rows($doctor_query) > 0){
            $doctor = mysqli_fetch_assoc($doctor_query);
            $doctor_id = $doctor['id'];
            
            $query = "INSERT INTO patients (id_doctors, name, disease) VALUES ('$doctor_id', '$patientName', '$disease')";
            mysqli_query($con, $query);
            header("Location: patients.php");
            die;
        } else {
            echo "<dialog id='dialog'>
                <form method='dialog'>
                Doctor not found!
                <button id='btnClose'>Close</button>
                </form>
                </dialog>";
        }
    } else {
        echo "<dialog id='dialog'>
            <form method='dialog'>
            Please fill in all fields!
            <button id='btnClose'>Close</button>
            </form>
            </dialog>";
    }
}
?>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=0.8">
        <title>Add Patient</title>
        <link href="../assets/style/login.css" rel="stylesheet" />
        <script>
            function onClick(event) {
                if (event.target === dialog) {
                    dialog.close();
                }
            }
            
            window.onload = function() {
                const dialog = document.querySelector("dialog");
                if(dialog) {
                    dialog.addEventListener("click", onClick);
                    dialog.showModal();
                }
            }

            function validateForm() {
                var doctorName = document.getElementById("doctorName").value;
                var patientName = document.getElementById("patientName").value;
                var disease = document.getElementById("disease").value;
                
                if (doctorName == "" || patientName == "" || disease == "") {
                    return false;
                }
                return true;
            }
        </script>
    </head>
    <body>
        <div id="pRow" class="row">
            <form class="login-form" method="post" onsubmit="return validateForm()">
                <input class="input" id="doctorName" type="text" placeholder="Enter doctor's full name" name="doctorName"/>
                <input class="input" id="patientName" type="text" placeholder="Enter patient's name" name="patientName"/>
                <input class="input" id="disease" type="text" placeholder="Enter patient's disease" name="disease"/>
                <button id="btnSubmit">Submit</button>              
            </form>
        </div>
    </body>
</html>