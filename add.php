<div class="panel-body">
	<form action="" method="post">
		<div id="cards"></div>
		<div class="form-group">
			<label for="student_name">Student name</label>
			<input type="text" name="student_name" id="name" class="form-control" required value="<?php if(isset($_POST['add'])) echo $_POST['student_name']; else echo isset($editData)?$editData['student_name']:""; ?>">
		</div>

		<div class="form-group">
			<label for="roll">Roll number</label>
			<input type="text" name="roll_number" id="roll" class="form-control" required value="<?php if(isset($_POST['add'])) echo $_POST['roll_number']; else echo isset($editData)?$editData['roll_number']:""; ?>">
		</div>


		<div class="form-group">
			<label for="gender">Gender</label>
			<div>
				<?php
				$active = 'checked';
				$inactive = '';
				if(isset($_POST['gender'])){
					if($_POST['gender'] == "female"){
						$active = '';
						$inactive = 'checked'; 
					}
				}
				if(isset($editData)){
					if($editData['gender'] == "female"){
						$active = '';
						$inactive = 'checked'; 
					}
				}

				?>
				<label class="radio-inline"><input type="radio" name="gender" <?php echo $active;?> value="male">Male</label>
				<label class="radio-inline"><input type="radio" name="gender" <?php echo $inactive;?> value="female">Female</label>
			</div>


		</div>

		<div class="form-group row">
			<div class="col-md-6">
				<label for="faculty">Faculty</label>
				<select class="form-control" id="faculty" name="faculty">
					<?php
					$result=mysqli_query($con,"select * from faculty where status = '1' ");

					while ($row=mysqli_fetch_array($result)) 
					{
						$selected ='';
						$id = $row['id'];
						$faculty_name = $row['faculty_name'];
						if(isset($editData)){
							if($editData['faculty_id'] == $row['id']){
								$selected = 'selected="selected"';
							}
						}
						if(isset($_POST['faculty'])){
							if($_POST['faculty'] == $row['id']){
								$selected = 'selected="selected"';
							}
						}
						?>
						<option value="<?php echo $id; ?>" <?php echo $selected; ?>><?php echo $faculty_name; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-md-6">
				<label for="semester">Semester</label>
				<select class="form-control" id="semester" name="semester">
					<?php
					$result=mysqli_query($con,"select * from semester where status = '1' ");

					while ($row=mysqli_fetch_array($result)) 
					{	
						$selected ='';
						$id = $row['id'];
						$semester_name = $row['semester_name'];
						if(isset($editData)){
							if($editData['semester_id'] == $row['id']){
								$selected = 'selected="selected"';
							}
						}
						if(isset($_POST['semester'])){
							if($_POST['semester'] == $row['id']){
								$selected = 'selected="selected"';
							}
						}
						?>
						<option value="<?php echo $id; ?>" <?php echo $selected; ?>><?php echo $semester_name; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<?php 
			if(isset($editData)){
		?>
		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $editData['id']; ?>" />
			<input type="submit" name="edit" value="Update" class="btn btn-primary" required>
		</div>
		<?php 
			}else{
				?>

		<div class="form-group">
			<input type="submit" name="add" value="submit" class="btn btn-primary" required>
		</div>
		<?php
			}
		?>
	</form>
</div>

</div>

</div>
<?php 
if(!isset($editData)){
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			setInterval(function(){
				$.ajax({
					url: "loadcardid.php"
				}).done(function(data) {
					$('#cards').html(data);
				});
			},5000);
		});
	</script>
	<?php
}
?>