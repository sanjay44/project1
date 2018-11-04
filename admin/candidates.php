<?php
  require('../connect.php');

  $msg = '';
  $flag = 0;

  $msg1 = '';
  $flag1 = 0;

  if(isset($_POST['addCandidate'])) {

    $canName = mysqli_real_escape_string($con, $_POST['canName']);
    $canDob = mysqli_real_escape_string($con, $_POST['canDob']);
    $canPhone = mysqli_real_escape_string($con, $_POST['canPhone']);
    $canGender = mysqli_real_escape_string($con, $_POST['canGender']);
    $canCity = mysqli_real_escape_string($con, $_POST['canCity']);
    $canAddress = mysqli_real_escape_string($con, $_POST['canAddress']);
    $canParty = mysqli_real_escape_string($con, $_POST['canParty']);

    if (!preg_match("/^\d{10}$/", $canPhone)) {
      $msg = 'Please enter 10 digit Phone number only.';
      $flag = 1;
    }
    else {

      $res = mysqli_query($con, "INSERT INTO candidate(canName, canDob, canPhone, canGender, canCity, canAddress, canParty) VALUES('$canName', '$canDob', '$canPhone', '$canGender', '$canCity', '$canAddress', '$canParty');");
      if ($res) {
        $msg = "Candidate Added";
        $flag = 0;
      } else {
        $msg = 'Attempt Failed';
        $flag = 1;
      }
    }

  }

  if(isset($_POST['delCandidate'])) {
    $canID = mysqli_real_escape_string($con, $_POST['canID']);

    $res2 = mysqli_query($con, "DELETE FROM candidate WHERE canID='$canID'");

    if($res2) {
      $msg1 = "Candidate Deleted";
      $flag1 = 0;
    }
    else {
      $msg1 = "Attempt Failed";
      $flag1 = 1;
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="../assets/fontawesome/fontawesome-all.js"></script>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <title>Voting System</title>
</head>
<body>
  <nav class="navbar navbar-expand-sm navbar-dark fixed-top" style="background-color: #218F76;">
      <a class="navbar-brand" href="#" style="font-size: 18px;"><img src="../assets/images/vote-green.svg" alt="logo" class="mr-2 mb-1" id="hello"><strong>ONLINE VOTING SYSTEM <span class="admin-panel">ADMIN PANEL</span></strong></a>
      <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
  </nav>

  <section class="side-menu">
    <div>
      <ul class="list-group list-group-flush menu-ul">
        <li class="list-group-item menu-items">
          <div class="menu-icon mt-1">
            <i class="fas fa-tachometer-alt float-right"></i>
          </div>
          <div class="menu-text">
            <a href="./dashboard.php">DASHBOARD</a>
          </div>
        </li>
        <li class="list-group-item menu-items">
          <div class="menu-icon mt-1">
            <i class="fas fa-envelope float-right"></i>
          </div>
          <div class="menu-text">
            <a href="./message.php">MESSAGES</a>
          </div>
        </li>
        <li class="list-group-item menu-items">
          <div class="menu-icon mt-1">
            <i class="fas fa-users float-right"></i>
          </div>
          <div class="menu-text">
            <a href="./voters.php">VOTERS</a>
          </div>
        </li>
        <li class="list-group-item menu-items active-menu">
          <div class="menu-icon mt-1">
            <i class="fas fa-address-card float-right"></i>
          </div>
          <div class="menu-text">
            <a href="./candidates.php">CANDIDATES</a>
          </div>
        </li>
        <li class="list-group-item menu-items">
          <div class="menu-icon mt-1">
            <i class="fas fa-plus-circle float-right"></i>
          </div>
          <div class="menu-text">
            <a href="elections.php">ADD ELECTION</a>
          </div>
        </li>
      </ul>
    </div>
    <div class="admin-overlay">
      <img src="../assets/images/admin1.png" alt="no admin">
    </div>
  </section>

  <section class="content">
      <div class="card border-secondary" style="width: 60%;">
        <h5 class="card-header bg-secondary text-light">All Candidates</h5>
        <div class="card-body" style="max-height: 300px; overflow-y:scroll;">
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">Candidate ID</th>
                <th scope="col">Name</th>
                <th scope="col">Party</th>
              </tr>
            </thead>
            <tbody>   
            <?php
            $res1 = mysqli_query($con, "SELECT canID, canName, canParty FROM candidate");
            while ($fetchedData = mysqli_fetch_assoc($res1)) {
              echo '<tr><td>' . $fetchedData['canID'] . '</td><td>' . $fetchedData['canName'] . '</td><td>' . $fetchedData['canParty'] . '</td></tr>';
            }
            ?>
            </tbody>
          </table>
        </div>
    </div>
  </section>


  <section class="content">
    <div class="card border-primary" style="width: 60%">
      <h5 class="card-header bg-primary text-light">Add Candidates</h5>
      <div class="card-body">
        <?php
        if ($msg && $flag) {
          echo '<div class="alert alert-danger" role="alert">' . $msg . '</div>';
        } else if ($msg && !$flag) {
          echo '<div class="alert alert-success" role="alert">' . $msg . '</div>';
        } 
        ?>
        <form action="candidates.php" method="post">
          <div class="form-group row">
          <label for="canName" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
            <input type="text" id="canName" name="canName" placeholder="Enter Candidate Name" class="form-control" required>
          </div> 
        </div>
        <div class="form-group row">
          <label for="canDob" class="col-sm-2 col-form-label">DOB</label>
          <div class="col-sm-10">
            <input type="date" id="canDob" name="canDob" placeholder="Enter Candidate DOB" class="form-control" required>
          </div> 
        </div>
        <div class="form-group row">
          <label for="canGender" class="col-sm-2 col-form-label">Gender</label>
          <div class="col-sm-10 mt-2">
            <input type="radio" name="canGender" id="canGender" value="male" checked> Male
            <input type="radio" name="canGender" id="canGender" value="female"> Female
          </div> 
        </div>
        <div class="form-group row">
          <label for="canPhone" class="col-sm-2 col-form-label">Phone</label>
          <div class="col-sm-10">
            <input type="text" id="canPhone" name="canPhone" placeholder="Enter Candidate Phone" class="form-control" required>
          </div> 
        </div>
        <div class="form-group row">
          <label for="canCity" class="col-sm-2 col-form-label">City</label>
          <div class="col-sm-10">
            <input type="text" id="canCity" name="canCity" placeholder="Enter Candidate City" class="form-control" required>
          </div> 
        </div>
        <div class="form-group row">
          <label for="canAddress" class="col-sm-2 col-form-label">Address</label>
          <div class="col-sm-10">
            <textarea name="canAddress" id="canAddress" rows="4" placeholder="Enter address" class="form-control"></textarea>
          </div> 
        </div>
        <div class="form-group row">
          <label for="canParty" class="col-sm-2 col-form-label">Party</label>
          <div class="col-sm-10">
            <input type="text" id="canParty" name="canParty" placeholder="Enter Candidate Party" class="form-control" required>
          </div> 
        </div>
        <input type="submit" value="Add Candidate" class="btn btn-primary float-right" name="addCandidate">
     </div>
        </form>
        </div>
  </section>

  <section class="content mb-4">
      <div class="card border-danger" style="width: 60%;">
        <h5 class="card-header bg-danger text-light">Delete Candidate</h5>
        <div class="card-body">
          <?php
          if ($msg1 && $flag1) {
            echo '<div class="alert alert-danger" role="alert">' . $msg1 . '</div>';
          } else if ($msg1 && !$flag1) {
            echo '<div class="alert alert-success" role="alert">' . $msg1 . '</div>';
          }
          ?>
          <form action="candidates.php" method="post">
            <div class="form-group row">
              <label for="canID" class="col-sm-2 col-form-label">Candidate ID</label>
              <div class="col-sm-10">
                <input type="text" id="canID" name="canID" placeholder="Enter Candidate ID" class="form-control" required>
              </div> 
            </div>
            <input type="submit" value="Delete" class="btn btn-danger float-right" name="delCandidate">
          </form>
        </div>
    </div>
  </section>
    </body>
  </html>