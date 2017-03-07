<?php
$user = 'root';
$password = '';
$database = 'tapes';
$tapes = $_POST["ImportTapes"];

$tapeArray = explode("\n", $tapes);
//echo $tapeArray[1];
$countOfArray = count($tapeArray);
$connect = mysql_connect("localhost", $user, $password);
@mysql_select_db($database) or ("Database not found");

foreach (range(0, $countOfArray-1) as $number) {
  $currentTape = $tapeArray[$number];
  $hostingQuery = "SELECT Hosting FROM tapes WHERE Tape ='$currentTape' LIMIT 1";
  $hostingResult = mysql_query($hostingQuery);
  $hosting = mysql_result($hostingResult, 0);
  $locationQuery = "SELECT Location FROM location WHERE  Empty =1 AND Hosting = '$hosting' LIMIT 1";
  $locationResult = mysql_query($locationQuery);
  $location = mysql_result($locationResult, 0);
  $insertTo = "INSERT INTO tapelocation VALUES ('$currentTape', '$location','')";
  $query4 = "UPDATE Location SET Empty ='0' WHERE Location = '$location'";

  echo "<u>";
  echo $tapeArray[$number];
  echo '_____---->_____';
  echo  $location;
  echo "</u>";
  echo "<br>";

}

?>
