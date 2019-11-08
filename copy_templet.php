<?php

/* 
===================================================
== Manage Members
== You Can Add | Edit | Delete | Members From Here 
===================================================

*/

ob_start(); //out buffering start

// 1-Start Session 
session_start();
// 1-End Session 

//2-Start to Make Title Name
$pageTitle ='Member';
//2-Start to Make Title Name

/*================================================================================
3-Start If Session existing Than Do = A-insert ini.php | B-insert footer.php |  

==================================================================================
if not Existing Than Do = A- go to index.php AND B- Exit
=================================================================================*/

if(isset($_SESSION['Username'])) {

include 'ini.php';

$do = isset($_GET['do']) ? $do = $_GET['do'] : $do = 'Manage';

   
if ($do  == 'Manage') {  

   
        
} elseif ($do =='Add') { 
       
       
} elseif($do == 'Insert') { 


}  elseif ($do =='Edit') { 


} elseif($do == 'Update') { 


} elseif ($do == 'Delete') { 


} elseif ($do == 'Activate') {


} 
        
include 'footer.php';

//End Session

} else {   

    header ('Location: index.php');
    exit();
}
ob_end_flush();

?>
