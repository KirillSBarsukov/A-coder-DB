
<?php 
  require('scripts/header.php');
  //initializing variables 
  $user_id = null;
  $name = null;
  $email = null;
  $address = null;
  $skills = null;

  if(!empty($_GET['user_id']) && (is_numeric($_GET['user_id']))) {
    
    $user_id = $_GET['user_id'];

    // Connect to the DB
    require('scripts/db.php');
    //set up sql query
    $sql = "SELECT * FROM test WHERE user_id = :user_id;"; 
    //prepare 
    $cmd = $connect->prepare($sql);    
    // Bind
    $cmd->bindParam(':user_id', $user_id);
    // Execute
    $cmd->execute();
    // Use fetchAll method to store results
    $data = $cmd->fetchAll();

    foreach ($data as $key) {
      $name = $key['name'];
      $email = $key['email'];
      $address = $key['address'];
      $skills = $key['skills'];
    }

    // Close the connection
    $cmd->closeCursor();
  }

?>
  <!-- Combine the table and forms in a row -->
  <div class="row">
    <!-- Left side for the table -->
    <div class="col-sm-8">
    <?php  require('table.php'); ?>
    </div>
  <!-- Right side for the forms -->
    <div class="col-sm-4">
    <div class="jumbotron" id="menu">
      <h1 class="display-4">Hello World!</h1>
      <p class="lead">This is a virtual space for developes and coders. Submit and mange all your data without any doubts</p>
      <hr class="my-4">
      <p>To change an any information just simply click on it and change it in the form below.
      To change an any information just simply click on it and change it in the form below.

      </p>
      <p class="lead">
        <form method="post" action="scripts/submit.php">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputName">Name</label>
              <input type="text" class="form-control" name="name" id="inputName" placeholder="Name" value="<?php echo $name ?>">
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Email</label>
              <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="Email" value="<?php echo $email ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" name="address" id="inputAddress" placeholder="1234 Bloor St" value="<?php echo $address ?>">
          </div>
          <div class="form-group">
            <label for="inputSkills">Skills</label>
            <input type="text" class="form-control" name="skills" id="inputAddress2" placeholder="HTML, CSS, PHP etc." value="<?php echo $skills ?>">
            <input name="user_id" id="user_id" type="hidden" value="<?php echo $user_id; ?>" />
          </div>
          <div class="form-group">
            <button type="submit" name="submit" value="submit" class="btn btn-success">Submit</button>
            <?php
            echo'<a class="btn btn-primary" role="button" href="delete.php?user_id=' . $user_id . '" onclick="return confirm(\'Are you sure?\');">Delete </a>'; 
            ?>
          </div>
        </form>
      </p>
    </div>
    </div>
  </div>
<?php require('scripts/footer.php'); ?>
<script src="script.js"></script>