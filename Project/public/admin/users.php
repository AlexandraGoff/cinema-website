<?php
/** @var $hn array */
/** @var $un array */
/** @var $pw array */
/** @var $db array */
/** @var $id array */
/** @var $title array */
/** @var $fk_movie */
/** @var $movieImg */
include_once '../partials/headerLogin.php';
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login/');
    exit;
}
require_once '../connection/conn.php';
/*Connection to DB*/
$conn = mysqli_connect($hn, $un, $pw, $db);
$stmt = $conn->prepare('SELECT 
       u.id,
       u.username,
       u.email,
       u.is_active
     
       FROM theatre.user u
        order by u.id desc ');


$stmt->execute();
$stmt->store_result();
$stmt->bind_result( $uid, $username, $email, $active);
$stmt->fetch();
?>
<!-- Section that shows all users -->
    <main class="users">
        <h2>Hi, <?=$_SESSION['name']?>! You are viewing all users</h2>
        <?php if ($stmt->num_rows == 0): ?>
            <h2>There are no users yet</h2>
        <?php else: ?>
        <div class="wrapper-grid">
            <?php while ($stmt->fetch()): ?>
            <div class="users-container" id="<?=$uid?>">
                <img src="https://st3.depositphotos.com/4111759/13425/v/600/depositphotos_134255634-stock-illustration-avatar-icon-male-profile-gray.jpg" alt="profile-image" class="profile-img">
                <h1 class="name">
                    <?=$username?>
                </h1>
                <p class="description"><?=$email?></p>
                <!-- Activate or Inactivate a user-->
                <?php if($active == 0){
                    echo'<p class="description">User is inactive and reviews have been removed, click below to activate user</p>
                    <a href="activateUser.php?uid='.$uid.'" title="Activate"><button class="button" style="background: #d6cba7;">Deactivated</button></a>';
                }
                else{
                    echo '<p class="description">User is active and reviews are visible, click below to deactivate user</p>
                    <a href="deactivateUser.php?uid=' . $uid . '" title="Deactivate"><button class="button" style="background: #FFDF6C;">Active</button></a>';
                }
                ?>
            </div>
            <?php endwhile; ?>
        </div>

        <?php endif; ?>


    </main>

