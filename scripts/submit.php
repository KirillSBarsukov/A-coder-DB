<?php
  require(dirname(__FILE__) .'/header.php');

  $user_id = $_POST['user_id'];

      try {
        if(isset($_POST['submit'])){
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $skills = $_POST['skills'];
        
        // Form validation. ctype_alpha(str_replace(' ', '', $name)) allows only Alpabetical characters and white space
        if(!empty($name) && ctype_alpha(str_replace(' ', '', $name)) && !empty($email) && !empty($address) && !empty($skills)) {

          require(dirname(__FILE__) .'/db.php');

          // if we have an existing user_id, run an update
          if (!empty($user_id)) {
            $sql = "UPDATE test SET name = :name, email = :email, address = :address, skills = :skills WHERE user_id = :user_id;";
      
          }
          else {
            $sql = "INSERT INTO test (name, email, address, skills) VALUES (:name, :email, :address, :skills);";
          }
            
          $cmd = $connect->prepare($sql); 
          
          $cmd->bindParam(':name', $name);
          $cmd->bindParam(':email', $email); 
          $cmd->bindParam(':address', $address); 
          $cmd->bindParam(':skills', $skills);

          if (!empty($user_id)) {
              $cmd->bindParam(':user_id', $user_id, PDO::PARAM_INT);
          }
            
          $cmd->execute(); 
            
          echo "<p> Thanks for sharing your personal data!</p>";
          $cmd->closeCursor();  
          header('Location: ../index.php');
        }
        else{
          echo "<p> There was an error with your form submission </p>"; 
          echo "<p> Please only use letters </p>"; 

          // Redirect to the index.php
          echo '<p>You will be redirected in <span id="counter">3</span> second(s).</p>
          <script type="text/javascript">
          function countdown() {
              var i = document.getElementById(\'counter\');
              if (parseInt(i.innerHTML)== 1) {
                  location.href = \'../index.php\';
              }
              i.innerHTML = parseInt(i.innerHTML)-1;
          }
          setInterval(function(){ countdown(); },1000);
          </script>';
        }
      }
    }
    catch(PDOException $e) {
      
      echo "<p> There was an error with your form submission </p>"; 

    }
    require(dirname(__FILE__) .'/footer.php');
?>
