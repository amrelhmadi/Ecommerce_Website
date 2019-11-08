
<?php
ob_start();

/*==============================================================================================
This Page Check If Your Username True = Include (ini.php) Page OR Fale = Go To (index.php) Page 

==============================================================================================*/

//1-Start Session 
session_start();


//2-Start to Make Title For Page 
$pageTitle = 'Dashboard';
//2-End to Make Title For Page

//3-Start Condition If Username True Than A- Insert ini.php | if not A-Go to index.php | B-Put Text Comment | C-Exit 
if(isset($_SESSION['Username'])) {
    
    include 'ini.php';

/* Start Databoard Page */ 

$latesUsers = 10; //Number of Latest array 

$theLatest = (getLatest("*" , "users" ,"UserID" , $latesUsers));



    ?>
<div class="home-stats text-center">
        <div class="container">
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="stat st-members">
                    Total Members
                    <span><a href="members.php"><?php echo countItems('UserID' , 'users') ?></a></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-pending">
                    Pending Members
                    <a href="members.php?do=Manage&page=Pending"><span><?php echo checkItem('RegStatus' , 'users' , 0) ?></span></a> 
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-items">
                    Total Item
                    <span>1500</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-comments">
                    Total Comments
                    <span>3500</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="latest">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                <div class="card-header">
                    <i class="fas fa-users"></i> Latest <?php echo $latesUsers ?> Registerd Users 
                </div>
                <div class="card-body">
                    <ul class="list-unstyled latest-users">
<?php
                           
    foreach($theLatest as $user) {
    echo '<li>';

    // Start To Write Last Username 
    echo $user["Username"];
    // End To Write Last Username 

    // Start Button Edit
    echo '<a href="members.php?do=Edit&userid='.$user["UserID"].'">';
    echo '<span class="btn btn-success float-right btn-editBox">';
        echo '<i class="fas fa-edit btn-iconEdit"></i><span class="btn-textEdit">Edit</span>';
    echo '</span>';
    echo '</a>';
    // End Button Edit 

    if ($user['RegStatus'] == 0) {

        echo '<a href="members.php?do=Activate&userid='.$user["UserID"].'">';
        echo '<span class="btn-sm btn-info form-control float-right mr-1 btn-deltBox">';
        echo '<i class="fas fa-trash-alt btn-iconDelt"></i><span class="btn-textDelt"> Activate </span>';
        echo '</span>';
        echo '</a>';
         

     }



    

    echo '</li>';
    }


?>
                    </ul>
                </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                <div class="card-header">
                    <i class="fas fa-tag"></i> Latest Items
                </div>
                <div class="card-body">
                  test
                </div>
                </div>
            </div>
        </div>   
    </div>
</div>


<?php

/* End Databoard Page */ 

    include 'footer.php'; 

} elseif(!$_SESSION['Username']) {
    echo 'Sorry your username is Not Correct ';

    
    /*
    $result=mysql_query("SELECT * FROM users WHERE user=$user AND password=$pass");
    $row=mysql_fetch_array($result);
    if(mysql_num_row($result) > 0 ) {
        $_SESSION['username'] = $row[0];
        $_SESSION['password'] = $row[1];
    */
        
    } else  {
       header ('Location: index.php?error=1');
}
//3-End Condition If Username True Than A- Insert ini.php | if not A-Go to index.php | B-Put Text Comment | C-Exit 

ob_end_flush();








