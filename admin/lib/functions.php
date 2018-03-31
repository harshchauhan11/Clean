<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function print_r_pre($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    
}
function setActiveClassMenu($page_name){
    if (strpos($_SERVER['PHP_SELF'],$page_name) !== false) {
        echo 'active';
    }
}
function redirect_js($page){
    echo '<script type="text/javascript">
         <!--
            function Redirect() {
               window.location="'.$page.'";
            }
         //-->
      </script>';
}
function redirect_php($page){
     header("location: $page");    
}
?>


