<?php

// original code by MC
// listing db credentials
$dbhost = '50.57.54.239';
$dbuser = 'sse-dev';
$dbpass = 'XqRj49LSKBfZNGrE';
$dbname = 'sse-dev';

// connecting to db
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// checking connection, creating error message
if (mysqli_connect_errno()) {
    die(printf("Connect failed: %s\n", mysqli_connect_error()));
    exit();
}

// if form submitted, run queries
if(isset($_POST['dollar1'])) {

// inserting form results into ticker table
$sql = "UPDATE ticker
    SET start = CASE id
        WHEN 1 THEN '$_POST[start1]'
        WHEN 2 THEN '$_POST[start2]'
        WHEN 3 THEN '$_POST[start3]'
		WHEN 4 THEN '$_POST[start4]'
    END,
    end = CASE id
        WHEN 1 THEN '$_POST[end1]'
        WHEN 2 THEN '$_POST[end2]'
        WHEN 3 THEN '$_POST[end3]'
		WHEN 4 THEN '$_POST[end4]'
    END,
	dollar = CASE id
        WHEN 1 THEN '$_POST[dollar1]'
        WHEN 2 THEN '$_POST[dollar2]'
        WHEN 3 THEN '$_POST[dollar3]'
		WHEN 4 THEN '$_POST[dollar4]'
    END
	WHERE id IN (1,2,3,4)";
		
mysqli_query($conn, $sql);

// checking for success
if (!mysqli_query($conn, $sql)) 
{
	die('Error: ' . mysqli_error($conn, $sql));
	echo $sql;
}
else
{    
 ?> 
 <script type="text/javascript"> 
 alert("Save Successful!") 
 </script> 
 <?php   
}

// closing connection
mysqli_close($conn);
}
?> 

<!doctype html>
<html>

<head>

	<meta charset="utf-8">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

	
	<title>Ticker Edit by Kellen Digital</title>
<style>* {font-family: Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 15px;}
label {clear: both;}</style>
</head>

<body>

<form id="ticker-edit" action="#" method="post">
<p><strong>Gallons Sold</strong>:<br>
  <label>Start Number</label>
  <input type="number" name="start1" required><br>
  <label>End Number</label>
  <input type="number" name="end1" required>
  <input type="hidden" value="0" name="dollar1">
  </p>
<p><br>
  <strong>Miles Driven</strong>:<br>
  <label>Start Number</label>
  <input type="number" name="start2" required><br>
  <label>End Number</label>
  <input type="number" name="end2" required>
  <input type="hidden" value="0" name="dollar2">
  </p>
<p><br>
  <strong>Dollars Saved</strong>:<br>
  <label>Start Number</label>
  <input type="number" name="start3" required><br>
  <label>End Number</label>
  <input type="number" name="end3" required>
  <input type="hidden" value="1" name="dollar3">
  </p>
<p><br>
  <strong>Reduced Emissions</strong>:<br>
  <label>Start Number</label>
  <input type="number" name="start4" required><br>
  <label>End Number</label>
  <input type="number" name="end4" required>
  <input type="hidden" value="0" name="dollar4">
  </p>
<p><br>
</p>
<button type="submit">UPDATE</button>
<br>
</form>

</body>

</html>