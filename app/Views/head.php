<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
    <title>
        <?php
            if(isset($title_html)) {
                echo $title_html;
            } else {
                echo 'Improve English Vocabulary';
            }
        ?>
    </title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/node_modules/bootstrap/dist/css/bootstrap.min.css?ver=5.2.3">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/node_modules/bootstrap-icons/font/bootstrap-icons.css?ver=1.10.2">
    <?php
        if ($_SERVER['SERVER_NAME'] != LOCALSERVER) { 
    ?>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/compressed/css/style.css?ver=1.0.0">

    <?php } else { ?>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css?ver=1.0.0">
    <?php 
        } 
    ?>
    <?php
        if(isset($optional_styles)) {
            echo $optional_styles;
        }
    ?>
</head>
<body>
    
