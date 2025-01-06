<?php
    include("../helpers/connections.php");
    include("../helpers/functions.php");
    session_start();
    
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if(!empty($username) && !empty($password))
        {
            if(isset($_POST['sign-up'])) {
                $check_query = "SELECT * FROM users WHERE username = ? LIMIT 1";
                $stmt = mysqli_prepare($con, $check_query);
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                if(mysqli_num_rows($result) > 0) {
                    echo "<dialog id='dialog'>
                    <form method='dialog'>
                    Username already exists!
                    <button id='btnClose'>Close</button>
                    </form>
                    </dialog>";
                } else {
                    $user_id = random_num(20);
                    $date = date("Y-m-d H:i:s");
                    $query = "INSERT INTO users (user_id, username, password, date) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_prepare($con, $query);
                    mysqli_stmt_bind_param($stmt, "ssss", $user_id, $username, $password, $date);
                    
                    if(mysqli_stmt_execute($stmt)) {
                        $_SESSION['user_id'] = $user_id;
                        header("Location: main.php");
                        die;
                    }
                }
            } else if(isset($_POST['sign-in'])) {
                $query = "SELECT * FROM users WHERE username = ? LIMIT 1";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                if($result && mysqli_num_rows($result) > 0) {
                    $user_data = mysqli_fetch_assoc($result);
                    if($user_data['password'] === $password) {
                        $_SESSION['user_id'] = $user_data['user_id'];
                        header("Location: main.php");
                        die;
                    }
                }
                echo "<dialog id='dialog'>
                <form method='dialog'>
                Insert a correct username / password!
                <button id='btnClose'>Close</button>
                </form>
                </dialog>";
            }
        } else {
            echo "<dialog id='dialog'>
            <form method='dialog'>
            Please fill in both username and password!
            <button id='btnClose'>Close</button>
            </form>
            </dialog>";
        }
    }
?>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login</title>
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
        </script>
    </head>
    <body>
        <div class="row">
            <div class="branding">
                <img id="img" src="../assets/images/logo.png" alt="Home">
                <span class="subtitle">We provide the best medical resources</span>
            </div>
        </div>
        <div class="row">
            <form class="login-form" method="post">
                <input id="username" type="text" placeholder="Enter your username" name="username"/>
                <input id="password" type="password" placeholder="Enter your password" name="password"/>
                <div class="button-group">
                    <button name='sign-in' id="sign-in" class="cta">
                        <span>Sign In</span>
                        <svg viewBox="0 0 13 10" height="15px" width="15px">
                            <path d="M1,5 L11,5"></path>
                            <polyline points="8 1 12 5 8 9"></polyline>
                        </svg>
                    </button>
                    <button name='sign-up' id="sign-up" class="cta">
                        <span>Sign Up</span>
                        <svg viewBox="0 0 13 10" height="15px" width="15px">
                            <path d="M1,5 L11,5"></path>
                            <polyline points="8 1 12 5 8 9"></polyline>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        <footer class="footer" style='position: fixed; right:0; left: 0; bottom: 0;'>
            <svg viewBox="0 -20 700 110" width="100%" height="110" preserveAspectRatio="none">
                <path transform="translate(0, -20)" d="M0,10 c80,-22 240,0 350,18 c90,17 260,7.5 350,-20 v50 h-700" fill="white" />
                <path d="M0,10 c80,-18 230,-12 350,7 c80,13 260,17 350,-5 v100 h-700z" fill="#2C363E"/>
            </svg>
        </footer>
    </body>
</html>