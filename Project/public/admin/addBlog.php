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
elseif ($_SESSION['is_admin'] == 0) {
    header('Location: ../login/');
    exit;
}
include_once '../connection/conn.php';
$conn = mysqli_connect($hn, $un, $pw, $db);
$movie = $conn->prepare('SELECT m.id, m.m_title, m.m_img_path FROM theatre.movie m');
$movie->execute();
$movie->store_result();
$movie->bind_result($movId, $movTitle, $movImg);
?>

<!-- FORM that lets Admin add a new Blog-->
    <div class="blog-wrapper">
        <section class="add-blog-form"
        <form action="blog.php" method="post" autocomplete="off">
            <h4 class="header-add">Add a blog</h4>
            <label for="title"></label>
            <input type="text" name="b_title" id="title" required>
            <label for="movie"></label>
            <select name="b_img_path" id="movie">
                <!-- Select a movie image and fetch it from DB-->
                <option>Select Movie Image</option>
                <?php while ($movie->fetch()): ?>
                    <option value="<?=$movImg?>"><?=$movTitle?></option>
                <?php endwhile; ?>
            </select>
            <textarea rows="10" name="b_description" id="review"></textarea>


            <input type="submit" class="submit-button" value="Add your blog">
        </form>
        <div class="msg"></div>
    </section>
    </div>

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

