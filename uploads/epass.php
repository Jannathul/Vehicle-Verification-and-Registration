<?php require_once("../includes/DB.php");?>
<?php require_once("../includes/Functions.php");?>
<?php require_once("../includes/Session.php");?>
<?php $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
// echo $_SESSION["TrackingURL"];
Confirm_Login(); ?>
<?php

if(isset($_POST["Submit"])){
  $Id      = $_POST["id"];
  $VNo     = $_POST["VNo"];
  $Pname   = $_POST["Name"];
  $VType   = $_POST["Vtype"];
  $Add     = $_POST["Add"];
  $Reason  = $_POST["Reason"];
  $FT      = $_POST["Ft"];
  $Till    = $_POST["Till"];
  $Epass   = $_FILES["Epass"]["name"];
  // image will be in this folder
  $Target ="../Photos/".basename($_FILES["Epass"]["name"]);
  $AddedBy = $_SESSION["AdminName"];


  // DateTime
  $CurrentTime = new DateTime();  
  $CurrentTime->setTimezone(new DateTimeZone('Asia/Kolkata'));
  $DateTime = $CurrentTime->format("Y-m-d H:i:s");  
  echo $DateTime;
  
  if(empty($VNo)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
  }
  
  else{
    $sql = "INSERT INTO epass(ID,DateTime, VehicleNumber,PersonName,VehicleType,Additional,Reason,FromAndTo,passvalid,EPass,AddedBy)";
    $sql .= "VALUES(:id,:dt,:vno,:name,:type,:additional,:reason,:fromto,:pass,:doc,:admin)";  //Dummy values
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':id',$Id);
    $stmt->bindValue(':dt',$DateTime);
    $stmt->bindValue(':vno',$VNo);
    $stmt->bindValue(':name',$Pname);
    $stmt->bindValue(':type',$VType);
    $stmt->bindValue(':additional',$Add);
    $stmt->bindValue(':reason',$Reason);
    $stmt->bindValue(':fromto',$FT);
    $stmt->bindValue(':pass',$Till);
    $stmt->bindValue(':doc',$Epass);
    $stmt->bindValue(':admin',$AddedBy);

    $Execute=$stmt->execute();
    move_uploaded_file($_FILES["Epass"]["tmp_name"],$Target); //to upload image

    if($Execute){
      $_SESSION["SuccessMessage"]= "Insurance Entry for id: ".$ConnectingDB->lastInsertId()." is Successful";
      Redirect_to('generate_code.php?ID='.$ConnectingDB->lastInsertId());

    }
    else{
      $_SESSION["ErrorMessage"]= "sorry";
    Redirect_to("epass.php");
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
  <title>EPass Entry</title>
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
          <li class="nav-item">
            <a href="Rc_Book.php" class="nav-link">RC Book</a>
          </li>
          <!-- <li class="nav-item">
            <a href="epass.php" class="nav-link">E-Pass</a>
          </li> -->
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
          <h1><i class="fas fa-edit" style="color: #27a9e1d7;"></i> EPass Data Entry</h1>
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
        <form action="epass.php" class="" method="POST" enctype="multipart/form-data">
          <div class="card bg-secondary text-light mb-2 mt-5">
            <div class="class-header">
              <h1>Add New EPass Entry</h1>
            </div>
            <div class="card-body bg-dark">
            <div class="form-group">
                <label for="id"><span class="FieldInfo"> Id: </span></label>
                <input type="text" class="form-control" name="id" id="ID" placeholder="Type ID Number here">
              </div>
              <div class="form-group">
                <label for="VNo"><span class="FieldInfo"> Vehicle Number: </span></label>
                <input type="text" class="form-control" name="VNo" id="VNo" placeholder="Type Vehicle Number here">
              </div>
              <div class="form-group">
                <label for="Name"><span class="FieldInfo"> Name: </span></label>
                <input type="text" class="form-control" name="Name" id="Name" placeholder="Type Name here">
              </div>
            
              <div class="form-group">
                <label for="Vtype"><span class="FieldInfo"> Vehicle Type: </span></label>
                <input type="text" class="form-control" name="Vtype" id="Vtype" placeholder="Type Vehicle Type here">
              </div>
              <div class="form-group">
                <label for="Add"><span class="FieldInfo"> Additional Passengers: </span></label>
                <input type="text" class="form-control" name="Add" id="Add" placeholder="Type No.of Additional Passenger here">
                <small class="text-danger">*If Any</small>
              </div>
              <div class="form-group">
                <label for="Reason"><span class="FieldInfo"> Reason For Travel: </span></label>
                <input type="text" class="form-control" name="Reason" id="Reason" placeholder="Type Reason here">
              </div>
              <div class="form-group">
                <label for="Ft"><span class="FieldInfo"> From and To: </span></label>
                <input type="text" class="form-control" name="Ft" id="Ft" placeholder="Type From and To here">
              </div>
              <div class="form-group">
                <label for="Till"><span class="FieldInfo"> Valid-Till: </span></label>
                <input type="date" class="form-control" name="Till" id="Till" placeholder="Type Vehicle Type here">
              </div>
              <div class="form-group  mb-4">
                <label for="edoc"><span class="FieldInfo"> Original Document </span></label>
                <div class="custom-file">
                  <input class="custom-file-input" type="file" name="Epass" id="edoc" value="">
                  <label for="edoc" class="custom-file-label"> Upload Your E-Pass</label>
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