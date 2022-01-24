<?php 

include("db.php");
include("boot.php");
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



		<table class="table table-stripped">

		<tr>
		<th>Serial number</th>
		<th>Dates</th>
		<th>Show attendance</th>
		</tr>

		<?php $result=mysqli_query($con,"select distinct date from attendance_record order by date desc");
		$serialnumber=0; 
		
		while ($row=mysqli_fetch_array($result)) 
		{

		$serialnumber++; 
			
		?>
		<tr>
		<td> <?php echo $serialnumber; ?> </td>
		<td> <?php echo $row['date']; ?> </td>
		<td>
		<form  method="get" action="show_attendance.php">
		<input type="hidden" value="<?php echo $row['date'] ?>" name="date">
		<input type="submit" class="btn btn-primary" value="Show attendance">
		</form>
		</td>	
	 
		
		</tr>
		 
		 <?php

		 
		  } ?>

		</table>

		

		

	</div>	

	</div>
</div>