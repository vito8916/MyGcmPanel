<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require 'db.php';
$helper=new DB();
if(isset($_REQUEST['email']) && isset($_REQUEST['app_type']) && isset($_REQUEST['gcm_id']) && isset($_REQUEST['is_active'])){
    if(!$helper->CheckUser($_REQUEST)){
        $r=$helper->AddUserGCM($_REQUEST);
    if($r){
        echo json_encode(array('status'=>"SUCCESS"));
    }else{
        echo json_encode(array('status'=>"FAIL"));
    }
    }else if(!$helper->CheckStatus($_REQUEST)){
        $r=$helper->UpdateStatus($_REQUEST);
    }
    
}else if(!isset($_REQUEST['app_type'])){
    echo json_encode(array('status'=>"NO_APP_SETUP"));
}else{
    echo json_encode(array('status'=>"PARAM_MISSING"));
}
?>
