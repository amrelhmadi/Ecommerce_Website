
<?php

/*===================================================================




===================================================================*/

//for change page to dashboard.php if you are regeisted

//1-Start Session 
session_start();
//1-End Session 

//2-Start To Make Title For You Current Page 
$pageTitle = 'Login';
//2-End To Make Title For You Current Page 

//3-Start To Make (Navbar) Invisible in Login Page 
$noNavbar = '';
//3-End To Make (Navbar) Invisible in Login Page 


//4-Start Condition If Username True Than Go To (dashbar.php) Page 
if(isset($_SESSION['Username'])) {
    header('Location: dashboard.php');}

//4-End Condition If Username True Than Go To (dashbar.php) Page 

/* 5- Start include Many File Page :
    A-1-include (connert.php) To Make Your Page "Connect With Database" BY PDO 
    A-2-Function To Put Title Name 'Default' If Do not Put Any Tile in Code 
    A-3-include This page Make Function To Convert "Language" By Array (Key => Value)  
    A-4-This page Put All (css & Bootstrap File) In html "head" Tag By Use "link" Tag
B-This Page defining Your Pathes ($css,$js,$lang)
C-Make Function To Make (Navbar) Visable or Not By Wirte ($noNavbar='') Varble */ 

include 'ini.php'; 

//5- End include Many File Page

//6 - Start Condition if your SESSION IS "POST" Mean Correct THAN Make user , pass & hashedpass in Varible  after that SELECT COLUMNS like 'UserID,Username,Password' ((where like If )) ((LIMIT mean SELECT Just one row  in Your TAble ))


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $hashedPass = sha1($password);

   
    
    // Check if the user exist in database
    $stmt = $con->prepare("SELECT
                             UserID,Username,Password
                         FROM 
                            users 
                         WHERE 
                            Username = ?
                         AND
                            Password = ? 
                         AND
                            GroupID= 1 
                        LIMIT 1");

// Do Array for $username,$hashedPass 
    
    $stmt->execute(array($username,$hashedPass));

// Fetch like Get All varible i Executed in array 

    $row = $stmt->fetch();

// rowCount built in php mean get how much row you have in your table 
 
    $count = $stmt->rowCount();

    
    
// if count >0 this database contain record this is username 
if ($count>0) {
    $_SESSION['Username']= $row['Username']; // RE Session UserName
    $_SESSION['ID']= $row['UserID'];
    $_SESSION['Password']= $row['Password'];
    $_SESSION['Email']= $row["Email"];

    header('Location: dashboard.php');
    
} else {
echo '<div class="container alert alert-danger">The ID and password do not match. Please try again.</div>'; 
echo $count;
}

}


 ?>

<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <h4 class="text-center mb-4">Admin Login</h4>
    <input class="form-control mb-3" type="text" name="user" placeholder="Username" autocomplete="off"/>
    
<div class="form-group input-group">
    <input class="form-control mb-3" type="password" id="pass" name="pass" placeholder="Password" autocomplete="new-password"/>
    <div class="input-group-prepend">
        <div class="input-group-text form-control">
        <a href="#" class="text-dark" id="icon-click"><i class="fas fa-eye" id="icon"></i>                         
        </div>
    </div>
</div>
    <input class="btn btn-primary btn-block" type="submit" value="Login"/>
</form>




<?php  include 'footer.php'; ?>


<!-- 

mysql_fetch_object(mysql_query("SELECT * FROM 'NameTable'"))->NameColumn

OR

mysql_fetch_object(mysql_query("SELECT * FROM 'NameTable'"))->NameColumn
