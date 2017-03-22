<?php
$user = 'root';
$password = 'sdprod01';
$database = 'tapes';
$tapes = $_POST["FindTapes"];

$tapeArray = explode("\r\n", $tapes);
$countOfArray = count($tapeArray);
?>


<button onclick="myFunction()">Print this page</button>

<script>
function myFunction() {
    window.print();
}
</script>
<br>
<br>

<?php


$mysqli = new mysqli("localhost", $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

foreach (range(0, $countOfArray-1) as $number) {
  $currentTape = $tapeArray[$number];
  if(strlen($currentTape) != 6){
    echo $currentTape;
    echo "<b>";
    echo "_INVALID TAPE_ ";
    echo "</b><br>";}
  else{
    $res = $mysqli->query("SELECT Tape, Location FROM tapelocation WHERE Tape ='$currentTape'");
    if ($res->num_rows == 0){
  	  echo "<b>";
  	  echo $currentTape;
  	  echo "</b>";
  	  echo " is not in library <br>";
    }
    else{
    $row = $res->fetch_assoc();
    $location = $row['Location'];
    $tape = $row['Tape'];


    echo "<u>";
    echo $tape;
    echo ' ----> ';
    echo $location;
    echo "</u>";
    echo "<br>";
    }
}
}

?>
