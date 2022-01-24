<?php
include("boot.php");
include("db.php");

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
<br>
<div class="panel panel-default ">

	<div class="panel panel-headings">
	

	

	<div class="panel panel-body">

		<form action="header.php" method="post">

		<table class="table table-stripped">

		<tr>
		<th>#serial number</th>
		<th>Student name</th>
		<th>Roll number</th>
		<th>Attendance status</th>
		</tr>

		

		<?php 
		$date= $_GET['date'];
		$result=mysqli_query($con,"select * from attendance");
		$serialnumber=0; 
		$counter=0;
		while ($row=mysqli_fetch_array($result)) 
		{
			$id = $row['id'];
			$result1=mysqli_query($con,"select * from attendance_record where student_id='$id' and date = '$date' ");
			$row1 = mysqli_fetch_array($result1);
		$serialnumber++; 
			
		?>
		<tr>
		<td> <?php echo $serialnumber; ?> </td>
		<td> <?php echo $row['student_name']; ?> </td>
		
		 <td><?php echo $row['roll_number']; ?> </td>

		<td>
		<input type="checkbox" <?php if($row1['date']!=0){ echo 'checked=""' ; }?> name ="present" value = "1" readonly disabled>  	
		<!--<input type="radio" name="attendance_status[<?php echo $counter; ?>]" 
		<?php if($row['attendance_status']=="present") echo "checked=checked"; ?>
		value="present">Present 
		<input type="radio" name="attendance_status[<?php echo $counter; ?>]"
		<?php if($row['attendance_status']=="absent") echo "checked=checked"; ?>
		value="absent">Absent
-->
		</td>
		</tr>
		 
		 <?php

		 $counter++;
		  } ?>

		</table>

		
		</form>

	</div>	

	</div>
</div>