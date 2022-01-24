<table class="table table-stripped">
	<thead>
		<tr>
			<th>S.No.</th>
			<th>Student name</th>
			<th>Roll number</th>
			<th class="text-center">Is Present?</th>
			<th>Time Arrived</th>
		</tr>
	</thead>

	<?php 
	session_start();
//Connect to database
require'db.php';

$seldate = $_SESSION["exportdata"];
	
	$result=mysqli_query($con,"select * from attendance");
	$serialnumber=0; 
	$counter=0;
	while ($row=mysqli_fetch_array($result)) 
	{
		$id = $row['id'];
		$result1=mysqli_query($con,"select * from attendance_record where student_id='$id' and date = '$seldate' ");
		$row1 = mysqli_fetch_array($result1);
		$serialnumber++; 

		?>
		<tbody>
			<tr>
				<td> <?php echo $serialnumber; ?></td>
				<td> <?php echo $row['student_name']; ?> </td>
				<td> <?php echo $row['roll_number']; ?> </td>

				<td class="text-center">
					<input type="checkbox" <?php if($row1['date']!=0){ echo 'checked=""' ; } ?> name ="present" value = "1" readonly disabled>
				</td>
				<td><?php  echo isset($row1['time'])?$row1['time']:"-"; ?></td>
			</tr>
		</tbody>

		<?php
		$counter++;
	} ?>


</table>