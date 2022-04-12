<?php
/** @var $hn array */
/** @var $un array */
/** @var $pw array */
/** @var $db array */
include_once '../partials/headerLogin.php';

/*MOVIE PAGE*/

$conn = mysqli_connect($hn, $un, $pw, $db);
$stmt = $conn->prepare('SELECT 
       distinct (m.id), 
       m.m_title,
       m.genre,
       m.m_img_path
    FROM theatre.movie m
    order by id DESC ');
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $title, $genre, $movieImg);
$stmt->fetch();

?>

<!-- Containers for the movies page -->
    <section class="middle">
        <h2 class="header">Movies</h2>
        <div class="wrapper-grid-movies">
            <?php while ($stmt->fetch()): ?>
                <div class="container-movies" class="<?= $genre ?>">
                    <!-- Name -->
                    <h4 class="movie-name-card"><?= $title ?></h4>
                    <img src="../images/movies/<?= $movieImg ?>" alt="">
                    <!-- Genre -->
                    <p class="movie-genre-description"><?= $genre ?></p>
                    <a href="../movies/details.php?id=<?=$id?>"><button class="button-view">View Movie</button></a>
                </div>
            <?php endwhile; ?>
        </div>

    </section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    //filter for movies - Genre - stars -
        $(document).ready(function(){
            $("#hide").click(function(){
                $("p").hide();
            });
            $("#show").click(function(){
            $("p").show();
        });
    });

</script>
<?php include_once '../partials/footer.php'; ?>
