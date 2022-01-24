<?php
//starting a session

session_start();

                  

//check for session

if(!isset($_SESSION['user'])) {
	header("location: login.php");
	
}




?>