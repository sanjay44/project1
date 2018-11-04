<?php
  require('../connect.php');

  $msg = '';
  $flag = 0;
  $msg1 = '';
  $flag1 = 0;

  $res1 = mysqli_query($con, "SELECT * FROM message WHERE msgReceiver=11 ORDER BY msgID DESC");

  if(isset($_POST['sendMessage'])) {

    $msgSubject = mysqli_real_escape_string($con, $_POST['msgSubject']);
    $msgMsg = mysqli_real_escape_string($con, $_POST['msgMsg']);
    date_default_timezone_set("Asia/Calcutta");
    $cur_date = date("Y-m-d");

    $res3 = mysqli_query($con, "INSERT INTO message(msgSender, msgReceiver, msgSubject, msgMsg, dateSent) VALUES(11, 0, '$msgSubject', '$msgMsg', '$cur_date')");

    if($res3) {
      $msg = "Message Sent";
      $flag = 0;
    }
    else {
      $msg = "Attempt Failed";
    }
    
  }

  if(isset($_POST['sendPrivate'])) {

    $msgSubject1 = mysqli_real_escape_string($con, $_POST['msgSubject1']);
    $msgMsg1 = mysqli_real_escape_string($con, $_POST['msgMsg1']);
    $voterID = mysqli_real_escape_string($con, $_POST['voterID']);

    $res5 = mysqli_query($con, "SELECT voterNo FROM voter WHERE voterID='$voterID'");
    $fetchedNo = mysqli_fetch_assoc($res5);
    $voterNo1 = $fetchedNo['voterNo'];

    $cur_date1 = date("Y-m-d");

    $res4 = mysqli_query($con, "INSERT INTO message(msgSender, msgReceiver, msgSubject, msgMsg, dateSent) VALUES(11, '$voterNo1', '$msgSubject1', '$msgMsg1', '$cur_date1')");

    if ($res4) {
      $msg1 = "Message Sent";
      $flag1 = 0;
    } 
    else {
      $msg1 = "Attempt Failed";
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
        <li class="list-group-item menu-items active-menu">
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
    <div class="card" style="width: 70%;">
      <div class="card-header bg-info text-light">Incoming Messages</div>
        <ul class="list-group list-group-flush" style="max-height: 200px; overflow-y: scroll;">
          <?php
          while($fetchedMsg = mysqli_fetch_assoc($res1)) {
            $voterNo = $fetchedMsg['msgSender'];
            $res2 = mysqli_query($con, "SELECT * FROM voter WHERE voterNo='$voterNo'");
            $fetchedData = mysqli_fetch_assoc($res2);
            
          ?>
          <li class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex w-100 justify-content-between">
                <h6 class="mb-1 font-weight-bold"><?php echo $fetchedMsg['msgSubject']; ?></h6>
                <small class="text-muted"><?php echo $fetchedMsg['dateSent']; ?></small>
              </div>
              <p class="mb-1"><?php echo $fetchedMsg['msgMsg']; ?></p>
              <small class="badge badge-secondary text-light py-2"><?php echo $fetchedData['voterID']." | ".$fetchedData['voterName']; ?></small>
          </li>
          <?php } ?>
        </ul>
    </div>
  </section>

  <section class="content">
    <div class="card" style="width: 70%;">
      <h5 class="card-header bg-secondary text-light">Broadcast Message</h5>
      <div class="card-body">
        <?php
        if ($msg && $flag) {
          echo '<div class="alert alert-danger" role="alert">' . $msg . '</div>';
        } else if ($msg && !$flag) {
          echo '<div class="alert alert-success" role="alert">' . $msg . '</div>';
        }
        ?>
        <form action="message.php" method="post">
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
  </section>

  <section class="content">
    <div class="card" style="width: 70%;">
      <h5 class="card-header bg-secondary text-light">Private Message</h5>
      <div class="card-body">
        <?php
        if ($msg1 && $flag1) {
          echo '<div class="alert alert-danger" role="alert">' . $msg1 . '</div>';
        } else if ($msg1 && !$flag1) {
          echo '<div class="alert alert-success" role="alert">' . $msg1 . '</div>';
        }
        ?>
        <form action="message.php" method="post">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Voter ID</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="voterID" placeholder="Enter Voter ID">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Subject</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="msgSubject1" placeholder="Enter Subject">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Message</label>
            <div class="col-sm-10">
              <textarea name="msgMsg1" id="msgMsg1" rows="6" class="form-control" placeholder="Enter Description..."></textarea>
            </div>
          </div>
          <input type="submit" name="sendPrivate" class="btn btn-success float-right" value="Send">
        </form>
      </div>
    </div>
  </section>

  </body>
  </html>