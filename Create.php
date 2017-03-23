<?php
$user = 'root';
$password = 'sdprod01';
$database = 'tapes';
$prefix = $_POST["CreatePre"];
$start = $_POST["CreateStart"];
$amount = $_POST["CreateNum"];

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

for ($i = 0; $i < $amount; $i++) {
  $number = (string) $start;
  $tapeName = $prefix . $number;

	echo $tapeName;
  
  
 
}
?>
