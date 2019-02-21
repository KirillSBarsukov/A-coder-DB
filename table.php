<?php 
require ('scripts/header.php');
ob_start(); 

try {
    //connect to the db 
    require('scripts/db.php'); 
    //sql query to select everything from our songs table 
    $sql = "SELECT * FROM test;"; 
    //prepare the statement 
    $cmd = $connect->prepare($sql); 
    //execute 
    $cmd->execute(); 
    //use fetchAll to store results 
    $codersData = $cmd->fetchAll(); 

    echo '<table class="table table-hover">
    <thead class="thead-dark">
      <th scope="col"> Name </th>
      <th scope="col"> E-mail </th> 
      <th scope="col"> Address </th>
      <th scope="col"> Skills </th>
    </thead> 
    <tbody>';
    //loop through the data and create a new table row for each record 
    foreach($codersData as $data) {
        echo'<tr class="test" onclick="window.location = \'index.php?user_id=' . $data['user_id'] .  '\';">
        <td>'. $data['name'] .'</td>';
        echo'<td>' . $data['email'] . '</td>';
        echo'<td>' . $data['address'] . '</td>';
        echo'<td>' . $data['skills'] . '</td>';
        }
        echo '</tbody></table>';

    //close db connection 

    $cmd->closeCursor(); 


} catch (PDOException $th) {
    header('location:error.php'); 
    mail('kirillsbarsukov@gmail.com', 'Coders database issue', $e); 
}

ob_flush(); 
require('scripts/footer.php'); 
?>
