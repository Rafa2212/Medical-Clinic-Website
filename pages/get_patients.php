<?php
session_start();
include "../helpers/connections.php";
include "../helpers/functions.php";
$user_data = check_login($con);

if(isset($_GET['doctor_id'])) {
    $doctor_id = $_GET['doctor_id'];
    
    $stmt = mysqli_prepare($con, "SELECT id, name FROM patients WHERE id_doctors = ?");
    mysqli_stmt_bind_param($stmt, "i", $doctor_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $patients = array();
    while($row = mysqli_fetch_assoc($result)) {
        $patients[] = array(
            'id' => $row['id'],
            'name' => $row['name']
        );
    }
    
    header('Content-Type: application/json');
    echo json_encode($patients);
}
?> 