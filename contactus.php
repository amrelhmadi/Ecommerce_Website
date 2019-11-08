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
$pageTitle ='Contact Us';
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

    if (isset($_POST['submit'])) {
        $name       = $_POST['name'];
        $subject    = $_POST['subject'];
        $mailFrom   = $_POST['mailFrom'];
        $mailFrom   = $_POST['mail'];
        $message    = $_POST['message'];
    
        $mailTo  = "amralhmady33@yahoo.com";
        $headers = "From: ".$mailFrom;
        $txt     = "You have received an e-mail from ".$name.".\n.\n".$message;
    
        mail($mailTo,$subject,$txt,$headers);
        header("Location: dashbord.php?mailsend");
    }
?>
    <form action="contactus.php" method="POST">

    <input type="text" name="name" placeholder="Full Name">
    <input type="mail" name="mail" placeholder="Your e-mail">
    <input type="text" name="subject" placeholder="Subject">
    <textarea name="message" placeholder="Message"></textarea>
    <button type="submit" name="submit">SEND MAIL</button>
    
</form>

<?php
     
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
