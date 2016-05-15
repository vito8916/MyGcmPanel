<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require 'db.php';
$helper = new DB();

$data = $helper->GetGraphsByRange($_POST["from"]." 00:00:00", $_POST["to"]." 00:00:00");
header("Content-Type: application/json");
echo json_encode($data);
?>
