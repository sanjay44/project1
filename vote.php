<?php
  session_start();
  require('header.php');
  require('connect.php');

  $voterNo = $_SESSION["voter"];
  $res1 = mysqli_query($con, "SELECT voterIsApproved FROM voter WHERE voterNo = '$voterNo'");
  $fetchedData = mysqli_fetch_assoc($res1);

  $res3 = '';
  $electionID = '';

  if(isset($_GET['id'])) {
    $electionID = $_GET['id'];
    $res3 = mysqli_query($con, "SELECT * FROM participated WHERE electionID='$electionID'");
  }
  $res4 = mysqli_query($con, "SELECT * FROM election");

  if(isset($_POST['finalVote'])) {
    $votedCan = mysqli_real_escape_string($con, $_POST['voters']);
    
    $res6 = mysqli_query($con, "SELECT votes FROM participated WHERE electionID='$electionID' AND canID='$votedCan'");
    $votes = mysqli_fetch_array($res6);
    $votesCount = $votes[0] + 1;
    $res5 = mysqli_query($con, "UPDATE participated SET votes='$votesCount' WHERE electionID='$electionID' AND canID='$votedCan'");

    // ************** CHANGED CODE ******************
    
    if($res5) {
      $electionID = $_GET['id'];
      $res8 = mysqli_query($con, "SELECT * FROM status WHERE sElectionID='$electionID' AND sVoterNo='$voterNo'");
      if($res8) {
        $p = mysqli_num_rows($res8);
        if($p == 0) {
          mysqli_query($con, "INSERT INTO status(sElectionID, sVoterNo, status) VALUES('$electionID', '$voterNo', 0) ");
        }
      }
      $res7 = mysqli_query($con, "UPDATE status SET status=1 WHERE sElectionID='$electionID' AND sVoterNo='$voterNo'");
    }
      
    // **********************************************
  }

  


?>

<div class="collapse navbar-collapse justify-content-end" id="collapsibleNavId">
      <ul class="navbar-nav mt-2 mt-lg-0" style="font-size: 14px;">
        <li class="nav-item mr-2">
          <a class="nav-link" href="dashboard.php">DASHBOARD</a>
        </li>
        <li class="nav-item mr-2 active">
          <a class="nav-link" href="vote.php">VOTE</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo strtoupper($_SESSION['voterFirstName']); ?></a>
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

<?php
  if(!$fetchedData['voterIsApproved']) { ?>

    <section class="vote-danger" style="margin-bottom: 400px;">
      <div class="container">
        <div class="alert alert-danger mt-4" role="alert">
          <h4 class="alert-heading">You are not Approved to vote</h4>
          <hr>
          <p>You are not approved to cast vote due to invalid information provided by you.</p>
          <p class="mb-0">In case, all the information provided by you is correct, please wait for Approval.</p>
      </div>
      </div>
    </section>

<?php }
    $res8 = mysqli_query($con, "SELECT status FROM status WHERE sElectionID='$electionID' AND sVoterNo='$voterNo'");
    $status = mysqli_fetch_array($res8);
    $statusX = $status[0];
    if(isset($_GET['id'])) {
      if($statusX == 0) {
?>

    <section class="notice">
  <div class="container mt-4">
    <div class="alert alert-info" role="alert">
      <h5>Important Notice</h5><hr>
      <p>You can vote only once. Vote Wisely!</p>
  </div>
  </div>
</section>

<section class="vote">
  <form action="vote.php?id=<?php echo $electionID; ?>" method="post">
    <h5>Select any one</h5>
    <br>
      <?php 
      while ($fetchedData = mysqli_fetch_assoc($res3)) {
        $canID = $fetchedData['canID'];
        $res4 = mysqli_query($con, "SELECT * FROM candidate WHERE canID='$canID'");
        $fetchedCandidate = mysqli_fetch_assoc($res4);
      ?>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="voters" id="<?php echo $canID; ?>" value="<?php echo $canID; ?>" required>
          <label class="form-check-label ml-2" for="<?php echo $canID; ?>">
            <?php echo $fetchedCandidate['canName']." (".$fetchedCandidate['canParty'].")"; ?>
          </label>
        </div>  
      <?php } ?>
    <button type="button" class="btn btn-success btn-block mt-4" data-toggle="modal" data-target="#exampleModalCenter" name="submit">Vote</button>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Caution</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            You have only one chance to vote. <br>
            Are you sure you want to vote first option ?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" name="finalVote">Vote</button>
          </div>
        </div>
      </div>
    </div>

  </form>
</section>

<?php
      }
      else { ?>
        <section>
          <div class="container">
            <div class="jumbotron jumbotron-fluid bg-success rounded text-light text-center" style="margin: 180px 300px; box-shadow: 6px 10px 10px #aaa;">
              <div class="container">
                <h1 class="display-4">Thanks for voting!</h1><hr>
                <p class="lead">Your vote has been successfully casted.</p>
              </div>
            </div>
          </div>
        </section>
     <?php }
  } 
  else {
?>   <div class="container">
      <div class="card my-4">
        <div class="card-header bg-dark text-white">Election News</div>
        <ul class="list-group list-group-flush" style="max-height: 250px; overflow-y: scroll;">
          <?php while ($fetchedElection = mysqli_fetch_assoc($res4)) {
            $id = $fetchedElection['electionID']; ?>
            <li class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                  <h6 class="mb-1 font-weight-bold"><?php echo $fetchedElection['electionTitle']; ?></h6>
                  <div>
                    <a href="eDetail.php?id=<?php echo $id; ?>" class="btn btn-info btn-sm">More Details</a>
                    <?php if ($fetchedData['voterIsApproved']) { ?>
                    <a href="vote.php?id=<?php echo $id; ?>" class="btn btn-success btn-sm">Vote</a> <?php 
                                                                                                  } ?>
                  </div>
                </div>
                <small class="text-muted"><?php echo "START:" . $fetchedElection['startDate'] . "<br> END:" . $fetchedElection['endDate']; ?></small>
            </li>
          <?php 
        } ?>
        </ul>
      </div>
    </div>

<?php } ?>
<?php
  require('footer.php');
?>