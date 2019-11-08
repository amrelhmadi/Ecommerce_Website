<?php 

/*
===============================================
**Template page 
===============================================
*/ 

ob_start(); //out buffering start

session_start();

$pageTitle = '';


if(isset($_SESSION['Username'])) {

    include 'ini.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if ($do == 'Manage') {

        $sort = 'ASC';
        $sort_array = array('ASC', 'DESC');
        if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)) {
            $sort = $_GET['sort'];
        }
        $stmt2 = $con->prepare("SELECT * FROM categories ORDER BY ordering $sort");

        $stmt2->execute();

        $cats = $stmt2->fetchAll(); ?>

        <h1 class="text-center">Manage Categories</h1>
        <div class="container categories">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-edit"></i> Manage Categories
                    <div class="option float-right">

                    <i class="fas fa-sort"></i> Ordering:[
                        <a class="<?php if ($sort == 'ASC') { echo 'active';} ?>" href="?sort=ASC">Asc</a> |
                        <a class="<?php if ($sort == 'DESC') { echo 'active';} ?>" href="?sort=DESC">Desc</a> ]

                        <i class="fas fa-eye"></i> View:[ 
                        <span class="active" data-view="full">Full</span> |
                        <span data-view="classic">Classic</span> ]
                    </div>
                
                </div>
                <div class="card-body">
                    <?php
                  foreach($cats as $cat) {
                    echo '<div class="cat">';
                    echo '<div class="hiddin-button">';

                        echo '<a href="categories.php?do=Edit&catid='. $cat['ID'] .'" class="btn btn-primary btn-sm mr-1"><i class="fas fa-edit btn-editIcon-Cate"></i> Edit </a>';
                        
                        echo '<a href="categories.php?do=Delete&catid='. $cat['ID'] .'" class=" btn btn-danger btn-sm" ><i class="fas fa-times btn-editIcon-Cate"></i> Delete </a>';

                    echo '</div>';
                    echo "<h3>". $cat['Name'] . "</h3>";
                        echo '<div class="full-view">';
                            echo '<p>'; 
                            if($cat['Description'] == ''){echo'This Is category Has No Description';} else{ echo $cat['Description'];} 
                            echo'</p>';
                            if($cat['Visibility'] == 1) {echo'<span class="visiblity"><i class="fas fa-eye"></i> Hidden </span>';} 
                            if($cat["Allow_Comment"] == 1) {echo'<span class="commenting"><i class="fas fa-times"></i> Comment Disabled </span>';} 
                            if($cat['Allow_Ads'] == 1) {echo'<span class="advertises"><i class="fas fa-times"></i> Ads Disabled </span>';} 
                        echo '</div>';

                    echo '</div>';
                    echo '<hr>';
                    
                  }
                     ?>
                </div>
            </div>
            <a class="btn btn-primary mt-3 mb-5" href="categories.php?do=Add">
                <i class="fas fa-plus"></i>
                Add New Category
             </a>
        </div>
<?php
   

    } elseif($do == 'Add') { ?>

        <h1 class="text-center">Add New Categories</h1>
                        <div class="container">
                            <form action="?do=Insert" method="POST"  id="add-form" >
                            
                            <!-- Start Name Field -->
                            <label class="col-sm-2 control-lable">Name</label>
                            <div class='form-group col-sm-8 col-md-12'>
                                        <input  type="text" name="name" class="any-type form-control " autocomplete ="off"  placeholder = "Name Of The Categories " required = "required">
                            </div>
                            <!-- End Name Feild -->
                            <!-- Start Description Field -->
                            <label class="col-sm-2 control-lable">Description</label>
                            <div class="form-group input-group col-sm-8 col-md-12">
                                    <input type="text" name="description" id="pass" class="form-control" placeholder = "Describe The Category"  >
                                                              
                            </div>
           
                            <!-- End Description Feild -->
                            <!-- Start Ordering Field -->
                            <label class="col-sm-2 control-lable">Ordering</label>
                            <div class='form-group col-sm-8 col-md-12 '>
                                        <input  type="text" name="ordering"  class="form-control" placeholder = "Number To Arrange The Categories " >                            
                            </div>      
                            <!-- End Ordering Feild -->
                            <!-- Start Visiblity Field -->
                            <label class="col-sm-12 control-lable">Visible</label>
                            <div class='form-group col-sm-8 col-md-12 mb-4'>
                                <div>
                                    <input type="radio" id="vis-yes" name="visiblity" value="0" checked>
                                    <label for="vis-yes">Yes</label>
                                </div>
                                <div>
                                    <input type="radio" id="vis-no" name="visiblity" value="1">
                                    <label for="vis-no">No</label>
                                </div>
                            </div>
                            <!-- End Visiblity Feild -->
                            <!-- Start Commenting Field -->
                            <label class="col-sm-12 control-lable">Allow Commenting</label>
                            <div class='form-group col-sm-8 col-md-12 mb-4'>
                                <div>
                                    <input type="radio" id="com-yes" name="commenting" value="0" checked>
                                    <label for="com-yes">Yes</label>
                                </div>
                                <div>
                                    <input type="radio" id="com-no" name="commenting" value="1">
                                    <label for="com-no">No</label>
                                </div>
                            </div>
                            <!-- End Commenting Feild -->
                            <!-- Start Ads  Field -->
                            <label class="col-sm-12 control-lable">Allow Ads</label>
                            <div class='form-group col-sm-8 col-md-12 mb-4'>
                                <div>
                                    <input type="radio" id="Ads-yes" name="ads" value="0" checked>
                                    <label for="Ads-yes">Yes</label>
                                </div>
                                <div>
                                    <input type="radio" id="Ads-no" name="ads" value="1">
                                    <label for="Ads-no">No</label>
                                </div>
                            </div>
                            <!-- End Ads Feild -->
                            <!-- Start submit Field -->
                            <div class='form-group  col-sm-12'>
                                    <input  type="submit" value="Add Category" class="btn-primary btn-block btn-lg rounded-lg" >
                            </div> 
                            <!-- End submit Feild -->
                            </form>
                        </div>
                       
        
            <?php    


    } elseif ($do == 'Insert') {  // Start Insert Page 
        
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            echo " <h1 class='text-center'>Insert Category</h1>";
            echo '<div class = "container">' ; 
            
            $name = $_POST['name'];
            $desc = $_POST['description'];
            $order = $_POST['ordering'];
            $visible = $_POST['visiblity'];
            $comment = $_POST['commenting'];
            $ads = $_POST['ads'];


                // Check If Category Exist in Database  
                $check = checkItem("Name", "categories" , $name);

                if ($check == 1 ) {
                    $theMsg = '<div class="container">
                    <div class="alert alert-danger">Sorry This Category Is Exist</div>';

                    redirectHome($theMsg , 'back');
                    
                    echo '</div>';

                } else {
  
                        $stmt = $con->prepare("INSERT INTO categories(Name,Description,Ordering,Visibility,Allow_Comment,Allow_Ads) VALUES(:zname,:zdesc,:zorder,:zvisible,:zcomment,:zads)");
                        $stmt->execute(array(
                            'zname' => $name,
                            'zdesc' => $desc,
                            'zorder' => $order,
                            'zvisible' => $visible,
                            'zcomment' => $comment,
                            'zads' => $ads
                        ));   
                        // Insert Categories In DataBase
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

        
    } elseif ($do == 'Edit') { 

         // Start Edit Page
    
         $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0 ;
            
                
         // Check if the user exist in database
         $stmt = $con->prepare("SELECT * FROM  categories  WHERE  ID = ? ");
     
     // Do Array for $username,$hashedPass 
         
         $stmt->execute(array($catid));
     
     // Fetch like Get All varible i Executed in array 
     
         $cat = $stmt->fetch();
     
     // rowCount built in php mean get how much row you have in your table 
     
         $count = $stmt->rowCount();

if ($count > 0) { //Edit Form ?>

<h1 class="text-center">Edit Categories</h1>
<div class="container">
<form action="?do=Update" method="POST" id="add-form">
<input type="hidden" name="catid" value="<?php echo $catid ?>" />

<!-- Start Name Field -->
<label class="col-sm-2 control-lable">Name</label>
<div class='form-group col-sm-8 col-md-12'>
         <input  type="text" name="name" class="any-type form-control "  placeholder = "Name Of The Categories " required = "required" value="<?php echo $cat['Name'] ?>">
</div>
<!-- End Name Feild -->
<!-- Start Description Field -->
<label class="col-sm-2 control-lable">Description</label>
<div class="form-group input-group col-sm-8 col-md-12">
     <input type="text" name="description" id="pass" class="form-control" placeholder = "Describe The Category"  value="<?php echo $cat['Description'] ?>">
                                 
</div>

<!-- End Description Feild -->
<!-- Start Ordering Field -->
<label class="col-sm-2 control-lable">Ordering</label>
<div class='form-group col-sm-8 col-md-12 '>
         <input type="text" name="ordering" class="form-control" placeholder = "Number To Arrange The Categories" value = "<?php echo $cat['Ordering']  ?>" />                        
</div>      
<!-- End Ordering Feild -->
<!-- Start Visiblity Field -->
<label class="col-sm-12 control-lable">Visible</label>
<div class='form-group col-sm-8 col-md-12 mb-4'>
 <div>
     <input type="radio" id="vis-yes" name="visiblity" value="0" 
     <?php if ($cat['Visibility'] == 0) {echo 'checked';} ?>  />
     <label for="vis-yes">Yes</label>
 </div>
 <div>
     <input type="radio" id="vis-no" name="visiblity" value="1" 
     <?php if ($cat['Visibility'] == 1) {echo 'checked'; } ?> />
     <label for="vis-no">No</label>
 </div>
</div>
<!-- End Visiblity Feild -->
<!-- Start Commenting Field -->
<label class="col-sm-12 control-lable">Allow Commenting</label>
<div class='form-group col-sm-8 col-md-12 mb-4'>
 <div>
     <input type="radio" id="com-yes" name="commenting" value="0" 
      <?php if ($cat['Allow_Comment'] == 0) {echo 'checked';}?> />
     <label for="com-yes">Yes</label>
 </div>
 <div>
     <input type="radio" id="com-no" name="commenting" value="1" 
     <?php if ($cat['Allow_Comment'] == 1) {echo 'checked';} ?> />
     <label for="com-no">No</label>
 </div>
</div>
<!-- End Commenting Feild -->
<!-- Start Ads  Field -->
<label class="col-sm-12 control-lable">Allow Ads</label>
<div class='form-group col-sm-8 col-md-12 mb-4'>
 <div>
     <input type="radio" id="Ads-yes" name="ads" value="0"
      <?php if ($cat['Allow_Ads'] == 0) {echo 'checked'; } ?>/>
     <label for="Ads-yes">Yes</label>
 </div>
 <div>
     <input type="radio" id="Ads-no" name="ads" value="1" 
     <?php if ($cat['Allow_Ads'] == 1) {echo 'checked'; } ?>/>
     <label for="Ads-no">No</label>
 </div>
</div>
<!-- End Ads Feild -->
<!-- Start submit Field -->
<div class='form-group  col-sm-12'>
     <input  type="submit" value="Save Category" class="btn-primary btn-block btn-lg rounded-lg" >
</div> 
<!-- End submit Feild -->
</form>
</div>


                      

<?php } else {

echo '<div class="container">';
 $theMsg = '<div class="alert alert-danger">There Is No Such ID</div>';
 redirectHome($theMsg);
echo '</div>';
}
/*  End Edit Page */ 
 


        
    } elseif ($do == 'Update') {
        
         /* Start Update Page */ 
            
         if($_SERVER['REQUEST_METHOD'] == 'POST') {

            echo " <h1 class='text-center'>Category Member</h1>";
            echo '<div class = "container">' ; 

            $id         =$_POST['catid'];
            $name       = $_POST['name'];
            $desc       = $_POST['description'];
            $visible    = $_POST['visiblity'];
            $order      = $_POST['ordering'];
            $comment    = $_POST['commenting'];
            $ads        = $_POST['ads'];


            

           
            $stmt = $con->prepare("UPDATE 
            categories SET 
                Name = ? ,
                Description = ? ,
                Visibility = ? ,
                Ordering = ?,
                Allow_Comment = ? ,
                Allow_Ads = ? 
             WHERE 
                ID = ?");
            $stmt->execute(array($name,$desc,$visible,$order,$comment,$ads,$id ));

            $theMsg = "<div class = 'alert alert-success'>".  $stmt->rowCount() ." Record Update </div>";

            redirectHome($theMsg , 'back');
        

            // End Check if Error Not Empty Make Update 


            // End Validation The Form

        } else {
            
            $theMsg = '<div class="container">
            .<div class="alert alert-danger">You cant Show You this page dirctly</div>';
            
            redirectHome($theMsg);

        } 

        echo '</div>';

   /* End Update Page */



    } elseif ($do == 'Delete'){ 

        
        $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0 ;
        
        
                      $check = checkItem('ID' , 'categories' , $catid);
                    
                    

                        if ( $check > 0) { 

                            $stmt = $con->prepare("DELETE FROM categories WHERE ID = :zid ");
                            //Make Link between ":zuser"& "$userid"
                            $stmt->bindParam(":zid" , $catid);
                            
                    
                            
                            $stmt->execute();

                           echo '<h1 class="text-center">Delete Catrgory</h1>';
                           echo' <div class="container">';

                            // Insert UserInfo In DataBase
                            $theMsg = "<div class='container'>
                            .<div class = 'alert alert-success'>".  $stmt->rowCount() ." Record Delete </div>
                            ";

                            redirectHome($theMsg ,'back');
                            echo '.</div>';
                            
                        } else {
                             $theMsg ='<div class="container"> 
                            .<div class="alert alert-danger">Good This ID Not Is Exist</div>';

                            redirectHome($theMsg);
                            echo '</div>';
                        }

    } elseif ('Activate') {
        
    }
    include 'footer.php';
    
    exit();

}
ob_end_flush();

?>

