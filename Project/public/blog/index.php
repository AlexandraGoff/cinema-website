<?php
/** @var $hn array */
/** @var $un array */
/** @var $pw array */
/** @var $db array */

/*BLOG PAGE*/
include_once '../partials/headerLogin.php';
$conn = mysqli_connect($hn, $un, $pw, $db);
$stmt = $conn->prepare('SELECT  
       id,
       b.b_title,
       b.b_description,
       b.b_img_path
    FROM theatre.blog b
    order by id DESC ');
$stmt->execute();
$stmt->store_result();
$stmt->bind_result( $bid, $blogTitle, $blogDesc, $blogImg);
?>
<!-- Section that shows the latest blogs-->
    <section class="middle">
        <h2 class="header">LATEST BLOGS</h2>
        <div class="wrapper-grid-blog">
            <?php while ($stmt->fetch()): ?>
                <div class="container-blogs">
                    <!--Title-->
                    <h2 class="blog-card-name"><?=$blogTitle?></h2>
                    <div class="blog-img">
                        <img src="../images/movies/<?=$blogImg?>" alt="">
                    </div>
                        <p class="blog-genre-description"><?=$blogDesc?></p>
                    <button onclick="window.location.href='../blog/blogDetails.php?bid=<?=$bid?>'" class="button-blog"> Read Full Blog</button>

                </div>

            <?php endwhile; ?>
        </div>
    </section>

<?php include_once '../partials/footer.php'; ?>
