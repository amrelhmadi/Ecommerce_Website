<?php 

/*========================================================================
What is This Page Do :
A- include Many File Page :
    A-1-include (connert.php) To Make Your Page "Connect With Database" BY PDO 
    A-2-Function To Put Title Name 'Default' If Do not Put Any Tile in Code 
    A-3-include This page Make Function To Convert "Language" By Array (Key => Value)  
    A-4-This page Put All (css & Bootstrap File) In html "head" Tag By Use "link" Tag
B-This Page defining Your Pathes ($css,$js,$lang)
C-Make Function To Make (Navbar) Visable or Not By Wirte ($noNavbar='') Varble 

=========================================================================*/
//1- Start To defining Your Pathes ($css,$js,$lang)
$css= 'layout/css/';
$js= 'layout/js/';
$lang = 'language/';
//1- End To defining Your Pathes ($css,$js,$lang)

//2-Start To include Many Page  
include $lang.'english.php';
include 'connect.php';
include 'function.php';
include 'header.php'; 
//2-End To include Many Page 

//3- Start Make Function To Make (Navbar) Visable or Not By Wirte ($noNavbar='') Varble 
if(!isset($noNavbar)) {
    include 'navbar.php';
}
//3- End Make Function To Make (Navbar) Visable or Not By Wirte ($noNavbar='') Varble 

