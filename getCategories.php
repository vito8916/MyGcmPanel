<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
header("Content-Type: application/json");
require 'db.php';
$helper=new DB();
if(isset($_REQUEST['email'])){
 echo json_encode($helper->getAllCategories(true));
}else if(!isset($_REQUEST['app_type'])){
    echo json_encode(array('status'=>"NO_APP_SETUP"));
}else{
    echo json_encode(array('status'=>"PARAM_MISSING"));
}
?>
