<?php
include("db.php");

//fetch cardid
	$cardresult=mysqli_query($con,"select * from temp");

	if(mysqli_num_rows($cardresult)==1){
		$CardID = mysqli_fetch_array($cardresult);
		$Cardnumber = $CardID['CardID'];
	}
?>
<div class="form-group">
					<label for="CardID">Card No.</label>
					<input type="text" name="CardID" id="CardID" class="form-control" placeholder="Please show a new card in the rfid reader" value="<?php if(isset($editData)){ echo $editData['CardID'];}else{echo isset($Cardnumber)?$Cardnumber:'';} ?>" required  readonly>
</div>
