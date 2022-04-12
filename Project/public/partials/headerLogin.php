<!doctype html>
<html lang="en">
<head>
    <?php

    define('ROOT_DIR', 'http://192.168.10.10/theatre/Project/public/');
    ?>
    <!-- HEAD that contains links to stylesheet and fonts-->
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#000">
    <script src="https://kit.fontawesome.com/18398d078f.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/Navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/script.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <!-- external links for the JS slider -->
    <link href="../thumbnailSlider/2/thumbnail-slider.css" rel="stylesheet" type="text/css" />
    <script src="../thumbnailSlider/2/thumbnail-slider.js" type="text/javascript"></script>
    <script src="../js/touch.js"></script>
    <title>Movie Theatre</title>
</head>
<body>

<!-- Navbar with LOGO image-->
<nav class = "navbar">
        <div class="logo">
            <img src="../images/Cineon2.png" alt="Cineon Logo">
        </div>


    <?php
    /** @var $hn array */
    /** @var $un array */
    /** @var $pw array */
    /** @var $db array */
    /** @var $admin array */
    include_once "../connection/conn.php";

    //cookie to save name for 24hours

    $conn = mysqli_connect($hn, $un, $pw, $db);
/*Connection to DB and fetching user information*/
    $stmt = $conn->prepare('SELECT usr.id, usr.is_admin
    FROM theatre.user usr');
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $admin);
    $stmt->fetch();

/*MENU IN THE NAVIGATION BAR*/
    if (!isset($_SESSION['loggedin'])) {
        echo '<ul class="nav-links">
<!--  Link-Effect that underlines menu items is applied to every li value -->
        <li><a href="../welcome/index.php" class = "link-effect">Home</a></li> 
     <li><a href="../movies/index.php" class = "link-effect">Movies</a></li>
    <li><a href="../blog/index.php" class = "link-effect">Blog</a></li>
    <li><a href="../reviews/index.php" class = "link-effect">Reviews</a></li>
    <li><a href="../contact/index.php" class = "link-effect">Contact</a></li>
     <li><a href="../login/index.php"><i class="far fa-user-circle" title="LOGIN/REGISTER"></i></a></li>

    </ul>';
    } else {
        echo '<ul class="nav-links">';
        /*IF USER IS ADMIN, SHOW ADMIN MENU ITEMS*/
        if ($_SESSION['is_admin'] == 1) {
            echo '<li><a href="../admin/index.php" class = "link-effect">Admin</a></li>';
            echo '<li><a href="../admin/users.php" class = "link-effect">Users</a></li>';
            echo '<li><a href="../admin/addBlog.php" class = "link-effect">Add</a></li>';
            /*IF USER IS NOT ADMIN, SHOW HOME */
        } elseif ($_SESSION['is_admin'] == 0) {
            echo '<li><a href="../user/index.php" class = "link-effect">Home</a></li>';
        }
        /*For everyone else show these menu items: */
        echo '<li><a href="../movies/index.php" class = "link-effect">Movies</a></li>
                <li><a href="../blog/index.php" class = "link-effect">Blog</a></li>
                <li><a href="../reviews/index.php" class = "link-effect">reviews</a></li>
                    <li><a href="../contact/index.php" class = "link-effect">Contact</a></li>
                <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i></a></li>
        </ul>';

    }
    ?>
<!-- Burger Menu divs -->
    <div class = "burger">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
    </div>

</nav>
<!--END OF NAVBAR-->

<!-- Importing scriptNav.js -->
<script src="../js/scriptNav.js"></script>
