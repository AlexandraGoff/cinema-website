<?php
/** @var $hn array */
/** @var $un array */
/** @var $pw array */
/** @var $db array */
/** @var $id array */
/** @var $title array */
/** @var $fk_movie */
/** @var $movieImg */
require_once '../connection/conn.php';
include_once '../partials/headerLogin.php';
/* Connection to database */
$conn = mysqli_connect($hn, $un, $pw, $db);
$stmt = $conn->prepare('SELECT 
       m_title,
       m.genre,
       m.release_date,
       m.show_date,
       m.m_img_path,
        r.review,
       r.rating,
       u.username,
       r.fk_movie_id,
       r.fk_user_id
       FROM theatre.movie m

        left join review r on m.id = r.fk_movie_id
        left join user u on u.id = r.fk_user_id
        where u.is_active = 1
        order by r.id DESC 
       ');

$stmt->execute();
$stmt->store_result();
$stmt->bind_result( $title,$genre, $release, $aired, $movieImg, $review, $rating, $username, $fk_movie, $fk_user);
$stmt->fetch();
?>
<!-- REVIEWS PAGE -->

    <section class="middle">
        <h2 class="header">Reviews</h2>
        <!-- If no reviews have been added, then show message -->
        <?php if ($stmt->num_rows == 0): ?>
            <h2>No Reviews have been added yet, please check back later</h2>
        <?php else: ?>
        <!-- Fetching movie review info from DB-->
        <?php while ($stmt->fetch()): ?>
        <div class="movie-review">
            <div class="movie-review-img">
                <img src="../images/movies/<?= $movieImg ?>" alt="">
            </div>
                <div class="reviews-wrapper">
                    <div class="reviews">
                        <h3><?= $title ?></h3>
                        <!-- show all reviews here-->
                        <div class="review-inner">
                            <p>
                                <?= $rating ?> <i class="far fa-star"></i>
                            </p>
                            <p><?= $username ?></p>
                        </div>
                        <div class="review-text">
                            <p><?= $review ?></p>
                        </div>
                    </div>
                </div>
        </div>
            <?php endwhile;?>
        <?php endif; ?>
    </section>



<?php include_once '../partials/footer.php'; ?>
