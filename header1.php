<?php
include("checksession.php");
include("db.php");
include("boot.php");

date_default_timezone_set('Asia/Kathmandu');
$d = date("Y-m-d");

if (!empty($_POST['submitdate'])) {
  $seldate = $_POST['seldate'];
}
else{
  $seldate = $d;
}

$_SESSION["exportdata"] = $seldate;

?>



<div class="container">

  <div class="row">
    <div class="col-md-10 text-left">
       <a class="btn btn-success" href="student.php">Manage Student</a> 
      
      <a class="btn btn-info" href="viewall.php">View all</a>    
    </div>
    <div class="col-md-2 text-right">
      <a class="btn btn-danger" href="logout.php">Logout</a>
    </div>


    <br/>
    <?php if(isset($msg)) { ?>
     <div class="alert alert-success"><?php echo $msg; ?></div>
   <?php } ?>
   <br>
   </div>
   <div class="row">
    <div class="col-md-9">
      <h4>Attendace for : <?php echo isset($seldate) ? $seldate : $d; ?></h4>
    </div>
   <div class="col-md-3 text-right">

    <form method="post" action="">
      <div class="form-row">
        <div class="col">
          <input type="text"  class="form-control datepicker" data-provide="datepicker" placeholder="Select Date" name="seldate" value="<?php echo isset($_POST['seldate'])? $_POST['seldate'] :"" ?>">
        </div>
        <div class="col">
          <input type="submit" class="btn btn-primary" name="submitdate" value="Select Date">
        </div>
      </div>
    </form>
  </div>
</div>







<div id="cards" class="cards">
</div>
</div>












</div>
</div>
<script type="text/javascript">
	$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    endDate: 'today',
    todayHighlight: true
  });
</script>	
<script>
  $(document).ready(function(){
    setInterval(function(){
      $.ajax({
        url: "load-attendance.php"
      }).done(function(data) {
        $('#cards').html(data);
      });
    },1000);
  });
</script>