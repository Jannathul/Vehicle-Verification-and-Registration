<?php require_once("../includes/DB.php");?>
<?php require_once("../includes/Functions.php");?>
<?php require_once("../includes/Session.php");?>
<?php 
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
// echo $_SESSION["TrackingURL"];
Officer_Confirm_Login(); ?>
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
      <a href="#" class="navbar-brand" style="font-size: 30px;"><i class="fas fa-motorcycle"></i>VehicleInfo.com</a> 
      
      
      
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="Logout.php" class="nav-link text-danger"><i class="fas fa-user-times"></i>Logout</a>
        </li>
      </ul>
    </nav>
    
  </div>
  
  <div style="height: 10px; background: #27a9e1d7;"></div>

    
  <!-- navbar over -->

  <!-- header -->
  
  <!-- header over -->
<!-- main area -->
  <section class="container py-2 mb-4 mt-4">
    <div class="container">
    <div class="row">

    
  <!-- Licence -->
        
  <div class="col-lg-4 ">
          <?php
          $ConnectingDB;
          if (isset($_GET["SearchButton"])) {
            $Search=$_GET["Search"];
            $sql="SELECT * FROM licence 
            WHERE ID LIKE :search 
            OR Licence_Number LIKE :search";
            $stmt = $ConnectingDB->prepare($sql);
            $stmt->bindValue(':search','%'.$Search.'%');
            $stmt->execute();

            
          }
          else{ 
            $IdFromURL = $_GET["ID"];
            $sql="SELECT * FROM licence WHERE ID='$IdFromURL'";
          $stmt = $ConnectingDB->query($sql);
          }
         

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
          <div class="card mb-3"   style=" min-height: 150px;">
          <div class="card-title mt-4">
          <h5><center> Licence </center></h5>
          </div>

          <div class="card-body">
              <div class="container">
                <div class="row">
                  <div class="col-sm-12">
                    <span style="float: right;"><img src="../images/<?php echo htmlentities($LPhoto);?>" alt="$Id image" style="max-width: 80px" class="img-fluid card-img-top" />
                    </span><h6 class="card-title">Licence No:<?php echo $LicenceNum;?></h6></span>
                    <hr>
                    <p class="card-text" style="line-height:1.6">Name: <?php echo $LName;?></p>
                    <p class="card-text" style="line-height:1.6">Type: <?php echo $VehicleType;?></p>
                    <p class="card-text">Valid Till: <?php $Today= date("Y-m-d");$realDate = $LValidity;$newDate = date("d-m-Y", strtotime($realDate));
                     if ($Today<$LValidity) {
                      echo '<span style="font-size:1.25em;color:green">'.$newDate.'</span>';
                     }else{ echo '<span style="font-size:1.25em;color:red">'.$newDate.'</span>'; } ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>






<!-- rcbook and insurance -->


<div class="col-lg-4 mb-4">

<?php
  $ConnectingDB;
  if (isset($_GET["SearchButton"])) {
    $Search=$_GET["Search"];
    
    $sql="SELECT rcbook.*,insurance.* FROM rcbook,insurance 
    WHERE rcbook.ID LIKE :search OR rcbook.Vehicle_Number LIKE :search";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':search','%'.$Search.'%');
    $stmt->execute();

    
  }
  else{ 
    $IdFromURL = $_GET["ID"];
    $sql="SELECT theft.*,rcbook.*,insurance.*
          from theft
          left join rcbook 
          on theft.ID = rcbook.ID
          left join insurance
          on rcbook.ID = insurance.ID 
          WHERE rcbook.ID = '$IdFromURL'
          UNION 
          select theft.*,rcbook.*,insurance.*
          from rcbook
          left join insurance
          on rcbook.ID = insurance.ID
          left join theft
          on rcbook.ID = theft.ID
          WHERE rcbook.ID = '$IdFromURL'
          UNION 
          select theft.*,rcbook.*,insurance.*
          from insurance
          left join rcbook
          on insurance.ID = rcbook.ID
          left join theft
          on insurance.ID = theft.ID 
          WHERE insurance.ID='$IdFromURL'";
  
  $stmt = $ConnectingDB->query($sql);
  }
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
    $VehicleNo    = $DataRows["Vehicle_No"];
    $Dept         = $DataRows["dept"];


    ?>
    <div class="card"  style=" min-height: 150px;">

      <div class="card-title mt-4">
        <h5><center> Vehicle Details </center></h5>
      </div>
      <div class="card-body">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
          <span style="float: right;"><img src="../images/<?php echo htmlentities($Photo);?>" alt="$Id image" style="max-width: 80px" class="img-fluid card-img-top" /></span>
          
          <h6 class="card-title">Vehicle No:<?php if ( $VehicleNum== $VehicleNo) {
            echo '<span style="background:red">'.$VehicleNum.'</span>';
          }
          elseif ($Dept == "Commercial" || $Dept == "commercial" || $Dept == "COMMERCIAL"){
            echo '<span style="background:yellow">'.$VehicleNum.'</span>';
          }
          elseif ($Dept == "Electricity" || $Dept == "electricity" || $Dept == "ELECTRICITY"){
            echo '<span style="background:green">'.$VehicleNum.'</span>';
          }
          else{ echo $VehicleNum;}?></h6>

          
            
            <hr>
            <p class="card-text" style="line-height:1.1">Name: <?php echo $Name;?></p>
            <p class="card-text" style="line-height:1.1">Type: <?php echo $RVehicleType;?></p>
            <p class="card-text" style="line-height:1.1">Model & Make: <?php echo $Make;?></p>
            <p class="card-text" style="line-height:1.1">Registration Date: 
            <?php $newDate = date("d-m-Y", strtotime($Year)); echo $newDate;?></p>
            <p class="card-text" style="line-height:1.1">Reg. Valid Till: 
            <?php $Today= date("Y-m-d");$realDate = $FC;$newDate = date("d-m-Y", strtotime($realDate));
             if ($Today<$FC) {
              echo '<span style="font-size:1.25em;color:green">'.$newDate.'</span>';
             }else{ echo '<span style="font-size:1.25em;color:red">'.$newDate.'</span>'; } ?></span></p>
            <p class="card-text" style="line-height:1.1">Insurance No.: <?php echo $InsuranceNum;?></p>
            <p class="card-text" style="line-height:1.1">Valid Till: <?php $Today= date("Y-m-d");$realDate = $Validity;$newDate = date("d-m-Y", strtotime($realDate));
             if ($Today<$Validity) {
              echo '<span style="font-size:1.25em;color:green">'.$newDate.'</span>';
             }else{ echo '<span style="font-size:1.25em;color:red">'.$newDate.'</span>'; } ?></span></p>


          </div>
        </div>
      </div>
    </div>
    </div>


    <!-- </div> -->
    
    <?php } ?>
  </div>
  
 



        <!-- E-Pass -->
           
      <div class="col-lg-4">

<?php
  $ConnectingDB;
  if (isset($_GET["SearchButton"])) {
    $Search=$_GET["Search"];
    
    $sql="SELECT * FROM epass 
    WHERE epass.ID LIKE :search OR epass.VehicleNumber LIKE :search";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':search','%'.$Search.'%');
    $stmt->execute();

    
  }
  else{ 
    $IdFromURL = $_GET["ID"];
    $sql="SELECT * FROM epass WHERE epass.ID='$IdFromURL'";
    $stmt = $ConnectingDB->query($sql);
  }
  while($DataRows = $stmt->fetch()) {
    $Id            = $DataRows["ID"];
    $VNo           = $DataRows["VehicleNumber"];
    $Pname         = $DataRows["PersonName"];
    $VType         = $DataRows["VehicleType"];
    $Add           = $DataRows["Additional"];
    $Reason        = $DataRows["Reason"];
    $FT            = $DataRows["FromAndTo"];
    $pass          = $DataRows["passvalid"];
    ?>
    <div class="card"  style=" min-height: 150px;">
    <div class="card-title mt-4">
      <h5><center> Special Permission </center></h5>
    </div>
      
      <div class="card-body">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
            <h6 class="card-title">Vehicle No:<?php echo $VNo;?></h6>
            <hr>
            <p class="card-text" style="line-height:1.1">Name: <?php echo $Pname;?></p>
            <p class="card-text" style="line-height:1.1">Vehicle Type: <?php echo $VType;?></p>
            <p class="card-text" style="line-height:1.1">Reason: <?php echo $Reason;?></p>
            <p class="card-text" style="line-height:1.1">From and To: <?php echo $FT;?></p>
            <p class="card-text" style="line-height:1.1">Valid Till: <?php $Today= date("Y-m-d");$realDate = $pass;$newDate = date("d-m-Y", strtotime($realDate));
                     if ($Today<$pass) {
                      echo '<span style="font-size:1.25em;color:green">'.$newDate.'</span>';
                     }else{ echo '<span style="font-size:1.25em;color:red">'.$newDate.'</span>'; } ?></span></p>

          </div>
        </div>
      </div>
    </div>
    </div>

    <?php } ?>
    
  </div>
        
        
        

          <div>

        <!--Original Documents-->
        <div class="col-sm-4 mt-4 mx-2">

<?php
  $ConnectingDB;
 
    $IdFromURL = $_GET["ID"];
    $sql="SELECT * FROM rcbook,epass,licence,theft WHERE rcbook.ID='$IdFromURL' OR epass.ID='$IdFromURL' OR licence.ID='$IdFromURL' OR theft.ID='$IdFromURL'";
 
  $stmt = $ConnectingDB->query($sql);
  
  while($DataRows = $stmt->fetch()) {
    $Id           = $DataRows["ID"];
    $RDoc         = $DataRows["RcBook_Document"];
    $LDoc         = $DataRows["Licence_Document"];
    $Epass        = $DataRows["EPass"];
    $TDoc         = $DataRows["Document"];

  }
    ?>
        <select>
            <option>Choose Documents</option>
            <option value="RCBook">RC Book</option>
            <option value="Licence">Licence</option>
            <option value="EPass">EPass</option>
            <option value="Theft">Additional</option>
        </select>
    </div>
    <!--divs that hide and show-->
    <div class="RCBook box">
    <div class="container">
      <div class="row">
        <div class="col">
          <img src="../images/<?php echo htmlentities($RDoc);?>" alt="$Id RCBook Document" class="img-fluid card-img-top" />
        </div>
      </div>
    </div>
      
    </div>
    <div class="Licence box">
    <div class="container">
      <div class="row">
        <div class="col">
          <img src="../images/<?php echo htmlentities($LDoc);?>" alt="$Id Licence Document" class="img-fluid card-img-top" />
        </div>
      </div>
    </div>
    </div>
    <div class="EPass box">
    <div class="container">
      <div class="row">
        <div class="col">
          <img src="../images/<?php echo htmlentities($Epass);?>" alt="$Id Epass Document" class="img-fluid card-img-top" />
        </div>
      </div>
    </div>
    </div>
    
    <div class="Theft box">
    <div class="container">
      <div class="row">
        <div class="col">
          <img src="../images/<?php echo htmlentities($TDoc);?>" alt="$Id Additional Document" class="img-fluid card-img-top" />
        </div>
      </div>
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
        <p class="text-center small">This is just a project site <br>By Firdouse </p>
        </div>
      </div>
    </div>

  </footer>
  <div style="height: 10px; background: #27a9e1d7;"></div>
  <!-- footer over -->
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script>
        // jQuery functions to hide and show the div
        $(document).ready(function () {
            $("select").change(function () {
                $(this).find("option:selected")
                       .each(function () {
                    var optionValue = $(this).attr("value");
                    if (optionValue) {
                        $(".box").not("." + optionValue).hide();
                        $("." + optionValue).show();
                    } else {
                        $(".box").hide();
                    }
                });
            }).change();
        });
    </script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <script>
    $('#year').text(new Date().getFullYear());
  </script>
</body>
</html>
