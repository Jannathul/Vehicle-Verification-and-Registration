<?php require_once("../includes/DB.php");?>
<?php require_once("../includes/Functions.php");?>
<?php require_once("../includes/Session.php");?>
<?php $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
// echo $_SESSION["TrackingURL"];
Confirm_Login(); ?>
<?php
$SarchQueryParameter=$_GET['ID'];
if(isset($_POST["Submit"])){
  $LicenceNum = $_POST["LicenceNumber"];
  $LName = $_POST["Name"];
  $VehicleType = $_POST["VehicleType"];
  $LValidity = $_POST["Validity"];
  $BirthDate = $_POST["BirthDate"];
  $LPhoto = $_FILES["LPhoto"]["name"];
  $LDoc = $_FILES["LDoc"]["name"];
  // image will be in this folder
  $Target ="../Photos/".basename($_FILES["LPhoto"]["name"]);
  $DocTarget ="../Photos/".basename($_FILES["LDoc"]["name"]);
  $AddedBy = $_SESSION["AdminName"];


  // DateTime
  $CurrentTime = new DateTime();  
  $CurrentTime->setTimezone(new DateTimeZone('Asia/Kolkata'));
  $DateTime = $CurrentTime->format("Y-m-d H:i:s");  
  echo $DateTime;
  
  if(empty($LicenceNum)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to('LicenceEdit.php?ID=<?php echo $SarchQueryParameter;?>');
  }
  
  else{
    global $ConnectingDB;
    // Update Licence
    $sql="UPDATE licence SET Licence_Number='$LicenceNum' , LName='$LName', Vehicle_Type='$VehicleType', Valid_Till='$LValidity', Birth_Date='$BirthDate', Licence_Photo='$LPhoto', Licence_Document='$LDoc' WHERE ID='$SarchQueryParameter'";
    $Execute=$ConnectingDB->query($sql);
    move_uploaded_file($_FILES["LPhoto"]["tmp_name"],$Target); //to upload image
    move_uploaded_file($_FILES["LDoc"]["tmp_name"],$DocTarget); //to upload image
    
    // to check what mistake have done
    // var_dump($Execute);
    if($Execute){
      $_SESSION["SuccessMessage"]= "Licence Entry is Updated Successfully";
      Redirect_to('licenceDoc.php');

    }
    else{
      $_SESSION["ErrorMessage"]= "Error: All fields must be filled out";
    Redirect_to("licenceDoc.php");
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
  <title>Edit Licence</title>
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
          <!-- <li class="nav-item">
            <a href="Licence.php" class="nav-link">Licence</a>
          </li> -->
          <li class="nav-item">
            <a href="Rc_Book.php" class="nav-link">RC Book</a>
          </li>
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
          <h1><i class="fas fa-edit" style="color: #27a9e1d7;"></i> Licence Data Entry</h1>
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

        // fetching existing data 
        global $ConnectingDB;
        $sql = "SELECT * FROM licence WHERE ID='$SarchQueryParameter'";
        $stmt = $ConnectingDB ->query($sql);
        while($DataRows=$stmt->fetch()){
          $NoToBeUpdated   = $DataRows['Licence_Number'];
          $NameToBeUpdated= $DataRows['LName'];
          $TypeToBeUpdated= $DataRows['Vehicle_Type'];
          $ValidityToBeUpdated= $DataRows['Valid_Till'];
          $BirthDateToBeUpdated= $DataRows['Birth_Date'];
          $PhotoToBeUpdated= $DataRows['Licence_Photo'];
          $DocToBeUpdated= $DataRows['Licence_Document'];
          

        }
        ?>
        <form action="LicenceEdit.php?ID=<?php echo $SarchQueryParameter;?>" class="" method="POST" enctype="multipart/form-data">
          <div class="card bg-secondary text-light mb-2 mt-5">
            <div class="class-header">
              <h1>Edit Licence Entry</h1>
            </div>
            <div class="card-body bg-dark">
              <div class="form-group">
                <label for="lno"><span class="FieldInfo"> Licence Number: </span></label>
                <input type="text" class="form-control" name="LicenceNumber" id="lno" placeholder="Type Licence Number here" value="<?php echo $NoToBeUpdated?>">
              </div>
              <div class="form-group">
                <label for="name"><span class="FieldInfo"> Name: </span></label>
                <input type="text" class="form-control" name="Name" id="name" placeholder="Type Name here" value="<?php echo $NameToBeUpdated?>">
              </div>
              
              <div class="form-group">
                <label for="type"><span class="FieldInfo"> Vehicle Type: </span></label>
                <input type="text" class="form-control" name="VehicleType" id="type" placeholder="Type with/without gear here" value="<?php echo $TypeToBeUpdated?>">
              </div>
              <div class="form-group">
                <span class="FieldInfo">Existing Valid Date:</span>
                <?php echo $ValidityToBeUpdated?><br>
              
                <label for="validity"><span class="FieldInfo"> Valid Till: </span></label>
                <input type="date" class="form-control" name="Validity" id="validity" placeholder="Type Validity here" value="">
              </div>
            
              <div class="form-group">
                <label for="DoB"><span class="FieldInfo"> D.O.B: </span></label>
                <input type="text" class="form-control" name="BirthDate" id="DoB" placeholder="Type Date of birth here" value="<?php echo $BirthDateToBeUpdated?>">
              </div>
              <div class="form-group  mb-4">
              <span class="FieldInfo">Existing Photo:</span>
              <img src="../photos/<?php echo $PhotoToBeUpdated;?>" width="170px"; height="70px"; >
              <br>
                <label for="LPhoto"><span class="FieldInfo"> Choose Photo </span></label>
                <div class="custom-file">
                  <input class="custom-file-input" type="file" name="LPhoto" id="LPhoto" value="">
                  <label for="LPhoto" class="custom-file-label"> Holder Image</label>
                </div>
              </div>
              <span class="FieldInfo">Existing Licence Document:</span>
              <img src="../photos/<?php echo $DocToBeUpdated?>" width="170px"; height="70px"; ><br>
              <div class="form-group  mb-4">
                <label for="ldoc"><span class="FieldInfo"> Choose Licence Document </span></label>
                <div class="custom-file">
                  <input class="custom-file-input" type="file" name="LDoc" id="ldoc" value="">
                  <label for="LDoc" class="custom-file-label"> Document Image</label>
                </div>
              </div>
              
              <div class="row">
                <div class="col-lg-6 mb-2">
                  <a href="AddDoc.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                </div>
                <div class="col-lg-6 mb-2">
                  <button type="submit" name="Submit" class="btn btn-success btn-block">
                  <i class="fas fa-check"></i> Update
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