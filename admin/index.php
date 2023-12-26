<?php

include_once 'function.php';
include_once '../php/data.php';

$username = 'admin';
$password = 'FDPSF03mrf40omf0m0350MFFLdflsd';

?>

<style>
    body {
        background-color: #424245 !important;
    }

</style>

<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Admin panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../css/_core.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>

    <?php
        
        session_start();
        
        if(!isset($_SESSION['namelogin']) && !isset($_SESSION['passlogin'])) {
            first_entry();
        } 
        
        if(isset($_POST['login'])) {
            $_SESSION['namelogin'] = htmlspecialchars($_POST['namelogin']);
            $_SESSION['passlogin'] = htmlspecialchars($_POST['passlogin']);
        }
        
        $verification = 0;
        
        if(isset($_SESSION['namelogin']) && isset($_SESSION['passlogin'])) {
            $verification = login_verification(htmlspecialchars($_SESSION['namelogin']), htmlspecialchars($_SESSION['passlogin']), $username, $password);
            if($verification == 1) {
            ?>
    <style>
        .admin-form {
            display: none;
        }

    </style>
    <?php
                logged_in($server, $user, $pass, $dbname);
            } else if($verification == 2) {
                $verification = 0;
                session_destroy();
                header('location: index.php?wrong=yes');
            }
        }
        
        ?>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
