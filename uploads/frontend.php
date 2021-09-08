<?php require_once("../includes/DB.php");?>
<?php require_once("../includes/Functions.php");?>
<?php require_once("../includes/Session.php");?>
<?php $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
// echo $_SESSION["TrackingURL"];
Confirm_Login(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <title>Document</title>
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
            <a href="officer.php" class="nav-link">Manage User</a>
          </li>
          <!-- <li class="nav-item">
            <a href="frontend.php" class="nav-link  text-success">Live Preview</a>
          </li> -->
          
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
        <div class="col-sm-8">
          <h1>All Documents</h1>
        </div>
        
          
          </div>
        </form>
      </ul>
      </div>

    </div>
  </header>
  <!-- header over -->
<!-- main area -->
  <section class="container py-2 mb-4 mt-4">
    <div class="container">
      <div class="row">
      <!-- Licence -->
        <div class="offset-sm-1 col-lg-5">
          <h3><center> Licence </center></h3>
          <?php
     
           
          $sql="SELECT * FROM licence";
          $stmt = $ConnectingDB->query($sql);
         
         

          // fetch data from database
          while($DataRows = $stmt->fetch()) {
            $Id           = $DataRows["ID"];
            $LPhoto       = $DataRows["Licence_Photo"];
            $LicenceNum   = $DataRows["Licence_Number"];
            $LName        = $DataRows["LName"];
            $VehicleType  = $DataRows["Vehicle_Type"];
            $LValidity    = $DataRows["Valid_Till"];
            
            // $Sr++;
        
          ?>
          <div class="card"  style=" min-height:max-content;">
            <img src="../images/<?php echo htmlentities($LPhoto);?>" alt="$Id image" style="max-height: 450px" class="img-fluid card-img-top" /></span>
            <div class="card-body">
              <h4 class="card-title"></span><h6 class="card-title">Licence No:<?php echo $LicenceNum;?></h6></span>
                    <hr>
                    <p class="card-text">Name: <?php echo $LName;?></p>
                    <p class="card-text">Type: <?php echo $VehicleType;?></p>
                    <p class="card-text">Valid Till: <?php $Today= date("Y-m-d");$realDate = $LValidity;$newDate = date("d-m-Y", strtotime($realDate));
                     if ($Today<$LValidity) {
                      echo '<span style="font-size:1.25em;color:green">'.$newDate.'</span>';
                     }else{ echo '<span style="font-size:1.25em;color:red">'.$newDate.'</span>'; } ?></p>
              
              <a href="MyProfile.php?ID=<?php echo $Id?>" style="float: right;">
                <span class="btn btn-info">See Full Documents</span>
              </a>
            </div>
          </div><br>
          <?php } ?>
        </div>



        <!-- rcbook and insurance -->


        <div class="col-lg-5">
        <h3><center> RC Book & Insurance </center></h3>

        <?php
          $ConnectingDB;
          
          $sql = "SELECT rcbook.*,insurance.* FROM rcbook,insurance WHERE rcbook.ID = insurance.ID";
          
          $stmt = $ConnectingDB->query($sql);
         
          while($DataRows = $stmt->fetch()) {
            $Id           = $DataRows["ID"];
            $Photo        = $DataRows["Photo"];
            $Name         = $DataRows["Name"];
            $VehicleNum   = $DataRows["Vehicle_Number"];
            $RVehicleType = $DataRows["Vehicle_Type"];
            $Make         = $DataRows["Model_Make"];
            $Year         = $DataRows["Manufacture_Date"];
            $FC           = $DataRows["FC"];
            $InsuranceNum = $DataRows["Insurance_Number"];
            $Validity     = $DataRows["Validity"];
            ?>
            <div class="card"  style=" min-height: 500px;">
              <img src="../images/<?php echo htmlentities($Photo);?>" alt="$Id image" style="max-height: 450px" class="img-fluid card-img-top" /></span>
              <div class="card-body">
                <h6 class="card-title">Vehicle Number:<?php echo $VehicleNum;?></h6>
                <hr>
                    <p class="card-text" style="line-height:1.1">Name: <?php echo $Name;?><span style="float: right;">Type: <?php echo $VehicleType;?></span></p>
                    <p class="card-text" style="line-height:1.1">Model & Make: <?php echo $Make;?></p>
                    <p class="card-text" style="line-height:1.1">Reg. Date: <?php echo $Year;?><span style="float: right;">
                    <p class="card-text" style="line-height:1.1">Reg. Valid Till: 
                    <?php $Today= date("Y-m-d");$realDate = $FC;$newDate = date("d-m-Y", strtotime($realDate));
                     if ($Today<$realDate) {
                      echo '<span style="font-size:1.25em;color:green">'.$newDate.'</span>';
                     }else{ echo '<span style="font-size:1.25em;color:red">'.$newDate.'</span>'; } ?></span></p>
                    <p class="card-text" style="line-height:1.1">Insurance No.: <?php echo $InsuranceNum;?></p>
                    <p class="card-text" style="line-height:1.1">Valid Till: <?php $Today= date("Y-m-d");$realDate = $Validity;$newDate = date("d-m-Y", strtotime($realDate));
                     if ($Today<$realDate) {
                      echo '<span style="font-size:1.25em;color:green">'.$newDate.'</span>';
                     }else{ echo '<span style="font-size:1.25em;color:red">'.$newDate.'</span>'; } ?></span></p>
                     
                     <a href="MyProfile.php?ID=<?php echo $Id?>" style="float: right;">
                <span class="btn btn-info">See Full Documents</span></a>
              </div>
            </div><br>
            <?php } ?>
          </div>
        </div>
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