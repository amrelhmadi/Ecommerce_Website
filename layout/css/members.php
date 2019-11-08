<?php
session_start();

if(isset($_SESSION['Username'])) {

   
    include 'ini.php';

$do = '';
if (isset($_GET['do'])) {
    $do = $_GET['do'];
} else {
    $do = 'Manage';
}

if ($do == 'Manage'){

} elseif ($do == 'Edit') {
    echo 'Welcome To Edit Page';
}
    include 'footer.php';
}else {   
    header ('Location: index.php');
    exit();
}

