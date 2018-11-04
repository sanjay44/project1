<?php
  session_start();
  require('connect.php');
  require('header.php');
  $electionID = $_GET['id'];

  $voterNo = $_SESSION["voter"];
  $res1 = mysqli_query($con, "SELECT * FROM voter WHERE voterNo = '$voterNo'");
  $fetchedData = mysqli_fetch_assoc($res1);

  $voterFirstName = explode(' ', trim($fetchedData['voterName']))[0];
  $_SESSION["voterFirstName"] = $voterFirstName;

  $res2 = mysqli_query($con, "SELECT * FROM election WHERE electionID='$electionID'");
  $fetchedElection = mysqli_fetch_assoc($res2);

?>
<div class="collapse navbar-collapse justify-content-end" id="collapsibleNavId">
      <ul class="navbar-nav mt-2 mt-lg-0" style="font-size: 14px;">
        <li class="nav-item mr-2 active">
          <a class="nav-link" href="dashboard.php">DASHBOARD</a>
        </li>
        <li class="nav-item mr-2">
          <a class="nav-link" href="vote.php">VOTE</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo strtoupper($voterFirstName); ?></a>
          <div class="dropdown-menu mt-3 nav-dropdown">
            <a class="dropdown-item" href="update.php">UPDATE PROFILE</a>
            <a class="dropdown-item" href="changepwd.php">CHANGE PASSWORD</a>
            <a class="dropdown-item" href="deleteAccount.php">DELETE ACCOUNT</a>            
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="logout.php">LOGOUT</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<section style="height: 600px;">
  <div class="container">
    <div class="row">
      <ul class="list-group mt-4"  style="width: 100%;">
        <li class="list-group-item">
          <div class="row">
            <div class="col-4"><h4 class="text-success font-weight-bold">Election Details</h4></div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="row">
            <div class="col-4 font-weight-bold">Election Title</div>
          <div class="col-8"><?php echo $fetchedElection['electionTitle']; ?></div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="row">
            <div class="col-4 font-weight-bold">Election Start Time</div>
          <div class="col-8"><?php echo $fetchedElection['startDate']; ?></div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="row">
            <div class="col-4 font-weight-bold">Election End Time</div>
          <div class="col-8"><?php echo $fetchedElection['endDate']; ?></div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="row">
            <div class="col-4 font-weight-bold">Contesting Candidates</div>
          </div>
        </li>
        <li class="list-group-item">
          <table class="table">
            <thead class="thead-secondary">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Gender</th>
                <th scope="col">DOB</th>
                <th scope="col">City</th>
                <th scope="col">Party</th>          
              </tr>
            </thead>
            <tbody>   
            <?php
            $i = 1;
            $res3 = mysqli_query($con, "SELECT * FROM participated WHERE electionID='$electionID'");

            while ($fetchedData = mysqli_fetch_assoc($res3)) {
              $canID = $fetchedData['canID'];
              $res4 = mysqli_query($con, "SELECT * FROM candidate WHERE canID='$canID'");
              $fetchedCandidate = mysqli_fetch_assoc($res4);

              echo '<tr><td>' . $i . '</td><td>' . $fetchedCandidate['canName'] . '</td><td>' . $fetchedCandidate['canGender'] . '</td><td>' . $fetchedCandidate['canDob'] . '</td><td>' . $fetchedCandidate['canCity'] . '</td><td>' . $fetchedCandidate['canParty'] . '</td></tr>';
              $i++;
            }
            ?>
            </tbody>
          </table>
        </li>
        <li class="list-group-item bg-success text-light">
          <div class="row">
            <div class="col-4 font-weight-bold">Winner</div>
          <div class="col-8">
            <?php 
              $res5 = mysqli_query($con, "SELECT canID FROM participated WHERE electionID='$electionID' AND votes = (SELECT MAX(votes) FROM participated WHERE electionID='$electionID')");
              $fetchedWinner = mysqli_fetch_array($res5);
              $canWinner = $fetchedWinner[0];

              $res6 = mysqli_query($con, "SELECT canName FROM candidate WHERE canID='$canWinner'");
              $fetchedName = mysqli_fetch_array($res6);
              echo $fetchedName[0];
            ?>
          </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</section>



<?php
  require('footer.php');
?>