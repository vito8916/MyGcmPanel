<?php

// The helper file that let's allow ajax task

require 'db.php';
$helper = new DB();
$action = $_POST["action"];

switch ($action) {
    case "DEACTIVE":
        $id = $_POST['id'];
        $r = $helper->changeUserAccess(0, $id);
        echo "DEACTIVATED";
        break;
    case "ACTIVE":
        $id = $_POST['id'];
        $r = $helper->changeUserAccess(1, $id);
        echo "ACTIVATED";
        break;
    case "DEACTIVE_CAT":
        $id = $_POST['id'];
        $r = $helper->changeCatAccess(0, $id);
        echo "Category Deactivated!";
        break;
    case "ACTIVE_CAT":
        $id = $_POST['id'];
        $r = $helper->changeCatAccess(1, $id);
        echo "Category Activated!";
        break;
         case "DELETE_CAT":
        $id = $_POST['id'];
        if($id){
	echo $r = $helper->deleteCat($id);
        }else{
        	die("Try later!");
        }
        
        break;
        
        case "UPDATE_CAT":
        $id = $_POST['cat_id'];
        if($id){
	echo $r = $helper->updateCat($_POST);
        }else{
        	die("Try later!");
        }
        
        break;
    case "CHANGE_PASS":
        if ($helper->CheckPassword($_POST['opassword'])) {
            if ($_POST['password'] == $_POST['cpassword']) {
                if ($helper->ChangePassword($_POST['password'])) {
                    echo "Password successfully changed!";
                } else {
                    echo "Oppps! There is something wrong. Please try again.";
                }
            } else {
                echo "Password doesn't match! Make sure you have enter correct pasword in both field.";
            }
        } else {
            echo "You have enter wrong old password!";
        }
        break;

    case "ADD_CAT":
        if ($_POST['cat_name'] != NULL && $_POST['cat_desc'] != NULL) {
            if ($helper->AddCategory($_POST)) {
                echo "Category Added Succesfully.";
            } else {
                echo 'Error : Please input both fields.';
            }
        } else {
            echo 'Error : Please input both fields.';
        }
        break;

    default: echo "UNDEFINED ACTION";
        break;
}
?>
