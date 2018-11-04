<?php
  session_start();
  require('header.php');
  require('connect.php');

  $msg = '';
  $flag = 0;

  $voterNo = $_SESSION["voter"];
  $res1 = mysqli_query($con, "SELECT voterIsApproved FROM voter WHERE voterNo = '$voterNo'");
  $fetchedVoter = mysqli_fetch_assoc($res1);

  $voterNo = $_SESSION["voter"];
  $res1 = mysqli_query($con, "SELECT * FROM voter WHERE voterNo = '$voterNo'");
  $fetchedData = mysqli_fetch_assoc($res1);

  $voterFirstName = explode(' ', trim($fetchedData['voterName']))[0];
  $_SESSION["voterFirstName"] = $voterFirstName;


  $res3 = mysqli_query($con, "SELECT * FROM message WHERE msgReceiver='$voterNo' OR msgReceiver=0 ORDER BY msgID DESC");

  $res4 = mysqli_query($con, "SELECT * FROM election");

  if(isset($_POST['sendMessage'])) {
    $msgSubject = mysqli_real_escape_string($con, $_POST['msgSubject']);
    $msgMsg = mysqli_real_escape_string($con, $_POST['msgMsg']);
    date_default_timezone_set("Asia/Calcutta");
    $curDate = date("Y-m-d");

    $res5 = mysqli_query($con, "INSERT INTO message(msgSender, msgReceiver, msgSubject, msgMsg, dateSent) VALUES('$voterNo', 11, '$msgSubject', '$msgMsg', '$curDate')");

    if($res5) {
      $msg = 'Message sent';
      $flag = 0;
    }
    else {
      $msg = 'Attempt Failed';
      $flag = 1;
    }
  }
  
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
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo strtoupper($voterFirstName);  ?></a>
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


<section class="voter-profile">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="card profile-card" style="width: 22rem;">
          <img class="card-img-top" style="padding: 40px;" src="assets/images/<?php 
            if($fetchedData['voterGender'] === 'male') {
              echo 'man.svg';
            }
            else {
              echo 'girl.svg';
            }
          ?>" alt="Card image cap">
          <div class="card-body text-white bg-secondary">
            <h5 class="card-title font-weight-bold mb-4"><?php echo strtoupper($fetchedData['voterName']); ?></h5>
            <h6 class="card-subtitle mb-2" style="font-size: 14px;"><?php echo strtoupper($fetchedData['voterID']); ?></h6>
          </div>
          <ul class="list-group list-group-flush" style="font-size: 14px;">
            <li class="list-group-item status <?php echo $fetchedData['voterIsApproved']?'bg-success':'bg-danger'; ?>">
            <?php echo $fetchedData['voterIsApproved'] ? 'APPROVED' : 'NOT APPROVED'; ?></li>
            <li class="list-group-item"><?php echo ucfirst($fetchedData['voterCity']); ?></li>
            <li class="list-group-item"><?php echo $fetchedData['voterEmail']; ?></li>
            <li class="list-group-item"><?php echo $fetchedData['voterPhone']; ?></li>
            <li class="list-group-item"><?php echo $fetchedData['voterAddress']; ?></li>
          </ul>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card mb-4">
          <div>
            <?php
            if (!$fetchedData['voterIsApproved']) { ?>

            <section class="vote-danger">
              <div class="container">
                <div class="alert alert-danger mt-4" role="alert">
                  <h4 class="alert-heading">You are not Approved to vote</h4>
                  <hr>
                  <p>You are not approved to cast vote due to invalid information provided by you.</p>
                  <p class="mb-0">In case, all the information provided by you is correct, please wait for Approval.</p>
              </div>
              </div>
            </section>

        <?php 
      }
      ?>
        </div>
          <div class="card-header bg-dark text-white">
            Election News
          </div>
          <ul class="list-group list-group-flush" style="max-height: 250px; overflow-y: scroll;">
            <?php while($fetchedElection = mysqli_fetch_assoc($res4)) {  $id = $fetchedElection['electionID']; ?>
              <li class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="d-flex w-100 justify-content-between">
                    <h6 class="mb-1 font-weight-bold"><?php echo $fetchedElection['electionTitle']; ?></h6>
                    <div>
                      <a href="eDetail.php?id=<?php echo $id; ?>" class="btn btn-info btn-sm">More Details</a>
                      <?php if($fetchedData['voterIsApproved']) {?>
                      <a href="vote.php?id=<?php echo $id; ?>" class="btn btn-success btn-sm">Vote</a> <?php }?>
                    </div>
                  </div>
                  <small class="text-muted"><?php echo "START:" . $fetchedElection['startDate'] . "<br> END:" . $fetchedElection['endDate']; ?></small>
              </li>
            <?php } ?>
          </ul>
        </div>

        <div class="card mb-3">
          <div class="card-header bg-info text-white">Notifications</div>
            <ul class="list-group list-group-flush" style="max-height: 250px; overflow-y: scroll;">
              <?php 
                while($fetchedMsg = mysqli_fetch_assoc($res3)) {
              ?>
                <li class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                      <h6 class="mb-1 font-weight-bold"><?php echo $fetchedMsg['msgSubject']; ?></h6>
                      <small class="mb-1"><?php echo $fetchedMsg['dateSent']; ?></small>
                    </div>
                    <p class="text-muted"><?php echo $fetchedMsg['msgMsg']; ?></p>
                </li> 
                <?php } ?>
            </ul>
          </div>
        </div>

      </div>
    </div>
    <br><br>
    <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-3 float-right" style="width: 100%;">
          <div class="card-header bg-info text-white">Send Message</div>
          <div class="card-body">
            <?php
            if ($msg && $flag) {
              echo '<div class="alert alert-danger" role="alert">' . $msg . '</div>';
            } else if ($msg && !$flag) {
              echo '<div class="alert alert-success" role="alert">' . $msg . '</div>';
            }
            ?>
            <form action="dashboard.php" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Subject</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="msgSubject" placeholder="Enter Subject" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Message</label>
                <div class="col-sm-10">
                  <textarea name="msgMsg" id="msgMsg" rows="6" class="form-control" placeholder="Enter Description..." required></textarea>
                </div>
              </div>
              <input type="submit" name="sendMessage" class="btn btn-success float-right" value="Send">
            </form>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</section>



<?php
  require('footer.php');
?>