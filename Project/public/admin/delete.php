<?php
/** @var $hn array */
/** @var $un array */
/** @var $pw array */
/** @var $db array */
/** @var $uid array */
/** @var $cName array */
/** @var $usrName array */


require_once '../connection/conn.php';
/*Connection to DB*/
$conn = mysqli_connect($hn, $un, $pw, $db);
$uid = $_GET['uid'];
$rid = $_GET['rid'];

/* Delete Review*/
$stmt = $conn->prepare('DELETE FROM review where id = '.$rid.'  and fk_user_id = '.$uid.'  ');

$stmt->bind_param('i', $_GET['uid']);
$stmt->execute();
header('Location: index.php');
exit;








