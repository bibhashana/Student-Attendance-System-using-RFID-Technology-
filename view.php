<table class="table table-stripped">
	<thead>
		<tr>
			<th>S.No.</th>
			<th>Student name</th>
			<th>Roll number</th>
			<th>Card ID</th>
			<th>Gender</th>
			<th>Faculty</th>
			<th>Semester</th>
			<th></th>
			<th>Actions</th>
		</tr>
	</thead>

	<?php 
	session_start();
//Connect to database
	require'db.php';

	$seldate = $_SESSION["exportdata"];
	
	$result=mysqli_query($con,"select * from attendance");
	$serialnumber=1; 
	if(count($result)>0){

		while ($row=mysqli_fetch_array($result)) 
		{
			$id = $row['id'];
			$faculty_id = $row['faculty_id'];
			$semester_id = $row['semester_id'];


			?>
			<tbody>
				<tr>
					<td><?php echo $serialnumber; ?></td>
					<td><?php echo $row['student_name']; ?></td>
					<td><?php echo $row['roll_number']; ?></td>
					<td><?php echo $row['CardID']; ?></td>
					<td><?php  echo ucfirst($row['gender']); ?></td>
					<td>
						<?php 
						$result1=mysqli_query($con,"select * from faculty where id='$faculty_id'");
						$row1 = mysqli_fetch_array($result1);
						echo $row1['faculty_shortname'];
						?>
					</td>
					<td class="text-center">
						<?php 
						$result1=mysqli_query($con,"select * from semester where id='$semester_id'");
						$row1 = mysqli_fetch_array($result1);
						echo $row1['semester_shortname'];
						?>
					</td>
					<td></td>
					<td>
						<a href="?edit=<?php echo $row['id']; ?>"><button class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</button></a>
						<a href="?del=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure to delete?')"><button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button></a>

					</td>
				</tr>
				<?php 
				$serialnumber++;
			}

		}else{
			?>
			<tr>
				<td colspan="9">No Record(s) found.</td>
			</tr>
			<?php
		}

		?>
	</tbody>




</table>