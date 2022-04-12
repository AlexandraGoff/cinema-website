
<?php
/** @var $stmt array */
/** @var $movieImg array */
/** @var $hn array */
/** @var $un array */
/** @var $pw array */
/** @var $db array */
include_once '../connection/conn.php';
$conn = mysqli_connect($hn, $un, $pw, $db);
/*THUMBNAIL SLIDER CODE*/
$slider = $conn->prepare('SELECT 
        m.m_img_path
     FROM theatre.movie m
        ');
$slider->execute();
$slider->store_result();
$slider->bind_result($sliderImg);
?>
    <!-- start of image slider -->
    <div id="thumbnail-slider" style="color: transparent !important;">
        <div class="inner">
            <ul>
                <?php while ($slider->fetch()): ?>
                <li>
                    <a class="thumb" href="../images/movies/<?= $sliderImg ?>"></a>
                </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>


