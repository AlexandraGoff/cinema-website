<?php
/** @var $hn array */
/** @var $un array */
/** @var $pw array */
/** @var $db array */
/** @var $id array */
/** @var $movie array */
/** @var $movId array */
/** @var $id array */
/** @var $movTitle array */
include '../partials/headerLogin.php' ;
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login/');
    exit;
}
/*Connection to DB*/
include_once '../connection/conn.php';
$conn = mysqli_connect($hn, $un, $pw, $db);
$id = $_SESSION['id'];
$movie = $conn->prepare('SELECT m.id, m.m_title FROM theatre.movie m');
$movie->execute();
$movie->store_result();
$movie->bind_result($movId, $movTitle);
?>
<!--ADD A NEW REVIEW -->
<div class="add-review">
    <div class="add-review-form">
        <form action="add.php" method="post" autocomplete="off">
                <h4>Add a Review</h4>
                <input type="hidden" name="fk_user_id" value="<?=$id?>">
                <label for="movie"></label>
                <select name="fk_movie_id" id="movie">
                    <!-- select a movie from dropdown-->
                    <option>SELECT MOVIE</option>
                    <?php while ($movie->fetch()): ?>
                        <option value="<?=$movId?>"><?=$movTitle?></option>
                    <?php endwhile; ?>
                </select>
                <label for="rating">Star Rating - 1 to 5 stars </label>
            <!--rating-->
               <input type="tel" name="rating" id="rating">
              <label for="review">Add your Review</label>
                <textarea rows="10" name="review" id="review"></textarea>

            <!-- Submit Button -->
            <input type="submit" value="Add Review" class="read-button">
        </form>
        <div class="msg"></div>
    </div>
</div>
<script>

</script>
<!-- Script that shows message-->
<script>
    let form = document.querySelector('.register form');
    form.onsubmit = function(event) {
        event.preventDefault();
        let form_data = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);
        xhr.onload = function () {
            document.querySelector('.msg').innerHTML = this.responseText;
        };
        xhr.send(form_data);
    };
</script>

