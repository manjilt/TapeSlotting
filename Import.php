<?php
$user = 'root';
$password = '';
$database = 'tapes';
$tapes = $_POST["ImportTapes"];
//$tapes = preg_replace('#\s+#',',',trim($tapes));
$tapeArray = explode(",", $tapes);

$countOfArray = count($tapeArray);

$mysqli = new mysqli("localhost", $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

foreach (range(0, $countOfArray-1) as $number) {
  $currentTape = $tapeArray[$number];
  $res = $mysqli->query("SELECT Tape, Location FROM tapelocation WHERE Tape ='$currentTape'");
  if ($res->num_rows > 0){
	  echo "<b>"; 
	  echo $currentTape; 
	  echo "</b>";
	  echo " is already in library <br>";
  }
  $res = $mysqli->query("SELECT Hosting, Tape FROM tapes WHERE Tape ='$currentTape'");
  $row = $res->fetch_assoc();
  $hosting = $row['Hosting'];
  $locationQuery = $mysqli->query("SELECT Location FROM location WHERE  Empty =1 AND Hosting = '$hosting' LIMIT 1");
  $rowloc = $locationQuery->fetch_assoc();
  $location = $rowloc['Location'];
  $mysqli->query("INSERT INTO tapelocation VALUES ('$currentTape', '$location',NOW())");
  $mysqli->query("UPDATE Location SET Empty ='0' WHERE Location = '$location'");

  echo "<u>";
  echo $tapeArray[$number];
  echo '_____---->_____';
  echo  $location;
  echo "</u>";
  echo "<br>";

}

?>
