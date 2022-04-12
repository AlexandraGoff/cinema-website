<?php
/** @var $hn array */
/** @var $un array */
/** @var $pw array */
/** @var $db array */
/** @var $id array */
/** @var $title array */
/** @var $fk_movie */
/** @var $movieImg */

/* USERS PAGE*/
include_once '../partials/headerLogin.php';
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login/');
    exit;
}
/*Database connection*/
require_once '../connection/conn.php';
$id = $_SESSION['id'];
$conn = mysqli_connect($hn, $un, $pw, $db);
$stmt = $conn->prepare('SELECT 
       m_title,
       m.genre,
       m.release_date,
       m.show_date,
       m.m_img_path,
       r.id,
        r.review,
       r.rating,
       u.username,
       u.id,
       u.is_active,
       r.fk_movie_id,
       r.fk_user_id
       FROM theatre.movie m

        left join review r on m.id = r.fk_movie_id
        left join user u on u.id = r.fk_user_id
        where u.id = '.$id.'
        order by r.id desc');


$stmt->execute();
$stmt->store_result();
$stmt->bind_result( $title,$genre, $release, $aired, $movieImg, $rid, $review, $rating, $username, $uid, $active, $fk_movie, $fk_user);


$activeUser = $conn->prepare('SELECT 
    is_active
    from theatre.user
    where user.id = '.$id.' ');
$activeUser->execute();
$activeUser->store_result();
$activeUser->bind_result($active);
$activeUser->fetch();
?>
<!-- Welcome message for user, that shows them their current reviews-->
    <main class="user-home">
        <div class="wrapper-user">
            <h2 class="welcome-description">Welcome, <?= $_SESSION['name'] ?>! Your current reviews:</h2>
        </div>
        <!-- Button that allows user to add a review -->
            <button onclick="location.href='addReview.php?id=<?=$uid?>&name=<?=$_SESSION['name']?>'" class="read-button">Add a Review</button>
            <!-- If user is active, show the deactivate button -->
            <!-- If user is inactive, show the activate button -->
        <?php if($active == 1){
                echo'<a href="deactivateUser.php?id='.$id .'" class="deactivate">De-activate Account</a>';
            }
            elseif($active == 0){
                echo'<a href="activateUser.php?id='.$id .'" class="activate">Activate Account</a>';
            }
            ?>


        <!--SECTION THAT SHOWS ALL USER REVIEWS-->
        <div class="user-review-wrapper">

        <?php if ($stmt->num_rows == 0): ?>
            <h2 class="no-reviews">You have not added any reviews yet!</h2>
        <?php else: ?>
        <?php while ($stmt->fetch()): ?>
            <div class="user-review">
                <h4 class="title">
                    <?=$title?> - Submitted by <?= $username ?>
                </h4>
                <div class="review-inner">
                    <div class="img">
                        <img src="../images/movies/<?= $movieImg ?>" alt="" class="review-img">
                    </div>
                    <div class="review-text">
                        <?=$review?>
                    </div>
                </div>
                <div class="edit-options">
                    <ul>
                        <!-- review id will be added to the end of this -->
                        <li onclick="location.href='editReview.php?rid=<?=$rid?>&id=<?=$id?>'"><i class="fas fa-user-edit"></i></li>
                        <li onclick="location.href='deleteReview.php?rid=<?=$rid?>&id=<?=$id?>'" title="Delete User"><i class="far fa-trash-alt"></i></li>
                    </ul>
                </div>
            </div>

            <?php endwhile; ?>
        <?php endif; ?>
        </div>
    </main>
<!-- END OF REVIEWS-->
