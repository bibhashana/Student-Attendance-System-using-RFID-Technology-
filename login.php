<?php
//error_reporting(0);
session_start();
include "db.php";
if(isset($_SESSION['user']))
{
header("location:header.php");
}else{




    
  
if (isset($_POST['Login'])) 
{
//echo "hello from Login";
$name = $_POST['name'];
$password = $_POST['pass'];

  $q= "SELECT * from login where name = '$name' and password = '$password' ";
  $res = mysqli_query($con,$q);
  $data = mysqli_num_rows($res);
    
    if ($data == 0) 
    {
          //header("location:login.php?user=Incorrect username or password");
         $error = "Incorrect username or password" ; 
  } 

    while ($row = mysqli_fetch_array($res)) {
      $_SESSION['user'] = $row['id'];
      if ($row['type'] == 'admin') {
          
          header("location:header.php");
          
        }

        elseif ($row['type'] == 'hr') 
        {
          header("location:header1.php");
            }
     
     

      
    }



}
}


?>

<!DOCTYPE html>
<html>
<head>
  <title></title>

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js" integrity="sha384-u/bQvRA/1bobcXlcEYpsEdFVK/vJs3+T+nXLsBYJthmdBuavHvAW6UsmqO2Gd/F9" crossorigin="anonymous"></script>

</head>
<body style="background-color: grey">
<br>
<div class="container">
  
    <form method="post" >
     <div class="form-group col-lg-6 m-auto">
      <div class="container">
          <div class="card-header bg-dark">
          <h3 class="text-white">Login</h3>
            </div><br>
            
            <?php if(isset($error)) { ?>
  <div class="alert alert-success"><?php echo $error; ?></div>
  <?php } ?> 

        <label><b>Username</b></label>
        <input type="text" name="name" class="form-control" required><br>

        <label><b>Password</b></label>
        <input type="password" name="pass" class="form-control" required><br>

        <button name="Login" class="btn btn-success">Login</button><br>
        
  
      </div>  
    </form>

</div>
</body>
</html>

