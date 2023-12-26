<?php include_once 'php/change.php'; ?>
<?php include_once 'php/data.php'; ?>
<?php include_once 'php/function.php'; ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <title><?php print($_title); ?></title>
    <link rel="shortcut icon" href="<?php print($_icon); ?>" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="description" content="Levstore. Качественная техника Apple в Екатеринбурге с доставкой">
    <meta name="keywords" content="Levstore, Apple, Airpods, Airpods Pro, Чехлы, MagSafe, Iphone">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/_core.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body class="parallax">
    <?php include_once 'php/header.php'; ?>
    <?php include_once 'php/about.php'; ?>
    <?php include_once 'php/catalog.php'; ?>
    <?php include_once 'php/reviews.php'; ?>
    <?php include_once 'php/questions.php'; ?>
    <?php include_once 'php/contacts.php'; ?>
    <?php include_once 'php/footer.php'; ?>
    
    <script src="js/parallax.js"></script>
    <script src="js/margincatalog.js"></script>
    <script src = "js/pattern_tel.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- 2GIS -->
    <script src="https://maps.api.2gis.ru/2.0/loader.js?pkg=full"></script>
    <?php include_once 'js/map.php'; ?>
</body>

</html>