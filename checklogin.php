<?php
    session_start();
    $password = mysql_real_escape_string($_POST['password']);
    $username = mysql_real_escape_string($_POST['username']);
    
    $bool = true;

    mysql_connect("localhost", "root", "") or die (mysql_error()); //Connect to server
    mysql_select_db("student_attendance") or die ("Cannot connect to database"); //Connect to database
    $query = mysql_query("Select * from login WHERE username='$username'"); // Query the users table
    $exists = mysql_num_rows($query); //Checks if username exists
    $table_login = "";
    $table_password = "";
    if($exists > 0) //IF there are no returning rows or no existing username
    {
       while($row = mysql_fetch_assoc($query)) // display all rows from query
       {
          $table_login = $row['username']; // the first username row is passed on to $table_users, and so on until the query is finished
          $table_password = $row['password']; // the first password row is passed on to $table_password, and so on until the query is finished
          
       }
       if(($username == $table_login) && ($password == $table_password) )// checks if there are any matching fields
       {
          if($password == $table_password)
          {
             $_SESSION['index'] = $username; //set the username in a session. This serves as a global variable
             header("location: header.php"); // redirects the user to the authenticated home page
          }
       }
       else
       {
        Print '<script>alert("Incorrect Password!");</script>'; // Prompts the user
        Print '<script>window.location.assign("index.php");</script>'; // redirects to login.php
       }
    }
    else
    {
        Print '<script>alert("Incorrect username!");</script>'; // Prompts the user
        Print '<script>window.location.assign("index.php");</script>'; // redirects to login.php
    }
?>
