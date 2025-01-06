<?php
session_start();
include "../helpers/connections.php";
include "../helpers/functions.php";
$user_data = check_login($con);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $doctorName = $_POST['doctorName'];
    $profession = $_POST['profession'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    if(!empty($doctorName) && !empty($profession) && !empty($description)){
        $query = "INSERT INTO doctors (user_id, name, profession, description) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "isss", $user_id, $doctorName, $profession, $description);
        
        if(mysqli_stmt_execute($stmt)){
            header("Location: main.php");
            die;
        }
    }
}
?>

<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=0.8">
        <title>Add Doctor</title>
        <link href="../assets/style/login.css" rel="stylesheet" />
    </head>
    <body>
        <div id="pRow" class="row">
            <form class="login-form" method="post">
                <input class="input" id="doctorName" type="text" placeholder="Enter doctor's full name" name="doctorName"/>
                <input class="input" id="profession" type="text" placeholder="Enter doctor's profession" name="profession"/>
                <textarea class="input" id="description" placeholder="Enter doctor's description" name="description" rows="4"></textarea>
                <button id="btnSubmit">Submit</button>              
            </form>
        </div>
    </body>
</html> 