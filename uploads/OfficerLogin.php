<?php require_once("../includes/DB.php");?>
<?php require_once("../includes/Functions.php");?>
<?php require_once("../includes/Session.php");?>

<?php
if(isset($_POST["Submit"])){
  $UserName = $_POST["Username"];
  $Password = $_POST["Password"];
  if(empty($UserName)||empty($Password)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("OfficerLogin.php");
  }
  else{
  // code for checking username and password from database
    $Account = Officer_Login_Attempt($UserName,$Password);
    if ($Account)
    {
    $_SESSION["USERID"]=$Account["Id"];
    $_SESSION["Username"]=$Account["username"];


    # code...
    $_SESSION["SuccessMessage"]= "Welcome ".$_SESSION["Username"];
    
    if (isset($_SESSION["TrackingURL"])) {
      
      Redirect_to($_SESSION["TrackingURL"]);
    } 
    else{
    Redirect_to("OfficerLogin.php");
    }
  }else{
    $_SESSION["ErrorMessage"]="Incorrect Username/Password";
    Redirect_to("OfficerLogin.php");
   }
  
  }
}
?>  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <title>Log-in</title>
</head>
<body>
  <!-- navbar -->
  <div style="height: 10px; background: #27a9e1d7;"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="#" class="navbar-brand"><h2><i class="fas fa-motorcycle"></i>VehicleInfo.com </h2></a> 
      
    </div>
  </nav>
  <div style="height: 10px; background: #27a9e1d7;"></div>
  <!-- navbar over -->

  <!-- header -->
  <header class="bg-dark text-white py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1></h1>
        </div>
      </div>
    </div>
  </header>
  <!-- header over -->
<!-- main area -->

      <!-- section  -->
    <section class="container py-2 mb-4">
      <div class="row">
      <div class="offset-sm-3 col-sm-6" style="min-height: 200px;">
      <br>
    <?php 
        echo ErrorMessage();
        echo SuccessMessage();
        ?>

      <div class="card bg-secondary text-light">
          <div class="card-header">
        <h4>Welcome Back !</h4>
      </div>
        <div class="card-body bg-dark">
         
        <form class="" action="OfficerLogin.php" method="post">
          <div class="form-group">
            <label for="username"><span class="FieldInfo">Username: </span></label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text text-white bg-info"><i class="fas fa-user"></i></i></span>   
              </div>
              <input type="text" class="form-control" name="Username" id="username" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="password"><span class="FieldInfo">password: </span></label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text text-white bg-info"><i class="fas fa-lock"></i></i></span>   
              </div>
              <input type="password" class="form-control" name="Password" id="password" value="">
            </div>
          </div>
          <br>
          <input type="submit" name="Submit" class="btn btn-info btn-block" value="Login">
        </form>
      </div>

    </div></div>
  </div>
  </section>


<!-- main area over -->
  <!-- footer -->
  <footer class="bg-dark text-white">
    <div class="container">
      <div class="row">
        <div class="col">
        <p class="lead text-center">Theme by | Firdouse | <span id="year"></span>&copy; ---All Right Reserved</p>
        <p class="text-center small">This is a just a project site <br>By Firdouse </p>
        </div>
      </div>
    </div>

  </footer>
  <div style="height: 10px; background: #27a9e1d7;"></div>
  <!-- footer over -->

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <script>
    $('#year').text(new Date().getFullYear());
  </script>
</body>
</html>

