<?php
$user = 'root';
$password = '';
$database = 'tapeslotting';
$tapes = $_POST["ImportTapes"];

$tapeArray = explode("\n", $tapes);
//echo $tapeArray[1];
$countOfArray = count($tapeArray);
$connect = mysql_connect("localhost", $user, $password);
@mysql_select_db($database) or ("Database not found");

$query = "SELECT Location FROM `location` WHERE  Empty =1 AND Hosting = 1 LIMIT 90";

$result = mysql_query($query);
foreach (range(0, $countOfArray-1) as $number) {
  echo "<u>";
  echo $tapeArray[$number];
  echo '_____---->______';
  echo  mysql_result($result, $number);
  echo "</u>";
  echo "<br>";

}
?>
