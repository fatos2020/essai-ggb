<?php 

$servername = "91.216.107.185";
$dBUsername = "ggbmu2482316";
$dBPassword = "Ggbservice1@";
$dBName = "ggbmu2482316";

$conn = mysqli_connect($servername,$dBUsername,$dBPassword,$dBName);

if(!$conn){
    die("Connection Failed!".mysqli_connect_error());
}
