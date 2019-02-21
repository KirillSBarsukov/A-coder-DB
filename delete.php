<?php
ob_start(); 
$user_id = $_GET['user_id'];

// Connect to the DB
require('scripts/db.php');

// Set up our sql query
$sql = "DELETE FROM test WHERE user_id = :user_id;"; 

// Prepare
$cmd = $connect->prepare($sql);

// Bind parameters
$cmd->bindParam(':user_id', $user_id);

// Run that query
$cmd->execute();

// Disconnect
$cmd->closeCursor();

header('location:index.php'); 

ob_flush(); 
?>