<?php 
/*====================================================================
This Page Make Function Like :
A- Function To Put Title Name 'Default' If Do not Put Any Tile in Code 
=================================================================== */ 

//1-Start Function To Get For Title Page 
   function getTitle() {
       
//A1-Start To put global Varble ($pageTitle)    
       global $pageTitle ;
//A1-End To put global Varble ($pageTitle)    

//B1-Start Condition If You Put ($pageTitle) In your Page True |Do = Write Your Title | Fale Do = Write Default Title 
    if (isset($pageTitle)) {
        echo $pageTitle;
    } else {
        echo 'Default';
    }
//B1-Start Condition If You Put($pageTitle)In your Page True |Do = Write Your Title | Fale Do = Write Default Title 
   }
//1-End Function To Get For Title Page 

/* home Redirect Function [ This Function Accept Parameters]

*/
function redirectHome($theMsg , $url = null , $seconds = 4 ) {

    if ($url === null ) {

        $url = 'index.php';
        $link = 'Homepage';

    } else {

        $url = isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '' ? $url = $_SERVER['HTTP_REFERER'] : $url = 'index.php';

        $link = 'Previous Page';

            }

    echo $theMsg;
    echo "<div class='alert alert-info'>You Will Redirected to $link After $seconds seconds.</div>";
    header("refresh:$seconds; url=$url");
    exit();
     
    }

/* Check Items function v1.0
1- Function to  Check Item In Database [ Function Accept Paramerters ]
2- $select = The Item To 
*/

 function checkItem($select , $from , $value) {
     
    global $con;
    
    $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
    $statement->execute(array($value));
    $count = $statement->rowCount();

    return $count ;
 }

/* Count Number Of Item Function v1.0 */
/*Function TO */

function countItems($item , $table) {

    global $con;

$stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");

$stmt2->execute();

return $stmt2->fetchColumn();

}

/*
1-Get Latest Records Function v1.0
2-Fucntion To Get Latest Item Fro Database [Users , Item , Comments]
*/

function getLatest($select , $table , $order ,$limit = 5) {
    
    global $con;

    $getStmt = $con->prepare("SELECT $select FROM $table ORDER BY  $order DESC LIMIT $limit");

    $getStmt->execute();

    $rows = $getStmt->fetchAll();

    return $rows;
}