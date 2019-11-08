<?php

/* 
===================================================
== Manage Members
== You Can Add | Edit | Delete | Members From Here 
===================================================

*/

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

// Insert ini.php 
    include 'ini.php';

    $do = isset($_GET['do']) ? $do = $_GET['do'] : $do = 'Manage';

    // Start Maanger 
if ($do  == 'Manage') { // Manger Members Page

    $query = '';

    if (isset($_GET['page']) && $_GET['page'] == 'Pending') {
        
        $query = 'And RegStatus = 0';
    }

   





// Select all Users Except Admins
$stmt = $con->prepare("SELECT * FROM users WHERE UserID !=1  $query");
// Execute The statement 
$stmt->execute();
// Assign To Varible
$rows = $stmt->fetchAll()
?>
        
<h1 class="text-center">Mange Members</h1>
    <div class="container">
        <div class="table-responsive">
        <table class="table table-bordered text-center main-table">
        <thead>
            <tr>
                <td>#ID</td>
                <td>Username</td>
                <td>Email</td>
                <td>FullName</td>
                <td>Registerd date</td>
                <td>Control </td>
            </tr>
        </thead>
        <tbody>
<?php

  foreach($rows as $row) {
      echo "<tr>";

      echo "<td>" . $row['UserID'] . "</td>";
      echo "<td>" . $row['Username'] . "</td>";
      echo "<td>" . $row['Email'] . "</td>";
      echo "<td>" . $row['FullName'] . "</td>";
      echo "<td>" . $row['Date'] . "</td>";
      echo '<td class="form-group">

      <a href="members.php?do=Edit&userid='.$row["UserID"].'" class="btn-sm mb-2 btn-success form-control"><i class="fas fa-edit"></i><span class="btn-edit">Edit</span></a>

      <a href="members.php?do=Delete&userid='.$row["UserID"].'"  class="btn-sm btn-danger form-control confirm"><i class="fas fa-trash-alt"></i><span class="btn-delt">Delete</span></a>';

        if ($row['RegStatus'] == 0) {

           echo '<a href="members.php?do=Activate&userid='.$row["UserID"].'"  class="btn-sm btn-info form-control  mt-2"><i class="fas fa-trash-alt"></i><span class="btn-delt"> Activate </span></a>';
            

        }

            echo "</td>";
      
      echo "</tr>";
  }     
        
?>
      
        </tbody>
        </table>
        </div>           
        <a href ="members.php?do=Add" class="btn btn-primary"><i class="fas fa-plus"></i> New Member</a>
    </div>
                

   <?php } elseif ($do =='Add') { // Add Members Page ?>
     
                <h1 class="text-center">Add New Member</h1>
                <div class="container">
                    <form action="?do=Insert" method="POST"  id="add-form" >
                    
                    <!-- Start Username Field -->
                    <label class="col-sm-2 control-lable">Username</label>
                    <div class='form-group col-sm-8 col-md-12'>
                                <input  type="text" name="username" class="any-type form-control " autocomplete ="off"  placeholder = "User Name To Login Into Shop " required = "required">
                    </div>
                    <!-- End Username Feild -->
                    <!-- Start Password Field -->
                    <label class="col-sm-2 control-lable">Password</label>
                    <div class='form-group input-group col-sm-8 col-md-12'>
                            <input type="password" name="password" id="pass" class="form-control" autocomplete ="new-password" placeholder = "Password Must Be Hard & Complex " required = "required" >
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <a href="#" class="text-dark" id="icon-click"><i class="fas fa-eye" id="icon"></i>
                                        <span id="pass-asterisk"></span>
                                   </div>
                                </div>                          
                    </div>
   
                    <!-- End Password Feild -->
                    <!-- Start Email Field -->
                    <label class="col-sm-2 control-lable">Email</label>
                    <div class='form-group col-sm-8 col-md-12 '>
                                <input  type="email" name="email"  class="any-type form-control" placeholder = "Email Must Be valid" autocomplete ="off" required = "required">                            
                    </div>      
                    <!-- End Email Feild -->
                    <!-- Start Full Name Field -->
                    <label class="col-sm-12 control-lable">Full Name</label>
                    <div class='form-group col-sm-8 col-md-12 mb-4'>
                                <input  type="text" name="full" class="any-type form-control"  placeholder = "Full Name Appeair In Your Profile Page" autocomplete ="off" required = "required" >   
                    </div>
                    <!-- End Full Name Feild -->
                    <!-- Start submit Field -->
                    <div class='form-group  col-sm-12'>
                            <input  type="submit" value="Add Member" class="btn-primary btn-block btn-lg rounded-lg" >
                    </div> 
                    <!-- End submit Feild -->
                    </form>
                </div>
               
                                
<?php // End Add Members Page 
    } elseif($do == 'Insert') { // Start Insert Page 
        
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            echo " <h1 class='text-center'>Insert Member</h1>";
            echo '<div class = "container">' ; 
            
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $email = $_POST['email'];
            $name = $_POST['full'];


            $hashpass = sha1( $_POST['password']);

           // Start Validation The Form 

            $formErrors = array();
            // Start User Error 
            if (strlen($user) < 2) {
                $formErrors[] = '<div class = "alert alert-danger"> Username Cant Be <strong>less than 2 charcters</strong></div>' ;
            }
            if (strlen($user) > 20) {
                $formErrors[] = '<div class = "alert alert-danger"> Username Cant Be <strong> More than 20 charcters</strong></div>' ;
            }
            if (empty($user)) {
                $formErrors[] = '<div class = "alert alert-danger"> Username Cant Be <strong> Empty
                </strong></div>' ;
            }
            // End User Error 
            // Start User Error 

            if (empty($pass)) {
                $formErrors[] = '<div class = "alert alert-danger"> Password Cant Be <strong> Empty
                </strong></div>' ;
            }
            // End Password Error 
            // Start Name Error 
            if (empty($name)) {
                $formErrors[] = '<div class = "alert alert-danger">Full Name Cant Be <strong>Empty
                </strong></div>' ;     
            }
            // End Name Error 
            // Start Email Error 
            if (empty($email)) {
                $formErrors[] = '<div class = "alert alert-danger"> Email Cant Be <strong> Empty 
                </strong></div>';
            }
            // End Email Error 

            // Start forecach Loop 
            foreach($formErrors as $error) {
                echo $error ;
            }

            // Start Check if Error Not Empty Make Update 

            if (empty($formErrors)){

                // Check If User Exist in Datebase  
                $check = checkItem("Username", "users" , $user);

                if ($check == 1 ) {
                    $theMsg = '<div class="container">
                    <div class="alert alert-danger">Sorry This User Is Exist</div>';

                    redirectHome($theMsg , 'back');
                    
                    echo '</div>';

                } else {
  
                        $stmt = $con->prepare("INSERT INTO users(Username,Password,Email,FullName,RegStatus,Date) VALUES(:zuser,:zpass,:zmail,:zname, 1 , now())");
                        $stmt->execute(array(
                            'zuser' => $user,
                            'zpass' => $hashpass,
                            'zmail' => $email,
                            'zname' => $name
                        ));   
                        // Insert UserInfo In DateBase
                        echo '<div class="container">';
                        $theMsg = "<div class = 'alert alert-success'>".  $stmt->rowCount() ." Record Inserted </div>";

                        redirectHome($theMsg , 'back') ;
                        echo '</div>';
                    }
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
 }  elseif ($do =='Edit') { // Start Edit Page
    
                $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0 ;
                    
                        
                        // Check if the user exist in Datebase
                        $stmt = $con->prepare("SELECT * FROM  users  WHERE  UserID = ? ");
                    
                    // Do Array for $username,$hashedPass 
                        
                        $stmt->execute(array($userid));
                    
                    // Fetch like Get All varible i Executed in array 
                    
                        $row = $stmt->fetch();
                    
                    // rowCount built in php mean get how much row you have in your table 
                    
                        $count = $stmt->rowCount();

                        if ($count > 0) { ?>

                                        <h1 class="text-center">Edit Member</h1>
                                    <div class="container">
                                    <form action="?do=Update" method="POST" id="add-form">
                                        <!-- Start UserID Field -->
                                        <input type="hidden" name="userid" value="<?php echo $userid ?>" />
                                        <!-- End UserID Field -->
                                    <!-- Start Username Field -->
                                    <div class="form-group row">
                                        <label class="col-sm-2.1 m-auto control-lable">Username</label>
                                            <div class="col-sm-10 col-md-9">
                                                <input type="text" name="username" class="form-control" value = "<?php echo $row['Username'] ?>"
                                                autocomplete ="off" required = "required" >
                                            </div>
                                    </div> 
                                    <!-- End Username Feild  -->
                                    <!-- Start Username Feild -->
                                    <div class="form-group row">
                                        <label class="col-sm-2.1 m-auto control-label">Password</label>
                                        <div class="input-group col-sm-10 col-md-9">
                                                <input type="hidden" name="oldpassword" value = "<?php echo $row['Password'] ?>"  >
                                                <input type="password" name="newpassword" class="form-control input-group" id="pass" autocomplete ="new-password" placeholder = "Leave Blank if youdont want to change" >
                                            <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                    <a href="#" class="text-dark" id="icon-click"><i class="fas fa-eye" id="icon"></i>
                                            </div>
                                                    </div>       
                                            
                                        </div> 
                                    </div> 
                                       
                    
                                    <!-- End Password Feild -->
                                    <!-- Start Email Field -->
                                    <div class="form-group row">
                                        <label class="col-sm-2.1 m-auto control-lable">Email</label>
                                            <div class="col-sm-10 col-md-9">    
                                                <input type="email" name="email" value='<?php echo $row["Email"] ?>' class="form-control" required = "required">
                                            </div> 
                                    </div>        
                                    <!-- End Email Feild -->
                                    <!-- Start Full Name Field -->
                                    <div class="form-group row">
                                        <label class="col-sm-2.1 m-auto control-lable">Full Name</label>
                                            <div class="col-sm-10 col-md-9">
                                                <input type="text" name="full" class="form-control" value ="<?php  echo $row['FullName'] ?>" required = "required">
                                            </div>
                                    </div> 
                                    <!-- End Full Name Feild -->
                                    <!-- Start submit Field -->
                                    
                                    
                                        <div class="form-group">
                                            <input  type="submit" value="save" class="btn btn-primary btn-lg rounded-lg form-control p-0">
                                        </div>
                                    <!-- End submit Feild -->
                                    </form>
                                    </div>    
        
    <?php } else {

            echo ' '.'There Is No Such ID';
    }
      /*  End Edit Page */   } elseif($do == 'Update') { /* Start Update Page */ 
            
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                echo " <h1 class='text-center'>Update Member</h1>";
                echo '<div class = "container">' ; 
                $id = $_POST['userid'];
                $user = $_POST['username'];
                $email = $_POST['email'];
                $name = $_POST['full'];

                // Trike Password 
                $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']) ;
                // Start Validation The Form
                //Error Array 
                $formErrors = array();
                // Start User Error 
                if (strlen($user) < 2) {
                    $formErrors[] = '<div class = "alert alert-danger"> Username Cant Be <strong>less than 2 charcters</strong></div>' ;
                }
                if (strlen($user) > 20) {
                    $formErrors[] = '<div class = "alert alert-danger"> Username Cant Be <strong> More than 20 charcters</strong></div>' ;
                }
                if (empty($user)) {
                    $formErrors[] = '<div class = "alert alert-danger"> Username Cant Be <strong> Empty
                    </strong></div>' ;
                }
                // End User Error 
                // Start Name Error 
                if (empty($name)) {
                    $formErrors[] = '<div class = "alert alert-danger">Full Name Cant Be <strong>Empty
                    </strong></div>' ;     
                }
                // End Name Error 
                // Start Email Error 
                if (empty($email)) {
                    $formErrors[] = '<div class = "alert alert-danger"> Email Cant Be <strong> Empty 
                    </strong></div>';
                }
                // End Email Error 

            /* Start forecach Loop */
                foreach($formErrors as $error) {
                    echo $error ;
                }

                // Start Check if Error Not Empty Make Update 

                if (empty($formErrors)){
                $stmt = $con->prepare("UPDATE users SET Username = ? , Email = ? , FullName = ? , Password = ? WHERE UserID = ?");
                $stmt->execute(array($user,$email,$name,$pass,$id));

                $theMsg = "<div class = 'alert alert-success'>".  $stmt->rowCount() ." Record Update </div>";
                redirectHome($theMsg , 'back' , 4);
            }

                // End Check if Error Not Empty Make Update 


                // End Validation The Form

            } else {
                
                $theMsg = '<div class="container">
                .<div class="alert alert-danger">There Is cant Show You this page dirctly</div>';
                
                redirectHome($theMsg);

            } 

            echo '</div>';

       /* End Update Page */ } elseif ($do == 'Delete') { // Start Delete Page
        
        

        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0 ;
        
        
                      $chek = checkItem('userid' , 'users' , $userid);
                    
                    

                        if ( $chek > 0) { 

                            $stmt = $con->prepare("DELETE FROM users WHERE UserID = :zuser ");
                            //Make Link between ":zuser"& "$userid"
                            $stmt->bindParam(":zuser" , $userid);
                            
                    
                            
                            $stmt->execute();

                           echo '<h1 class="text-center">Delete Members</h1>';
                           echo' <div class="container">';

                            // Insert UserInfo In DateBase
                            $theMsg = "<div class='container'>
                            .<div class = 'alert alert-success'>".  $stmt->rowCount() ." Record Delete </div>
                            ";

                            redirectHome($theMsg);
                            echo '.</div>';
                            
                        } else {
                             $theMsg ='<div class="container"> 
                            .<div class="alert alert-danger">Good This ID Not Is Exist</div>';

                            redirectHome($theMsg);
                            echo '</div>';
                            
                        }

       } elseif ($do == 'Activate') { // Start Activate Page

        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0 ;
        
        
                      $chek = checkItem('userid' , 'users' , $userid);
                    
                    

                        if ( $chek > 0) { 

                            $stmt = $con->prepare("UPDATE users SET RegStatus = 1 WHERE UserID = ?");
                     
                            $stmt->execute(array($userid));

                           echo '<h1 class="text-center">Activate Members</h1>';
                           echo' <div class="container">';

                            // Insert UserInfo In DateBase
                            $theMsg = "<div class='container'>
                            .<div class = 'alert alert-success'>".  $stmt->rowCount() ." Record Updated </div>
                            ";

                            redirectHome($theMsg);
                            echo '.</div>';
                            
                        } else {
                             $theMsg ='<div class="container"> 
                            .<div class="alert alert-danger">Good This ID Not Is Exist</div>';

                            redirectHome($theMsg);
                            echo '</div>';
                            
                        }


       } // End Activate Page
        
    include 'footer.php';
//End Session
} else {   
    header ('Location: index.php');
    exit();
}

/*================================================================================
3-End If Session existing Than Do = A-insert ini.php | B-insert footer.php |  

==================================================================================
if not Existing Than Do = A- go to index.php AND B- Exit
=================================================================================*/
// 1-make varible message to know if edit done or not 

