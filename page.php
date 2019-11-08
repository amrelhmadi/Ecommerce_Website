<?php 



$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';


if ($do == 'Manage') {
    echo 'Welcome You Are In Manage Catagory Page';
    echo '<a herf="?do=Insert">Add New Category</a>' ;
} elseif ($do == 'Add' ) {
    echo 'Welcome You Are In Add Catagory Page';
    
} elseif ($do == 'Insert') {
    echo 'Welcome You Are In Insert Category';
}else {
    echo 'Error There\'s No Page With This Name';
}





