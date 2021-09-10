<?php require_once("../includes/DB.php");?>
<?php require_once("../includes/Functions.php");?>
<?php require_once("../includes/Session.php");?>
<?php $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
// echo $_SESSION["TrackingURL"];
Confirm_Login(); ?>
<?php
if(isset($_POST["Submit"])){
  $VehicleNum = $_POST["VehicleNumber"];
  $Name = $_POST["Name"];
  $RVehicleType = $_POST["VehicleType"];
  $Make = $_POST["make"];
  $Year = $_POST["Year"];
  $FC = $_POST["fc"];
  $Photo = $_FILES["Photo"]["name"];
  $RDoc = $_FILES["RDoc"]["name"];
  $AddedBy = $_SESSION["AdminName"];


  // image will be in this folder
  $Target ="../photos/".basename($_FILES["Photo"]["name"]);
  $DocTarget ="../Photos/".basename($_FILES["RDoc"]["name"]);

  // DateTime
  $CurrentTime = new DateTime();  
  $CurrentTime->setTimezone(new DateTimeZone('Asia/Kolkata'));
  $DateTime = $CurrentTime->format("Y-m-d H:i:s");  
  echo $DateTime;
  
  if(empty($VehicleNum)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
  }
  else if(empty($Name)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("RC_Book.php");
  }
  else if(empty($RVehicleType)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("RC_Book.php");
  }
  else if(empty($Year)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("RC_Book.php");
  }
  else if(empty($FC)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("RC_Book.php");
  }
  else{
    $sql = "INSERT INTO rcbook(DateTime, Vehicle_Number, Name, Vehicle_Type, Model_Make, Manufacture_Date, FC, Photo, RcBook_Document, AddedBy)";
    $sql .= "VALUES(:DT,:VNo,:Name,:Type,:Make,:Year,:FC,:Photo,:RDoc,:admin)";  //Dummy values
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':DT',$DateTime);
    $stmt->bindValue(':VNo',$VehicleNum);
    $stmt->bindValue(':Name',$Name);
    $stmt->bindValue(':Type',$RVehicleType);
    $stmt->bindValue(':Make',$Make);
    $stmt->bindValue(':Year',$Year);
    $stmt->bindValue(':FC',$FC);
    $stmt->bindValue(':Photo',$Photo);
    $stmt->bindValue(':RDoc',$RDoc);
    $stmt->bindValue(':admin',$AddedBy);


    $Execute=$stmt->execute();
    move_uploaded_file($_FILES["Photo"]["tmp_name"],$Target); //to upload image
    move_uploaded_file($_FILES["RDoc"]["tmp_name"],$DocTarget); //to upload image

    if($Execute){
      $_SESSION["SuccessMessage"]= "RC Book Entry for id: ".$ConnectingDB->lastInsertId()." is Successful";
    Redirect_to('Insurance.php');
    }
    else{
      $_SESSION["ErrorMessage"]= "Error: All fields must be filled out";
    Redirect_to("RC_Book.php");
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
  <title>RC Book Entry</title>
</head>
<body>
  <!-- navbar -->
  <div style="height: 10px; background: #27a9e1d7;"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="AddDoc.php" class="navbar-brand"><i class="fas fa-motorcycle"></i>VehicleInfo.com </a> 
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
          <!-- <li class="nav-item">
            <a href="Rc_Book.php" class="nav-link">RC Book</a>
          </li> -->
          <li class="nav-item">
            <a href="epass.php" class="nav-link">E-Pass</a>
          </li>
          <li class="nav-item">
            <a href="officer.php" class="nav-link">Manage User</a>
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
          <h1><i class="fas fa-edit" style="color: #27a9e1d7;"></i> RC Book Data Entry</h1>
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
        <form action="RC_Book.php" class="" method="POST" enctype="multipart/form-data">
          <div class="card bg-secondary text-light mb-2 mt-5">
            <div class="class-header">
              <h1>Add New RC Book Entry</h1>
            </div>
            <div class="card-body bg-dark">
              <div class="form-group">
                <label for="vno"><span class="FieldInfo"> Vehicle Number: </span></label>
                <input type="text" class="form-control" name="VehicleNumber" id="vno" placeholder="Type Vehicle Number here">
              </div>
              <div class="form-group">
                <label for="name"><span class="FieldInfo">Owner Name: </span></label>
                <input type="text" class="form-control" name="Name" id="name" placeholder="Type Name here">
              </div>
              <div class="form-group">
                <label for="type"><span class="FieldInfo"> Vehicle Type: </span></label>
                <input type="text" class="form-control" name="VehicleType" id="type" placeholder="Type Vehicle type here">
              </div>
              <div class="form-group">
                <label for="make"><span class="FieldInfo"> Make and Model: </span></label>
                <input type="text" class="form-control" name="make" id="make" placeholder="Type Make and Model here">
              </div>
            
              <div class="form-group">
                <label for="year"><span class="FieldInfo"> Manufacture Date: </span></label>
                <input type="date" class="form-control" name="Year" id="year" placeholder="Type Manufacture Year here">
              </div>
              <div class="form-group">
                <label for="fc"><span class="FieldInfo"> FC: </span></label>
                <input type="date" class="form-control" name="fc" id="fc" placeholder="Type FC here">
              </div>

              
              <div class="form-group  mb-4">
                <label for="photo"><span class="FieldInfo"> Choose Photo </span></label>
                <div class="custom-file">
                  <input class="custom-file-input" type="file" name="Photo" id="photo" value="">
                  <label for="photo" class="custom-file-label"> Holder Image</label>
                </div>
              </div>
              <div class="form-group  mb-4">
                <label for="RDoc"><span class="FieldInfo"> Choose RcBook Document </span></label>
                <div class="custom-file">
                  <input class="custom-file-input" type="file" name="RDoc" id="RDoc" value="">
                  <label for="RDoc" class="custom-file-label"> Document Image</label>
                </div>
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