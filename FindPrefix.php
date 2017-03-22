<?php
$user = 'root';
$password = 'sdprod01';
$database = 'tapes';
$prefixes = $_POST["FindPreTapes"];

$prefixArray = explode(",", $prefixes);
$countOfArray = count($prefixArray);
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
  $currentPre = $prefixArray[$number];
  $res = $mysqli->query("SELECT Tape, Location FROM tapelocation WHERE Tape LIKE '$currentPre%'");
  if ($res->num_rows == 0){
	  echo "<b>";
	  echo $currentPre;
	  echo "</b>";
	  echo " is not in library <br>";
  }
  else{

  while($row = $res->fetch_assoc()){
   echo $row['Tape'];
   echo " ----> ";
   echo $row['Location'];
   echo "<br><br>";
  }

  }
}

?>
