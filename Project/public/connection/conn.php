<?php
// Change this to your connection info.
session_start();
$hn = 'localhost';
$un = 'homestead';
$pw = 'secret';
$db = 'theatre';


// Try and connect using the info above.
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}