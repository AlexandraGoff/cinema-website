<?php
/** @var $hn array */
/** @var $un array */
/** @var $pw array */
/** @var $db array */
/** @var $admin array */

/* CHECK if USER is admin. */
$conn = mysqli_connect($hn, $un, $pw, $db);

$stmt = $conn->prepare('SELECT usr.id, usr.is_admin
    FROM theatre.user usr');
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $admin);
$stmt->fetch();