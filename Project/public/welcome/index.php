<?php
/** @var $hn array */
/** @var $un array */
/** @var $pw array */
/** @var $db array */
include_once '../connection/conn.php';
include_once '../partials/headerLogin.php';
/*Welcome Page*/
$conn = mysqli_connect($hn, $un, $pw, $db);
/*Connection to DB*/
$movie = $conn->prepare('SELECT 
       distinct m.id,
      m.m_title,
       m.genre,
       m.m_img_path,
        r.rating
       FROM theatre.movie m
        left join review r on m.id = r.fk_movie_id
        where r.rating > 3
       order by rand() limit 5
      ');
$movie->execute();
$movie->store_result();
$movie->bind_result($id, $title, $genre, $movieImg, $rating);
$slider = $conn->prepare('SELECT 
        m.m_img_path
     FROM theatre.movie m
        ');
$slider->execute();
$slider->store_result();
$slider->bind_result($sliderImg);

/*MOVIE INFORMATION*/
$reviews = $conn->prepare('SELECT 
       m.m_title,
       m.m_img_path,
        r.review,
       r.rating,
       u.username
       FROM theatre.movie m
        left join review r on m.id = r.fk_movie_id
        left join user u on u.id = r.fk_user_id
        order by rand() limit 4
      ');
$reviews->execute();
$reviews->store_result();
$reviews->bind_result($title, $movieImg, $review, $rating, $username);

/*Get Blog Information*/
$blog = $conn->prepare('SELECT 
       id,
        b_title,
        b_description,
        b_img_path
        from theatre.blog
        order by id DESC limit 4
     
      ');
$blog->execute();
$blog->store_result();
$blog->bind_result($bid,$bTitle, $bDesc, $bImgPath);
?>
<main class="home">
    <!-- Thumbnail Slider HTML -->
    <div id="thumbnail-slider">
        <div class="inner">
            <ul>
                <!--Images file sources for the Thumbnail Slider-->
                <li><a class="thumb" href="../images/movies/BillieHoliday.jpg"></a></li>
                <li><a class="thumb" href="../images/movies/nobody.jpg"></a></li>
                <li><a class="thumb" href="../images/movies/invisible_man.jpg"></a></li>
                <li><a class="thumb" href="../images/movies/dolittle.jpg"></a></li>
            </ul>
        </div>
    </div>

    <!-- END OF IMAGE SLIDER HTML -->
</main>

<?php include_once '../partials/footer.php'; ?>
