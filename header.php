<?php
include("checksession.php");
include("db.php");
include("boot.php");


$flag=0;
if(isset($_POST['submit']))
{
	
	if(isset($_POST['present'])){
		foreach($_POST['student_id'] as $key=> $value){
			$student_id = $_POST['student_id'][$key];
			//echo $student_id;
			if(isset($_POST['present'][$key])){
				$query = "SELECT * FROM attendance_record WHERE student_id = '$student_id' AND date = CURDATE()";
				$result = mysqli_query($con,$query);
				$data = mysqli_num_rows($result);
				
				if($data==1){
					$query = "update attendance_record set time=CURTIME() where id='$student_id' and date = CURDATE()";
					$result = mysqli_query($con,$query);
					
				}else
				$query = "insert into attendance_record(student_id, time, date) values('$student_id',CURTIME(), CURDATE())";
				$result = mysqli_query($con,$query);
			}else{
				
				$query = "delete from attendance_record where student_id = '$student_id' AND date = CURDATE()";
				$result = mysqli_query($con,$query);
			}
		}

	}else{
		foreach($_POST['student_id'] as $key=> $value){
			$student_id = $_POST['student_id'][$key];
			$query = "delete from attendance_record where student_id = '$student_id' AND date = CURDATE()";
			$result = mysqli_query($con,$query);

		}
		
	}
	$msg = "Attendance Updated Successfully";

}

?>
<div class="container">

	<div class="row">
		<div class="col-md-10 text-left">
			<a class="btn btn-success" href="student.php">Manage Student</a>
			
			<a class="btn btn-info" href="viewall.php">Manage Attendance</a>    
		</div>
		<div class="col-md-2 text-right">
			<a class="btn btn-danger" href="logout.php">Logout</a>
		</div>

</div>
		<br/>

		<div class="panel panel-default">

			<?php  if(isset($msg)) { ?>
				<div class="alert alert-success"><?php echo $msg; ?></div>
			<?php } ?>
			<?php  if(isset($error)) { ?>
				<div class="alert alert-danger"><?php echo $error; ?></div>
			<?php } ?>
			
		</div>
		
	<div class="row">
		<div class="col-md-12">
	<h3 class="text-center">Attendance for: <?php echo date("l, F m, Y");  ?></h3>
	</div>


	<div class="col-md-12">
	
	<form action="header.php" method="post">

		<table class="table table-stripped">
			<thead>
				<tr>
					<th>S.No.</th>
					<th>Student name</th>
					<th>Roll number</th>
					<th class="text-center">Is Present?</th>
				</tr>
			</thead>

			<?php 
			$result=mysqli_query($con,"select * from attendance");
			$serialnumber=0; 
			$counter=0;
			while ($row=mysqli_fetch_array($result)) 
			{
				$id = $row['id'];
				$result1=mysqli_query($con,"select * from attendance_record where student_id='$id' and date = CURDATE() ");
				$row1 = mysqli_fetch_array($result1);
				$serialnumber++; 

				?>
				<tbody>
					<tr>
						<td> <?php echo $serialnumber; ?></td>
						<td> <?php echo $row['student_name']; ?> </td>
						<td> <?php echo $row['roll_number']; ?> <input type="hidden" value="<?php echo $row['id']; ?>" name="student_id[<?php echo $counter; ?>]"> </td>

						<td class="text-center">
							<input type="checkbox" <?php if($row1['date']!=0){ echo 'checked=""' ; } ?> name ="present[<?php echo $counter; ?>]" value = "1">
			<!--
		<input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="present">Present 
		<input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="absent">Absent
	-->
</td>
</tr>
</tbody>

<?php

$counter++;
} ?>

<tr>
	<th></th>
	<th></th>
	<th></th>
	<th class="text-center"><input type="submit" name="submit" value="submit" class="btn btn-primary"></th>
</tr>

</table>


</form>

</div>	

</div>
</div>
</div>






