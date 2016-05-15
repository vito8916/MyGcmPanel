<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require 'db.php';
$helper = new DB();

$load = array(
    'type' => "",
    'title' => "",
    'message' => "",
    'emotion' => "",
    'link' => ""
);

function addhttp($url) {    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {        $url = "http://" . $url;    }    return $url;}				$_POST['link']=addhttp($_POST['link']);

switch ($_POST['type']) {

    case 1: // Simple Notification

        $load['type'] = $_POST['type'];
        $load['title'] = $_POST['title'];
        $load['message'] = $_POST['message'];

        break;
    case 2: // Dialoge Notification

        $load['type'] = $_POST['type'];
        $load['title'] = $_POST['title'];
        $load['message'] = $_POST['message'];
        $load['emotion'] = $_POST['emotion'];
        $load['link'] = $_POST['link'];

        break;
    case 3: // Web Activity Notification 
        $load['type'] = $_POST['type'];
        $load['title'] = $_POST['title'];
        $load['message'] = $_POST['message'];
        $load['link'] = $_POST['link'];

        break;
    case 4:
        $load['type'] = $_POST['type'];
        $load['title'] = $_POST['title'];

        break;
		    case 5:
               $load['type'] = $_POST['type'];
        $load['title'] = $_POST['title'];
        $load['message'] = $_POST['message'];
        $load['emotion'] = $_POST['emotion'];
        $load['link'] = $_POST['link'];
        break;

    default:
        break;
}


if (isset($_POST["send_cat"])) {
    if ($_POST["app_type"] == "-1") {
        die("Invalid App Type. Please Choose Valid App.");
    } else {
        if ($_POST["app_type"] == "0") {
 
            if($_POST["categories"]){
                $user = $helper->getAllUsers_withCategories("ACTIVE",$_POST["categories"]);
            }else{
           
                $user = $helper->getAllUsers("ACTIVE");
            }
            
        } else {
             if($_POST["categories"]){
             //	echo "User by type with categories";
                $user = $helper->GetUserByType_withCategories($_POST["app_type"],$_POST["categories"]);
            }else{
         	//echo "User by type NO Cat";
               $user = $helper->GetUserByType($_POST["app_type"]);
            }
        }
    }
    $ids = array();
    foreach ($user as $key => $value) {
        $ids[] = $value['gcm_id'];
    }

    if (empty($ids))
        die("No user found yet!");
    $nid = $helper->AddNotification($load);

    echo $helper->sendNotification($ids, $load, $nid);
} elseif ($_POST["gcm_id"]) {
    $nid = $helper->AddNotification($load);

    echo $helper->sendNotification(array($_POST["gcm_id"]), $load, $nid);
}
?>