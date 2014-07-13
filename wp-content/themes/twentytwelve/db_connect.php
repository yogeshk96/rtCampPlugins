<?php
$mysqli = new mysqli("localhost", "rohit_wrdp13", "C3fQ5egbRwWDxH", "rohit_wrdp13");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>