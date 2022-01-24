<?php
include("db.php");

date_default_timezone_set('Asia/Kathmandu');
$d = date("Y-m-d");
$t = date("H:i A");

if(!empty($_GET['CardID'])){
	$Card = $_GET['CardID'];
	//$Card = "582247531";
	$sql = "SELECT * FROM attendance WHERE CardID='$Card'";
	$result = mysqli_query($con, $sql);
	$data = mysqli_num_rows($result);
	if(!$data){
		//for new card registration
		//header('location:add.php?CardID='.$Card);
		$sql = "SELECT * FROM temp WHERE CardID='$Card' ";
		$result = mysqli_query($con, $sql);
		$data = mysqli_num_rows($result);
		if(!$data){
		$delete = mysqli_query($con,"TRUNCATE temp");
		$sql = "INSERT INTO temp (CardID) VALUES ($Card)";
		$result = mysqli_query($con, $sql);
		echo "newcard";
		}else{echo "duplicatecard";}
	}else{
		$row=mysqli_fetch_array($result);
		//An existed card has been detected for attendance
		if (!empty($row['student_name'])){
			$student_name = $row['student_name'];
			$student_id = $row['id'];
			$sql = "SELECT * FROM attendance_record WHERE student_id='$student_id' AND date=CURDATE()";
			$result = mysqli_query($con, $sql);
			$data = mysqli_num_rows($result);
			if(!$data){
				$sql = "INSERT INTO attendance_record (student_id, time, date) VALUES ($student_id, CURTIME(), CURDATE())";
				$result = mysqli_query($con, $sql);
				echo "attendance";
			}else{
				echo "duplicateentry";
			}
        }    
	}
	
}
?>