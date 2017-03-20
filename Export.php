<?php
$user = 'root';
$password = '';
$database = 'tapes';
$tapes = $_POST["ExportTapes"];

$tapeArray = explode("\r\n", $tapes);
$countOfArray = count($tapeArray);


$mysqli = new mysqli("localhost", $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

foreach (range(0, $countOfArray-1) as $number) {
  $currentTape = $tapeArray[$number];

  $res = $mysqli->query("SELECT Tape, Location FROM tapelocation WHERE Tape ='$currentTape'");
   if ($res->num_rows == 0){
	  echo "<b>";
	  echo $currentTape;
	  echo "</b>";
	  echo " is not in library <br>";
  }
  else {
  $row = $res->fetch_assoc();
  $tape = $row['Tape'];
  $location = $row['Location'];
  $deleteQuery = "DELETE FROM tapelocation WHERE Tape='$tape'";
  if ($mysqli->query($deleteQuery) === TRUE) {
    echo "<br>$tape exported successfully <br>";
	$updateQuery = "UPDATE Location SET Empty ='1' WHERE Location = '$location'";
	if($mysqli->query($updateQuery) === TRUE) {
		echo "$location updated to empty<br>";
	}
	else {
		echo "<br>Error updating location:$location";
	}
  } else {
    echo "<br>Error deleting record: " . $conn->error;
  }

  }
}

?>
