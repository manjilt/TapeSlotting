<?php
$user = 'root';
$password = 'sdprod01';
$database = 'tapes';
$tapes = $_POST["ImportTapes"];
//$tapes = preg_replace('#\s+#',',',trim($tapes));
$tapeArray = explode("\r\n", $tapes);
$countOfArray = count($tapeArray);
$mysqli = new mysqli("localhost", $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}?>


<button onclick="myFunction()">Print this page</button>

<script>
function myFunction() {
    window.print();
}
</script>
<br>
<br>

<?php




foreach (range(0, $countOfArray-1) as $number) {
  $currentTape = $tapeArray[$number];
  if(strlen($currentTape) != 6){
    echo $currentTape;
    echo "<b>";
    echo "__INVALID TAPE_";
    echo "</b><br>";
  }
  else{
    $currentTape = mysqli_real_escape_string($mysqli,$currentTape);
    $res = $mysqli->query("SELECT Tape, Location FROM tapelocation WHERE Tape ='$currentTape'");
    if ($res->num_rows > 0){
  	  echo "<b>";
  	  echo $currentTape;
  	  echo "</b>";
  	  echo " is already in library <br>";
    }
    else{
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
}
}
?>
