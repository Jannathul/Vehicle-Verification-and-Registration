<?php require_once("../includes/DB.php");?>
<?php require_once("../includes/Functions.php");?>
<?php require_once("../includes/Session.php");?>
<?php $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
// echo $_SESSION["TrackingURL"];
Confirm_Login(); ?>

<?php
if(isset($_POST["Submit"])){
  $UserName = $_POST["Username"];
  $name = $_POST["name"];
  $Password = $_POST["Password"];
  $ConfirmPassword = $_POST["ConfirmPassword"];
  $BirthDate = $_POST["BirthDate"];
  $AddedBy = $_SESSION["AdminName"];

  // DateTime
  $CurrentTime = new DateTime();  
  $CurrentTime->setTimezone(new DateTimeZone('Asia/Kolkata'));
  $DateTime = $CurrentTime->format("M d Y h:i:s a");  
  echo $DateTime;
  
  if(empty($UserName)||empty($Password)||empty($ConfirmPassword)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
 
    Redirect_to("officer.php");
  }
  else if(strlen($Password)<6){
    $_SESSION["ErrorMessage"]= "Weak Password! Password should be atleast 6 Characters";
    Redirect_to("officer.php");
  }
  else if(($Password!=$ConfirmPassword)){
    $_SESSION["ErrorMessage"]= "Password and Confirm Password should match";
    Redirect_to("officer.php");
  }
  else if((CheckUserNameExists($UserName))){
    $_SESSION["ErrorMessage"]= "Username Exists. Try Another username!";
    Redirect_to("officer.php");
  }
  
  else{
    $sql = "INSERT INTO officer(DateTime, username, password, name, AddedBy )";
    $sql .= "VALUES(:DT,:username,:password,:name,:officer)";  //Dummy values
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':DT',$DateTime);
    $stmt->bindValue(':username',$UserName);
    $stmt->bindValue(':password',$Password);
    $stmt->bindValue(':name',$name);
    $stmt->bindValue(':officer',$AddedBy);
    $Execute=$stmt->execute();
    move_uploaded_file($_FILES["LPhoto"]["tmp_name"],$Target); //to upload image

    if($Execute){
      $_SESSION["SuccessMessage"]= "New officer Added Successfully!!";
    Redirect_to("AddDoc.php");
    }
    else{
      $_SESSION["ErrorMessage"]= "Error: All fields must be filled out";
    Redirect_to("officer.php");
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
  <title>officer Page</title>
</head>
<body>
  <!-- navbar -->
  <div style="height: 10px; background: #27a9e1d7;"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="MyProfile.php" class="navbar-brand"><i class="fas fa-motorcycle"></i>VehicleInfo.com </a> 
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapse1">
        <span class="navbar-toggler-icon"> </span>
      </button>
      <div class="collapse navbar-collapse" id="navbarcollapse1">
        <ul class="navbar-nav mx-auto">
        <li class="nav-item">
            <a href="AddDoc.php" class="nav-link text-success">Documents</a>
          </li>
          <li class="nav-item">
            <a href="Licence.php" class="nav-link">Licence</a>
          </li>
          <li class="nav-item">
            <a href="Rc_Book.php" class="nav-link">RC Book</a>
          </li>
          <li class="nav-item">
            <a href="epass.php" class="nav-link">E-Pass</a>
          </li>
          <li class="nav-item">
            <a href="Admin.php" class="nav-link">Manage Admin</a>
          </li>
          <li class="nav-item">
            <a href="frontend.php" class="nav-link  text-success">Live Preview</a>
          </li>
        </ul>
          
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
          <a href="Logout.php" class="nav-link text-danger"> <i class="fas fa-user-times"></i>Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div style="height: 10px; background: #27a9e1d7;"></div>
  <!-- navbar over -->

  <!-- header -->
  <header class="bg-dark text-white py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fas fa-user" style="color: #27a9e1d7;"></i> Manage officer </h1>
        </div>
      </div>
    </div>
  </header>
  <!-- header over -->

  <!-- main area -->
  <section class="container py-2 mb-4">
    <div class="row" >
      <div class="offset-lg-1 col-lg-10" style="min-height: 100px;">
        <?php 
        echo ErrorMessage();
        echo SuccessMessage();
        ?>
        <form action="officer.php" class="" method="POST" enctype="multipart/form-data">
          <div class="card bg-secondary mb-2 mt-5">
            <div class="class-header">
              <h1 class="text-light">Add New officer</h1>
            </div>
            <div class="card-body bg-dark">
              <div class="form-group">
                <label for="username"><span class="FieldInfo"> UserName: </span></label>
                <input type="text" class="form-control" name="Username" id="username" >
              </div>
              <div class="form-group">
                <label for="name"><span class="FieldInfo"> officer Name: </span></label>
                <input type="text" class="form-control" name="name" id="name" >
                <small class="text-danger">*Optional</small>
              </div>
              <div class="form-group">
                <label for="password"><span class="FieldInfo"> Password: </span></label>
                <input type="password" class="form-control" name="Password" id="password" >
              </div>
              
              <div class="form-group">
                <label for="ConfirmPassword"><span class="FieldInfo"> Confirm Password: </span></label>
                <input type="password" class="form-control" name="ConfirmPassword" id="ConfirmPassword">
                
              </div>
              
              <div class="row">
                <div class="col-lg-6 mb-2">
                  <a href="AddDoc.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                </div>
                <div class="col-lg-6 mb-2">
                  <button type="submit" name="Submit" class="btn btn-success btn-block">
                  <i class="fas fa-check"></i> Submit
                  </button>
                </div>
            </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>


<!-- main area over -->
  <!-- footer -->
  <footer class="bg-dark text-white">
    <div class="container">
      <div class="row">
        <div class="col">
        <p class="lead text-center">Theme by | Firdouse | <span id="year"></span>&copy; ---All Right Reserved</p>
        <p class="text-center small">This is a college project site <br>Based on the idea to reduce traffic<br>Created by Firdouse </p>
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