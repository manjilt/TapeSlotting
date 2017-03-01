<?php

$inputUser = $_POST["user"];
$inputPassword = $_POST["password"];
$user = 'root';
$password = '';
$database = 'tapeslotting';

$connect = mysql_connect("localhost", $user, $password);
@mysql_select_db($database) or ("Database not found");

$query = "SELECT * FROM `users` WHERE `user`= '$inputUser' AND `password`= '$inputPassword'";

$result = mysql_query($query);

if (mysql_num_rows($result) == 1) {
    echo "hey";
    die();
}
else {
    echo "bye";
    die ("Invalid Username/Password");
}
?>
?>
