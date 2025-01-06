<?php
session_start();
include "../helpers/connections.php";
include "../helpers/functions.php";
$user_data = check_login($con);

$user_id = $_SESSION['user_id'];
// Get doctors for current user
$doctors_query = mysqli_query($con, "SELECT * FROM doctors WHERE user_id = '$user_id'");
// Get all patients
$patients_query = mysqli_query($con, "SELECT p.*, d.name as doctor_name 
                                    FROM patients p 
                                    JOIN doctors d ON p.id_doctors = d.id 
                                    WHERE d.user_id = '$user_id'");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $doctor_id = $_POST['doctor_id'];
    $patient_id = $_POST['patient_id'];
    $reason = $_POST['reason'];
    $appointment_date = $_POST['appointment_date'];
    
    if(!empty($doctor_id) && !empty($patient_id) && !empty($reason) && !empty($appointment_date)){
        $query = "INSERT INTO appointments (doctor_id, patient_id, reason, appointment_date) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "iiss", $doctor_id, $patient_id, $reason, $appointment_date);
        
        if(mysqli_stmt_execute($stmt)){
            header("Location: main.php");
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
        <title>Add Appointment</title>
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
                var patient = document.getElementById("patient_id").value;
                var reason = document.getElementById("reason").value;
                var date = document.getElementById("appointment_date").value;
                
                if (doctor == "" || patient == "" || reason == "" || date == "") {
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

                <select class="input" id="patient_id" name="patient_id">
                    <option value="">Select Patient</option>
                    <?php while($patient = mysqli_fetch_assoc($patients_query)): ?>
                        <option value="<?php echo $patient['id']; ?>">
                            <?php echo htmlspecialchars($patient['name']) . ' (Dr. ' . htmlspecialchars($patient['doctor_name']) . ')'; ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <input class="input" type="datetime-local" id="appointment_date" name="appointment_date"/>
                <input class="input" id="reason" type="text" placeholder="Enter reason" name="reason"/>
                <button id="btnSubmit">Submit</button>              
            </form>
        </div>
    </body>
</html> 