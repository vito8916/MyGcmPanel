<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'db.php';
$helper=new DB();
$helper->LogMeOut();
header("Location: ./");
?>
