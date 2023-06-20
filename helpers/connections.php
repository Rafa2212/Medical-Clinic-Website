<?php
$dbhost = "db";
$dbuser = "php_docker";
$dbpass = "password";
$dbname = "php_docker";
if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("failed to connect!");
}
?>