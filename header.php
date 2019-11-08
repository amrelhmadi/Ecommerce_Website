<!--==========================================================================

This page Put All (css & Bootstrap File) In html <head> By Use <link>

==========================================================================-->

<!DOCTYPE html>
    <head>
    
<!-- 1- Start Choose Style to write Arabic & Another Language  -->
        <meta charset="UTF-8"/>
<!-- 1- End Choose Style to write Arabic & Another Language  -->

<!-- 2- Start Put Function To get Title Name From (function.php) Page  -->
        <title><?php getTitle() ?></title>
<!-- 2- End Put Function To get Title Name From (function.php) Page  -->

<!-- 3- Start Put All (css & Bootstrap File) -->
        <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.min.css ">
        <link rel="stylesheet" href="<?php echo $css; ?>all.css">
        <link rel="stylesheet" href="<?php echo $css; ?>jquery-ui.css">
        <link rel="stylesheet" href="<?php echo $css; ?>jquery.selectBoxIt.css">
        <link rel="stylesheet" href="<?php echo $css; ?>backend.css">
<!-- 3- End Put All (css & Bootstrap File) -->
    </head>
    <body>
    