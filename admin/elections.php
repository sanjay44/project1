<?php
  require('../connect.php');

  $msg = '';
  $flag = 0;

  if(isset($_POST['add-election'])) {
    $electionTitle = mysqli_real_escape_string($con, $_POST['electionTitle']);
    $startDate = mysqli_real_escape_string($con, $_POST['startDate']);
    $endDate = mysqli_real_escape_string($con, $_POST['endDate']);
    $candidates = $_POST['candidates'];

    if($startDate >= $endDate) {
      $msg = "Start date should be before end date";
      $flag = 1;
    }
    else if ($startDate <= date("Y-m-d h:i")) {
      $msg = "Start date should be in future";
      $flag = 1;
    }
    else {
      $res = mysqli_query($con, "INSERT INTO election(electionTitle, startDate, endDate) VALUES('$electionTitle', '$startDate', '$endDate')");

      if($res) {
        $msg = "Election Added";
        $flag = 0;

        $lastElectionID = mysqli_insert_id($con);

        foreach ($candidates as $canID) {
          $res2 = mysqli_query($con, "INSERT INTO participated(electionID, canID, votes) VALUES('$lastElectionID', '$canID', 0)");
        }

        $res3 = mysqli_query($con, "SELECT voterNo FROM voter WHERE voterID != 'ADMIN' AND voterID != 'ALL'");

        while ($fetchedVoter = mysqli_fetch_assoc($res3)) {
          $voter = $fetchedVoter['voterNo'];
          $res4 = mysqli_query($con, "INSERT INTO status(sElectionID, sVoterNo, status) VALUES('$lastElectionID', '$voter',0)");
        }

      }
      else {
        $msg = "Attempt Failed";
        $flag = 1;
      }
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
        <li class="list-group-item menu-items">
          <div class="menu-icon mt-1">
            <i class="fas fa-address-card float-right"></i>
          </div>
          <div class="menu-text">
            <a href="./candidates.php">CANDIDATES</a>
          </div>
        </li>
        <li class="list-group-item menu-items active-menu">
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
    <div class="card ml-2" style="width: 60%">
      <div class="card-header bg-info text-light">
        Add Election
      </div>
      <div class="card-body">
        <?php
        if ($msg && $flag) {
          echo '<div class="alert alert-danger" role="alert">' . $msg . '</div>';
        } else if ($msg && !$flag) {
          echo '<div class="alert alert-success" role="alert">' . $msg . '</div>';
        }
        ?>  
        <form action="elections.php" method="post">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Title" name="electionTitle" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Start Time</label>
            <div class="col-sm-10">
              <input type="datetime-local" class="form-control" name="startDate" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">End Time</label>
            <div class="col-sm-10">
              <input type="datetime-local" class="form-control" name="endDate" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Select Four Candidates</label>
            <div class="col-sm-10">
              <select name="candidates[]" multiple="multiple" style="width: 100%;" required>
                <?php
                  $res2 = mysqli_query($con, "SELECT canID, canName, canParty FROM candidate");
                  while($fetchedData = mysqli_fetch_assoc($res2)) {
                    echo '<option value="'.$fetchedData['canID'].'">'.$fetchedData['canName'].'-'.$fetchedData['canParty'].'</option>';
                  } 
                ?>
              </select>
            </div>
            <small class="card-text ml-3">Use Ctrl button to select multiple candidates</small>
          </div>
          <button type="submit" class="btn btn-primary" name="add-election">Add</button>
        </form>
      </div>
    </div>
  </section>

  </body>
  </html>