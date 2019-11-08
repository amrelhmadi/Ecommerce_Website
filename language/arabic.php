<?php 

 /*==================================================================
 This page Make Function To Convert Language By Array (Key => Value)  
 
 ==================================================================*/
 
 //1-Start Function To Convert Language 
 function lang( $phrase ) {
    static $lang = array(
        'MESSAGE' => 'اهلا',
        'ADMIN' => 'يا مدير الموقع'
    ); 
    return $lang[$phrase];
 }
 //1-End Function To Convert Language 