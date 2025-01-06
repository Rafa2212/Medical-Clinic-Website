<?php

session_start();
  include "../helpers/connections.php";
  include "../helpers/functions.php";
  $user_data = check_login($con);
  
  // Get only doctors for the current user
  $user_id = $_SESSION['user_id'];
  $doctors_query = mysqli_query($con, "SELECT * FROM doctors WHERE user_id = '$user_id'");
  
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['nav']))
    {
      $_SESSION['doctor_id'] = "0";
      header("Location: patients.php");
    }
    if(isset($_POST['addDoctor'])) {
        header("Location: addDoctor.php");
        die;
    }
    // Handle doctor deletion
    foreach($_POST as $key => $value) {
        if(strpos($key, 'delete_') === 0) {
            $doctor_id = substr($key, 7); // Remove 'delete_' prefix
            $delete_query = "DELETE FROM doctors WHERE id = ? AND user_id = ?";
            $stmt = mysqli_prepare($con, $delete_query);
            mysqli_stmt_bind_param($stmt, "ii", $doctor_id, $user_id);
            mysqli_stmt_execute($stmt);
            header("Location: main.php");
            die;
        }
    }
    // Only loop through the user's doctors
    while($doctor = mysqli_fetch_assoc($doctors_query)) {
        if(isset($_POST['btn' . $doctor['id']]))
        {
            $_SESSION['doctor_id'] = $doctor['id'];
            header("Location: patients.php");
        }
    }
  }
  
  // Reset the result pointer to beginning for the HTML loop
  mysqli_data_seek($doctors_query, 0);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Home</title>
        <link href="../assets/style/main.css" rel="stylesheet" />
        <link rel="Website Icon" type="png" href="assets/images/logo.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo+Play:wght@600&display=swap" rel="stylesheet">
        <script src="../assets/scripts/main.js"></script>
    </head>
    <body>
            <ul>
                <li>
                    <button class="navbar" onclick="document.location='main.php'">Home</button>
                </li>
                <li>
                  <form method = 'post'>
                    <button name='nav' class="navbar">Patients</button>
                    </form>
                </li>
                <li>
                    <button class="navbar" onclick="document.location='about.php'">About</button>
                </li>
                <li>
                    <button class="navbar" onclick="document.location='logout.php'">Log out</button>
                </li>
            </ul>
            
            <div class="add-doctor-container">
              <form method="post">
                <button name='addDoctor' id="search" style="margin-left: auto; margin-right: auto;" class="tooltip">
                    <img src="../assets/images/fd_pacienti.png" width='25px'>
                    <span class="tooltiptext">Add doctor</span>
                </button>
              </form>
            </div>

            <form method='post'>
            <div class = "container">
                <?php 
                $has_doctors = false;
                while($doctor = mysqli_fetch_assoc($doctors_query)) { 
                    $has_doctors = true;
                    $id = $doctor['id'];
                ?>
                    <div class="card" onmouseover="notHidden(<?php echo $id; ?>)" onmouseout="hide(<?php echo $id; ?>)">
                        <div class="delete-container">
                            <button type="submit" name="delete_<?php echo $id; ?>" class="delete-btn">✕</button>
                        </div>
                        <div class="card-info">
                            <div id="cardAvtr<?php echo $id; ?>" class="card-avatar"></div>
                            <div id="cardTitle<?php echo $id; ?>" class="card-title"><?php echo htmlspecialchars($doctor['name']); ?></div>
                            <div id="cardSubtitle<?php echo $id; ?>" class="card-subtitle"><?php echo htmlspecialchars($doctor['profession']); ?></div>
                            <div hidden id="descr<?php echo $id; ?>" class="description">
                                <?php echo htmlspecialchars($doctor['description']); ?>
                            </div>
                        </div>
                        <ul class="card-social">
                            <li class="card-social__item">
                                <button hidden id="btn<?php echo $id; ?>" name='btn<?php echo $id; ?>' class="btnPacienti">
                                    <img class="imgReports" src="../assets/images/fd_pacienti.png">
                                </button>
                            </li>
                        </ul>
                    </div>
                <?php } 
                if (!$has_doctors) {
                    echo '<div class="no-doctors">No doctors added yet</div>';
                }
                ?>
            </div>
</div>
</form>
<footer class="footer">
  <svg viewBox="0 -20 700 110" width="100%" height="110" preserveAspectRatio="none">
    <path transform="translate(0, -20)" d="M0,10 c80,-22 240,0 350,18 c90,17 260,7.5 350,-20 v50 h-700" fill="white" />
    <path d="M0,10 c80,-18 230,-12 350,7 c80,13 260,17 350,-5 v100 h-700z" fill="#2C363E" />
  </svg>
</footer>
    </body>
</html>