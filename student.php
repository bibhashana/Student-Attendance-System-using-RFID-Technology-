	<?php

	include("boot.php");

	include("db.php");

//if edit is pressed
	if(isset($_GET['edit'])){
		$id = $_GET['edit'];
		$sql = "SELECT * FROM attendance WHERE id = $id";
		$query = mysqli_query($con,$sql);
		$editData = mysqli_fetch_array($query);
	}



	if (isset($_POST['add']))
	{
		if(empty($_POST['CardID'])){
			$error = "Please show a new rfid card.";
		}else{
		$query = "insert into attendance(student_name,roll_number,CardID,gender, faculty_id, semester_id)values('$_POST[student_name]','$_POST[roll_number]','$_POST[CardID]','$_POST[gender]' ,'$_POST[faculty]','$_POST[semester]')";
		$result=mysqli_query($con,$query);

		if ($result) {
			$result = mysqli_query($con, "TRUNCATE temp");
			header("Refresh:1; url=student.php");
			$msg = 'Student added successfully.';
		} else{
			$error = "Mysql Says: " . mysqli_error($con);
		}
	}
	}


	if(isset($_GET['del'])){
	$id = $_GET['del'];
	//echo "Hello from delete".$id;
	$sql = "DELETE FROM attendance WHERE id = $id";
	$query = mysqli_query($con,$sql);
	if($query){
		$sql = "DELETE FROM attendance_record WHERE student_id = $id";
		$query = mysqli_query($con,$sql);
		$msg = "Student has been deleted successfully";

	}

	}


	if(isset($_POST['edit'])){
		$student_name = $_POST['student_name'];
		$roll_number = $_POST['roll_number'];
		$gender = $_POST['gender'];
		$faculty_id = $_POST['faculty'];
		$semester_id = $_POST['semester'];
		$id = $_POST['id'];
		$sql = "UPDATE attendance set student_name = '$student_name', roll_number= '$roll_number', gender = '$gender', faculty_id ='$faculty_id', semester_id = '$semester_id' WHERE id = '$id' ";
		$query = mysqli_query($con,$sql);
		if($query){
	//	$sql = "DELETE FROM attendance_record WHERE student_id = $id";
	//	$query = mysqli_query($con,$sql);
		header("Refresh:1; url=student.php");
		$msg = "Student has been Updated successfully";

		}			
	}

	?>

	<div class="container">
		<div class="panel panel-default">

			<?php  if(isset($msg)) { ?>
				<div class="alert alert-success"><?php echo $msg; ?></div>
			<?php } ?>
			<?php  if(isset($error)) { ?>
				<div class="alert alert-danger"><?php echo $error; ?></div>
			<?php } ?>
			<div class="panel-heading">
				<h2>
					<a href="student.php"><button class="btn btn-success">View Student</button></a>
					<a href="student.php?add"><button class="btn btn-info">Add Student</button></a>

				</h2>
			</div>
			<br/>
		</div>

			<?php 
			if (isset($_GET['add']) || isset($_GET['edit'])) {
				include("add.php");
			} else {

				include("view.php");
			}
			?>