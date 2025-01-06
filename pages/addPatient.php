<?php

session_start();
include "../helpers/connections.php";
include "../helpers/functions.php";
$user_data = check_login($con);

$user_id = $_SESSION['user_id'];
// Get doctors for current user
$doctors_query = mysqli_query($con, "SELECT * FROM doctors WHERE user_id = '$user_id'");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $doctor_id = $_POST['doctor_id'];
    $patientName = $_POST['patientName'];
    $disease = $_POST['disease'];
    
    if(!empty($doctor_id) && !empty($patientName) && !empty($disease)){
        $query = "INSERT INTO patients (id_doctors, name, disease) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "iss", $doctor_id, $patientName, $disease);
        
        if(mysqli_stmt_execute($stmt)){
            header("Location: patients.php");
            die;
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
                var doctor = document.getElementById("doctor_id").value;
                var patientName = document.getElementById("patientName").value;
                var disease = document.getElementById("disease").value;
                
                if (doctor == "" || patientName == "" || disease == "") {
                    return false;
                }
                return true;
            }
        </script>
    </head>
    <body>
        <div id="pRow" class="row">
            <form class="login-form" method="post" onsubmit="return validateForm()">
                <select class="input" id="doctor_id" name="doctor_id">
                    <option value="">Select Doctor</option>
                    <?php while($doctor = mysqli_fetch_assoc($doctors_query)): ?>
                        <option value="<?php echo $doctor['id']; ?>">
                            <?php echo htmlspecialchars($doctor['name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <input class="input" id="patientName" type="text" placeholder="Enter patient's name" name="patientName"/>
                <input class="input" id="disease" type="text" placeholder="Enter patient's disease" name="disease"/>
                <button id="btnSubmit">Submit</button>              
            </form>
        </div>
    </body>
</html>