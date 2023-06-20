<?php

session_start();
include "../helpers/connections.php";
include "../helpers/functions.php";
$user_data = check_login($con);

if($_SERVER['REQUEST_METHOD'] == 'POST'){

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
                        <input id="username" type="text" placeholder="Enter your username" name="username"/>
                        <input id="password" type="password" placeholder="Enter your password" name="password"/>
                        <button id="btnSubmit">Submit</button>              
                    </form>
    </body>
</html>