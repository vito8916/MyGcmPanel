<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
header("Content-Type: application/json");
require 'db.php';
$helper=new DB();
if(isset($_REQUEST['email']) && isset($_REQUEST['cat'])){
 echo json_encode($helper->setUserCategories($_REQUEST));
}else {
    echo json_encode(array('status'=>"PARAM_MISSING"));
}
?>
