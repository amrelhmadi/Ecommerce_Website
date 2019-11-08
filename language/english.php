<?php 
 
 /*==================================================================
 This page Make Function To Convert Language By Array (Key => Value)  
 
 ==================================================================*/
 
//1-Start Function To Convert Language 
 function lang( $phrase ) {
    static $lang = array(

        //Navbar Links

        'HOME_ADMIN' => 'Home',
        'CATEGORIES' => 'Categories',
        'ITEMS' => 'Items',
        'MEMBERS' => 'Members',
        'STATISICE' => 'Statistics',
        'LOGS' => 'Logs',
        'EDITE' => 'Edite Profile',
        'SETTING' => 'Settings',
        'LOGOUT_USER' => 'Logout'
    ); 
    return $lang[$phrase];
 }
 //1-End Function To Convert Language 
