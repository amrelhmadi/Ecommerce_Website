<?php

/* How to Connection Data  */


class Database {
 //DB Params
 private $host = 'localhost';
 private $db_name = 'myblog';
 private $username = 'root';
 private $password = '123456';
 private $conn;
}

// DB Connect 
public function connect () {
    $this->conn =null;
    
    try {
        $this->conn = new PDO('mysql:host'.$this->host.';dbname=' . $this->username . $this->password);
        $this->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
    }
    return $this->conn;
}



/* How to Uplode Data  */

// 1- must be conncet to database page by (require or include ) page 

require 'Name of Connect Page';

// 2- make varible Name Message to Know if your prosses done or not 
$message = '';

// 3- Make if condation if you are put input make it varbile and make $sql to insert your information in database 

if(isset ($_POST['name']) && isset($_POST['email'])) {
    // make name Post in varbile 
    $name = $_POST['name'] ;
    $name = $_POST['email'] ;
    $sql = INSERT INTO people (name,email) VALUES(:name, :email )

}







?>

if ($do == 'Manage'){

echo "Welcome to mange page </br>";

echo '<a href="members.php?do=Add">Add New Member</a>';


} elseif ($do == 'Add') { //Add Members Page ?>


<h1 class="text-center">Add New Member</h1>
<div class="container">
<form action="?do=Insert" method="POST">
   
<!-- Start Username Field -->
<div class="form-group row form-group-lg">
    <label class="col-sm-2 control-lable">Username</label>
        <div class="col-sm-10 col-md-4">
            <input type="text" name="username" class="form-control" 
             autocomplete ="off" placeholder="Username To Into Shop" required = "required" >
        </div>
</div> 
<!-- End Username Feild -->
<!-- Start Password Field -->
<div class="form-group row form-group-lg">
    <label class="col-sm-2 control-lable">Password</label>
        <div class="col-sm-10 col-md-4">
            <input type="password" name="password" class="form-control" autocomplete ="new-password" required = "required" placeholder="Password Must Be Hard & Complex ">
        </div>
</div> 
<!-- End Password Feild -->
<!-- Start Email Field -->
<div class="form-group row form-group-lg">
    <label class="col-sm-2 control-lable">Email</label>
        <div class="col-sm-10 col-md-4">    
            <input type="email" name="email" class="form-control" required = "required" placeholder="Email Must be valid">
        </div> 
</div>        
<!-- End Email Feild -->
<!-- Start Full Name Field -->
<div class="form-group row form-group-lg">
    <label class="col-sm-2 control-lable">Full Name</label>
        <div class="col-sm-10 col-md-4">
            <input type="text" name="full" class="form-control" required = "required" placeholder="Full Name Appear In Your Profile Page">
        </div>
</div> 
<!-- End Full Name Feild -->
<!-- Start submit Field -->
<div class="form-group row">
    <div class="col-sm-offset-2 col-sm-10">
        <input  type="submit" value="Add Member" class="btn-primary btn-lg">
    </div>
</div> 
<!-- End submit Feild -->
</form>
</div>    

<?php 

}elseif($do == 'Insert') {

// Insert Member Page


if ($_SERVER['REQUEST_METHOD'] =='POST') {

    //Title of Page

    echo "<h1 class='text-center'>Update Member</h1>";
    echo "<div class='container'>"; 

    //Get Varble from ID

    $user    =$_POST['username'];
    $pass   =$_POST['password'];
    $email  =$_POST['email'];
    $name   =$_POST['full'];

    

    // Validate The Form 

    $formErrors = array ();

    // if Strang <2 & >4 

    if(strlen($user) < 2) { 
        $formErrors[] = '<div class="alert alert-danger"> Username Cant Be <strong> Less Than 2 Characters</strong></div>';
                          }

    if(strlen($user) > 10) {

        $formErrors[] = '<div class="alert alert-danger"> Username Cant Be <strong>more 10 Characters</strong>  </div>';
                           }
    
     
    // Start Validion if any Input Empty 

    if(empty($user)) {

         $formErrors[] = '<div class="alert alert-danger"> Username Cant Be <strong>Empty</strong> </div>';

                    } 
    
    if(empty($name)) {

        $formErrors[] = '<div class="alert alert-danger"> Full Name Cant Be<strong>Empty</strong> </div>';

                    } 
    
    if(empty($email)) {

        $formErrors[] = '<div class="alert alert-danger"> Email Cant Be <strong>Empty</strong> </div>';

                      } 
    // End if any Input Empty 

    //Loop into Erorrs Array And echo It 

    foreach($formErrors as $error) {

          echo $error ;
                                   }

    //Check If there is No Error proceed the Update Operation

    if(empty($formErrors)) {


     // Update The Database With This Info 

    $stmt = $con->prepare('UPDATE users SET Username = ?, Email = ? , FullName = ? , Password = ?  WHERE UserID = ?');
    $stmt->execute(array($user,$email,$name,$pass));


    // Echo Sucess Message

   echo  "<div class='alert alert-success'>" . $stmt->rowCount().''.'Record Updated </div>' ;

                          }

    


}else {

    echo 'Sorry You Cant Browse This page Dirctly';
      }

    echo "</div>";

                    }
         
elseif ($do == 'Edit') {

$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;


// Check if the user exist in database
$stmt = $con->prepare("SELECT * FROM  users WHERE UserID = ? LIMIT 1");

$stmt->execute(array($userid));
$row = $stmt->fetch();
$count = $stmt->rowCount();

if($stmt->rowCount() > 0) { ?>

    <h1 class="text-center">Edit Member</h1>
    <div class="container">
    <form action="?do=Update" method="POST">
        <input type="hidden" name="userid" value="<?php echo $userid ?>" />
    <!-- Start Username Field -->
    <div class="form-group row form-group-lg">
        <label class="col-sm-2 control-lable">Username</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="username" class="form-control" value = "<?php echo $row['Username'] ?>"
                 autocomplete ="off" required = "required" >
            </div>
    </div> 
    <!-- End Username Feild -->
    <!-- Start Password Field -->
    <div class="form-group row form-group-lg">
        <label class="col-sm-2 control-lable">Password</label>
            <div class="col-sm-10 col-md-4">
                <input type="hidden" name="oldpassword" value = "<?php echo $row['Password'] ?>"  >
                <input type="password" name="newpassword" class="form-control" autocomplete ="new-password" >
            </div>
    </div> 
    <!-- End Password Feild -->
    <!-- Start Email Field -->
    <div class="form-group row form-group-lg">
        <label class="col-sm-2 control-lable">Email</label>
            <div class="col-sm-10 col-md-4">    
                <input type="email" name="email" value='<?php echo $row["Email"] ?>' class="form-control" required = "required">
            </div> 
    </div>        
    <!-- End Email Feild -->
    <!-- Start Full Name Field -->
    <div class="form-group row form-group-lg">
        <label class="col-sm-2 control-lable">Full Name</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="full" class="form-control" value ="<?php  echo $row['FullName'] ?>" required = "required">
            </div>
    </div> 
    <!-- End Full Name Feild -->
    <!-- Start submit Field -->
    <div class="form-group row">
        <div class="col-sm-offset-2 col-sm-10">
            <input  type="submit" value="save" class="btn-primary btn-lg">
        </div>
    </div> 
    <!-- End submit Feild -->
    </form>
    </div>    

<?php }else{
    echo "there is no id";
} 
} 

elseif ($do == 'Update') {


echo "<h1 class='text-center'>Update Member</h1>";
echo "<div class='container'>";


if ($_SERVER['REQUEST_METHOD'] =='POST') {

    //Get Varble from ID

    $id     =$_POST['userid'];
    $user   =$_POST['username'];
    $email  =$_POST['email'];
    $name   =$_POST['full'];

    //password trick


    // Condition ? Ture & Fale 

    $pass = empty($_POST['newpassword']) ? $pass = $_POST['oldpassword'] : $pass = sha1($_POST['newpassword']);

    // Validate The Form 

    $formErrors = array ();

    if(strlen($user) < 2) {

        $formErrors[] = '<div class="alert alert-danger"> Username Cant Be <strong> Less Than 2 Characters</strong></div>';
    }

    if(strlen($user) > 10) {

        $formErrors[] = '<div class="alert alert-danger"> Username Cant Be <strong>more 10 Characters</strong>  </div>';
    }
    
    if(empty($user)) {

         $formErrors[] = '<div class="alert alert-danger"> Username Cant Be <strong>Empty</strong> </div>';

    } 
    
    if(empty($name)) {

        $formErrors[] = '<div class="alert alert-danger"> Full Name Cant Be<strong>Empty</strong> </div>';

    } 
    
    if(empty($email)) {

        $formErrors[] = '<div class="alert alert-danger"> Email Cant Be <strong>Empty</strong> </div>';

    } 

    //Loop into Erorrs Array And echo It 

    foreach($formErrors as $error) {

        echo $error ;
    }

    //Check If there is No Error proceed the Update Operation

    if(empty($formErrors)) {


     // Update The Database With This Info 

    $stmt = $con->prepare('UPDATE users SET Username = ?, Email = ? , FullName = ? , Password = ?  WHERE UserID = ?');
    $stmt->execute(array($id,$user,$email,$name,$pass));


    // Echo Sucess Message

   echo  "<div class='alert alert-success'>" . $stmt->rowCount().''.'Record Updated </div>' ;

    }

} 
else {

    echo 'Sorry You Cant Browse This page Dirctly';
}


    echo "</div>";

} // End_Insert