<?php
if (!isset($_GET['v'])) {
    $_GET['v'] = 'home';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS -->
    <?php
    if ($_SERVER['REMOTE_ADDR'] != '::1') { ?>
        <!-- Animate CSS -->
        <link rel="stylesheet" href="css/animate.min.css" />
    <?php }
    ?>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap-rtl.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- owl -->
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/owl.theme.default.min.css" />
    <!-- othres CSS -->
    <link rel="stylesheet" href="css/slick.css" />
    <link rel="stylesheet" href="css/magnific-popup.css" />
    <link rel="stylesheet" href="css/slick-theme.css" />

    <!-- custome css  -->
    <link rel="stylesheet" href="stylesheets/style2.css" />
    <link rel="stylesheet" href="stylesheets/style.css" />
    <title>Hamed store web</title>
</head>


<body class=" px-0 ">

    <?php include_once 'views/partial/header.php'; ?>


    <?php include_once 'views/' . $_GET['v'] . '.php'; ?>

    <?php include_once 'views/partial/footer.php'; ?>



    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/magnific-popup.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/slick.js"></script>
    <script src="js/parallax.js"></script>
    <script src="js/paraxify.js"></script>
    <script src="js/countdown.js"></script>
    <script src="js/scrollup.js"></script>
    <script src="js/images-loaded.js"></script>
    <script src="js/easyzoom.js"></script>
    <script src="js/sticky-sidebar.js"></script>
    <!-- Main JS -->
    <script src="js/main.js"></script>
</body>

</html>