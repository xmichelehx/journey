<?php
// original code by MCC
//ticker numbers are pulled from database, can edit on frontend using edit.php
//change only #bannerNum, all other data is dynamic

$bannerNum = "1"; //can change this (available:  1, 2, 3 or 4) - also add 'selected' class to appropriate navigation bullet in html lines 97-103

//****************************************************************************//
$prevNum = $bannerNum - 1; // do not change
$nextNum = $bannerNum + 1; // do not change

// banner numbers
// 1 natural gas gallons sold
// 2 miles driven
// 3 dollars saved
// 4 reduced carbon emissions

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

// getting numbers from ticker table
$sql="SELECT * FROM ticker WHERE id='".$bannerNum."'";
$result = mysqli_query($conn, $sql);

$num = $result->num_rows;

while ($row = $result->fetch_assoc()) {  

   echo "<p style=\"display:none;\" id=\"start\">".$row['start']."</p><p style=\"display:none;\" id=\"end\">".$row['end']."</p><p style=\"display:none;\" id=\"dollar\">".$row['dollar']. "</p>"; //etc...
}
 
// checking for success
if (!mysqli_query($conn, $sql)) 
{
	die('Error: ' . mysqli_error($conn));
}
else {}

// closing connection
mysqli_close($conn);
?>

<!doctype html>
<html>

<head>

	<meta charset="utf-8">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

	<title>Ticker by Kellen Digital</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

</head>

<body>

<!-- ticker container -->
<div class="ticker-container" style="
	background-image:url(../wp-content/uploads/2015/02/ticker<?php echo $bannerNum ?>-bg.png);">
	
	<div class="ticker-numbers">
		
		<div id="t-9" class="num">&nbsp;</div>
		<div id="t-8" class="num">&nbsp;</div>
		<div id="t-7" class="num">&nbsp;</div>
		
		<div id="t-6" class="num">&nbsp;</div>
		<div id="t-5" class="num">&nbsp;</div>
		<div id="t-4" class="num">&nbsp;</div>
		
		<div id="t-3" class="num">&nbsp;</div>
		<div id="t-2" class="num">&nbsp;</div>
		<div id="t-1" class="num">&nbsp;</div>
		
	</div>
</div>

<!-- ticker navigation-->
<div class="tp-bullets simplebullets round">
	<a class="tp-leftarrow tparrows round" href="index<?php if ($prevNum==0){echo '4';} else {echo $prevNum;} ?>.php">
  	</a>
	<a class="bullet first selected" href="index1.php" >
    </a>
    <a class="bullet" href="index2.php">
    </a>
    <a class="bullet" href="index3.php">
    </a>
    <a class="bullet last" href="index4.php">
    </a>
    <a class="tp-rightarrow tparrows round" href="index<?php if ($nextNum==5){echo '1';} else {echo $nextNum;} ?>.php">
  	</a>
    <div class="tpclear">
    </div>
</div>

<!-- ticker numbers animation -->
<script type="text/javascript">
//<![CDATA[

var startStr = document.getElementById('start').innerHTML;
var endStr = document.getElementById('end').innerHTML;
var dollarStr = document.getElementById('dollar').innerHTML;

var start = Number(startStr);
var end = Number(endStr);
var dollar = Number(dollarStr);

window.onload = (function($, undefined) {
	
// edit between these lines to change ticker animation //
window.number = start; // starting number
window.increment = 1; // increase by these # of digits
window.milliseconds = 1; // speed - lower # is faster
window.max = end; // ending number - max 999999999
window.dollarsign = dollar; // show - true or false
// do not edit anything below this line //

window.ticker = setInterval(function(){

	window.number = window.number + window.increment;
	if (window.number > window.max - window.increment){
		clearInterval(window.ticker);
	}
	window.tn = window.number.toString();
	window.tn = window.tn.split('').reverse().join('');

	var i;
	for (i=1;i<=window.tn.length;i++){
		num(i, window.tn[i-1]);
	}
	if (window.dollarsign){
		num(window.tn.length + 1, '$');
	}

}, window.milliseconds);

$('.num').html('<img src="images/ticker-x.png" />');

function num(target, value){

	if (value === '$'){
		value = 's';
	} else if (value === ' '){
		value = ' ';
	}

	$('#t-' + target).html('<img src="images/ticker-' + value + '.png" />');

}

})(jQuery);
//]]>
</script>

<!--redirecting to next ticker-->
<script type="text/javascript">
function Redirect() {
    window.location="http://biz.gng.com/ticker/index<?php if ($nextNum==5){echo '1';} else {echo $nextNum;} ?>.php";
}
setTimeout('Redirect()', 20000);
</script>

</body>

</html>
