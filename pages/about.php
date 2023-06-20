<?php
        include "../helpers/connections.php";
        include "../helpers/functions.php";
        session_start();
        $user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About</title>
    <link href="../assets/style/main.css" rel="stylesheet" type="text/css">
    <link rel="Website Icon" type="png" href="assets/images/logo.png">
    <script src="../assets/scripts/main.js"></script>
</head>
<body>
<ul>
                <li>
                    <button class="navbar" onclick="document.location='main.php'">Home</button>
                </li>
                <li>
                    <button class="navbar" onclick="document.location='patients.php'">Patients</button>
                </li>
                <li>
                    <button class="navbar" onclick="document.location='about.php'">About</button>
                </li>
                <li>
                    <button class="navbar" onclick="document.location='signin.php'">Log out</button>
                </li>
            </ul>
        <div class="content">
            <div class="about">
            We understand the challenges that doctors face in their daily practice, including managing patient records, scheduling appointments, and staying up-to-date with medical advancements. Our app is designed to simplify these tasks, allowing doctors to focus more on patient care and less on administrative burdens.
            Our user-friendly interface and intuitive design make navigating the app effortless, ensuring a seamless user experience. With secure access to patient records, doctors can efficiently retrieve and update medical information, enabling them to make informed decisions and provide personalized treatment plans.
            We are committed to ongoing improvements and user feedback. We value the input of our users and continuously work to enhance our app's features and functionality, ensuring it remains a valuable tool for doctors in their daily practice.
            In addition to its practical features,We are continuously evolving to meet the evolving demands of modern medicine. We regularly update our app with the latest advancements, incorporating evidence-based guidelines and clinical decision support tools to assist you in delivering the best possible care.
            </div>
        </div>
        <footer class="footer">
  <svg viewBox="0 -20 700 110" width="100%" height="110" preserveAspectRatio="none">
    <path transform="translate(0, -20)" d="M0,10 c80,-22 240,0 350,18 c90,17 260,7.5 350,-20 v50 h-700" fill="white" />
    <path d="M0,10 c80,-18 230,-12 350,7 c80,13 260,17 350,-5 v100 h-700z" fill="#2C363E" />
  </svg>
</footer>
</body>

</html>