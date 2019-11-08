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
$pageTitle ='Items';
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

   echo 'Welcome To Items Page';
        
} elseif ($do =='Add') { 

    // Add Members Page ?>
     
     <h1 class="text-center">Add New Item</h1>
                <div class="container Space-boutton-itemPage">
                    <form action="?do=Insert" method="POST"  id="add-form" >
                    
                    <!-- Start Name Field -->
                    <label class="col-sm-2 control-lable">Name</label>
                    <div class='form-group col-sm-8 col-md-12'>
                                <input  type="text" name="name" class="form-control "  placeholder = "Name Of The Item " />
                    </div>
                    <!-- End Name Feild --> 
                    <!-- Start Description Field -->
                    <label class="col-sm-2 control-lable">Description</label>
                    <div class='form-group col-sm-8 col-md-12'>
                                <input  type="text" name="description" class="form-control "  placeholder = "Description Of The Item " />
                    </div>
                    <!-- End Description Feild -->
                    <!-- Start Price Field -->
                    <label class="col-sm-2 control-lable">Price</label>
                    <div class='form-group col-sm-8 col-md-12'>
                                <input  type="text" name="price" class="form-control "  placeholder = "Description Of The Item " />
                    </div>
                    <!-- End Price Feild -->
                    <!-- Start Country Field -->
                    <label class="col-sm-2 control-lable">Country</label>
                    <div class='form-group col-sm-8 col-md-12'>
                                <input  type="text" name="country" class="form-control "  placeholder = "Country of Made " />
                    </div>
                    <!-- End Country Feild -->
                    <!-- Start Status Field -->
                    <label class="col-sm-2 control-lable">Status</label>
                    <div class='form-group col-sm-8 col-md-12'>
                        <select name="status"> 
                            <option value="0">...</option>
                            <option value="1">New</option>
                            <option value="2">Like New</option>
                            <option value="3">Used</option>
                            <option value="4">Very Old</option>
                        </select>
                    </div>
                    <!-- End Status Feild -->
                    <!-- Start Member Field -->
                    <label class="col-sm-2 control-lable">Member</label>
                    <div class='form-group col-sm-8 col-md-12'>
                        <select name="member"> 
                            <option value="0">...</option>
                            <?php 
                                $stmt = $con->prepare("SELECT * FROM users");
                                $stmt->execute();
                                $users = $stmt->fetchAll();
                                foreach ($users as $user) {
                                    echo "<option value='".$user['UserID']."'> ".$user['Username']." </option>";
                                }
                            ?>
                        </select>
                    </div>
                    <!-- End Member Feild -->
                    <!-- Start Category Field -->
                    <label class="col-sm-2 control-lable">Category</label>
                    <div class='form-group col-sm-8 col-md-12'>
                        <select name="category"> 
                            <option value="0">...</option>
                            <?php 
                                $stmt2 = $con->prepare("SELECT * FROM categories");
                                $stmt2->execute();
                                $cats = $stmt2->fetchAll();
                                foreach ($cats as $cat) {
                                    echo "<option value='".$cat['ID']."'> ".$cat['Name']." </option>";
                                }
                            ?>
                        </select>
                    </div>
                    <!-- End Category Feild -->
                   
                    <!-- Start submit Field -->
                    <div class='form-group  col-sm-12'>
                            <input  type="submit" value="Add Item" class="btn-primary btn-block btn-lg rounded-lg" >
                    </div> 
                    <!-- End submit Feild -->
                    </form>
                </div>
               
                                
<?php // End Add Item Page 
       
       
} elseif($do == 'Insert') { 
// Start Insert Page 
        
        
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    echo " <h1 class='text-center'>Insert Item</h1>";
    echo '<div class = "container">' ; 
    
    $name       = $_POST['name'];
    $desc       = $_POST['description'];
    $price      = $_POST['price'];
    $country    = $_POST['country'];
    $status     = $_POST['status'];
    $member     = $_POST['member'];
    $cat        = $_POST['category'];



   // Start Validation The Form 

    $formErrors = array();

    // Start Name Error 
  
    if (empty($name)) {

        $formErrors[] = '<div class = "alert alert-danger"> Name Can\'t Be <strong> Empty
        </strong></div>' ;
    }
    // End Name Error 
    // Start Description Error 

    if (empty($desc)) {
        $formErrors[] = '<div class = "alert alert-danger"> Description Can\'t Be <strong> Empty
        </strong></div>' ;
    }
    // End Description Error 
    // Start Price Error 
    if (empty($price)) {
        $formErrors[] = '<div class = "alert alert-danger"> Price Can\'t Be <strong>Empty
        </strong></div>' ;     
    }
    // End Price Error 
    // Start Country Error 
    if (empty($country)) {
        $formErrors[] = '<div class = "alert alert-danger"> Country Can\'t Be <strong> Empty 
        </strong></div>';
    }
    // End Country Error 
    // Start Satatus Error 
    if ($status == 0) {
        $formErrors[] = '<div class = "alert alert-danger"> You Must Be Choose The <strong> Status 
        </strong></div>';
    }
    if ($member == 0) {
        $formErrors[] = '<div class = "alert alert-danger"> You Must Be Choose The <strong> Member 
        </strong></div>';
    }
    if ($cat == 0) {
        $formErrors[] = '<div class = "alert alert-danger"> You Must Be Choose The <strong> Category 
        </strong></div>';
    }
    // End Satatus Error 
   
    // Start forecach Loop 
    foreach($formErrors as $error) {
        echo $error ;
  
    }

    // Start Check if Error Not Empty Make Update 

    if (empty($formErrors)){

        $stmt = $con->prepare("INSERT INTO 
        items
        (Name,Description,Price,Country_Made,Status,Add_Date,Cat_ID,Member_ID) 
        VALUES
        (:zname,:zdesc,:zprice,:zcountry,:zstatus,now(),:zcat,:zmember)");
        $stmt->execute(array(
            'zname'     => $name,
            'zdesc'     => $desc,
            'zprice'    => $price,
            'zcountry'  => $country,
            'zstatus'   => $status,
            'zcat'      => $cat,
            'zmember'   => $member
                             ));   
        // Insert UserInfo In DataBase
        echo '<div class="container">';
        $theMsg = "<div class = 'alert alert-success'>".  $stmt->rowCount() ." Record Inserted </div>";

        redirectHome($theMsg , 'back') ;
        echo '</div>';
            
                         }
    // End Check if Error Not Empty Make Update 


    // End ValidatioFn The Form

} else {
    echo '<div class="container">';
  $theMsg = '<div class="alert alert-danger">Sorry You Can Browse This Page Directly</div>';

    redirectHome($theMsg);
    echo '</div>';
} 

echo '</div>';




// End Insert Page 

}  elseif ($do =='Edit') { 


} elseif($do == 'Update') { 


} elseif ($do == 'Delete') { 


} elseif ($do == 'Approve') {


} 
        
include 'footer.php';

//End Session

} else {   

    header ('Location: index.php');
    exit();
}
ob_end_flush();

?>
