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
  <link rel="stylesheet" href="css/style.css">
  <title>User Document</title>
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
          <!-- <li class="nav-item">
            <a href="AddDoc.php" class="nav-link text-success">Documents</a>
          </li> -->
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
  <header class="bg-dark text-white py-3 ">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fas fa-file-alt"  style="color: #27a9e1d7;"></i> My Documents</h1>
        </div>
        <div class="col-lg-3 mb-2">
          <a href="licenceDoc.php" class="btn btn-primary btn-block">
            <i class="fas fa-edit"></i> Licence Documents
          </a>
        
        </div>
        <div class="col-lg-3 mb-2">
          <a href="VehicleDoc.php" class="btn btn-info btn-block">
            <i class="fas fa-folder-plus"></i> Vehicle Documents
          </a>
        </div>
        <div class="col-lg-3 mb-2">
          <a href="officerDoc.php" class="btn btn-warning btn-block">
            <i class="fas fa-user-plus"></i> User Documents
          </a>
        </div>
        <div class="col-lg-3 mb-2">
          <a href="Admin.php" class="btn btn-success btn-block">
            <i class="fas fa-users-cog"></i> Add Admin
          </a>
        </div>
        
      </div>
    </div>
  </header>
  <!-- header over -->
  <br>
<!-- main area -->
  <section class="container py-2 mb-4">
    <div class="row">
      <div class="col-lg-12">
      <?php 
        echo ErrorMessage();
        echo SuccessMessage();
        ?>
        <table class="table table-striped table-hover">
          <thead class="thead-dark">
            <tr>
              
              <th>#</th>
              <th>Id</th>
              <th>Date and Time</th>
              <th>UserName</th>
              <th>Officer Name</th>
              <th>Password</th>
              
              <th>AddedBy</th>
              <th>Action</th>
              <th></th>
              
            </tr>
          </thead>
            <?php
          $ConnectingDB;
          
          $sql="select * from officer";
          $stmt = $ConnectingDB->query($sql);
          // to print numbers instead of # place
          $Sr = 0; //serial number

          // fetch data from database
          while($DataRows = $stmt->fetch()) {
            $Id           = $DataRows["Id"];
            $DateTime     = $DataRows["DateTime"];
            $UserName     = $DataRows["username"];
            $Name         = $DataRows["name"];
            $Password     = $DataRows["password"];
            $AddedBy      = $DataRows["AddedBy"];
            
            $Sr++;
            
         
          ?>
          <tbody>
            
            <tr>
              <td><?php echo $Sr; ?></td>
              <td><?php echo $Id; ?></td>
              <td>
                <?php echo $DateTime; ?>
              </td>
              <td>
                <?php echo $UserName; ?></td>
              <td>
                <?php if (empty($Name)) {
                  echo "NA";
                }else{ echo $Name; }?></td>
              <td>
                <?php echo $Password; ?></td>
              
                <td><?php echo $AddedBy?> </td>
                
              <td>
                <a href="officerEdit.php?Id=<?php echo $Id?>"><span class="btn btn-warning">Edit</span></a>
              </td>
              <td>
                
              
            </tr>
          </tbody>
          <!-- should end while loop just before table after all td to display all rows -->
          <?php } ?>          
        </table>
      </div>
  </div>
  </section>
<br>

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