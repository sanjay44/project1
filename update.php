<?php
session_start();
require('header.php');
require('connect.php');

$msg = '';
$flag = 1;
$voterNo = $_SESSION["voter"];
$res1 = mysqli_query($con, "SELECT * FROM voter WHERE voterNo = '$voterNo'");
$fetchedData = mysqli_fetch_assoc($res1);
$voterFirstName = explode(' ', trim($fetchedData['voterName']))[0];
$_SESSION["voterFirstName"] = $voterFirstName;

if(isset($_POST['update'])) {
  $voterName = mysqli_real_escape_string($con, $_POST['ch-voterName']);
  $voterDob = mysqli_real_escape_string($con, $_POST['ch-voterDob']);
  $voterGender = mysqli_real_escape_string($con, $_POST['ch-voterGender']);
  $voterPhone = mysqli_real_escape_string($con, $_POST['ch-voterPhone']);
  $voterEmail = mysqli_real_escape_string($con, $_POST['ch-voterEmail']);
  $voterCity = mysqli_real_escape_string($con, $_POST['ch-voterCity']);
  $voterAddress = mysqli_real_escape_string($con, $_POST['ch-voterAddress']);

  if (!preg_match("/^\d{10}$/", $voterPhone)) {
    $msg = 'Please enter 10 digit Phone number only.';
    $flag = 1;
  }
  else {
    $res = mysqli_query($con, "UPDATE voter SET voterName='$voterName', voterDob='$voterDob', voterGender='$voterGender', voterPhone='$voterPhone', voterEmail='$voterEmail', voterCity='$voterCity', voterAddress='$voterAddress' WHERE voterNo='$voterNo'");

    if($res) {
      $msg = 'Details Updated Successfully';
      $flag = 0;
    }
    else {
      $msg = 'Update Failed';
      $flag = 1;
    }
  }

}
?>

<div class="collapse navbar-collapse justify-content-end" id="collapsibleNavId">
      <ul class="navbar-nav mt-2 mt-lg-0" style="font-size: 14px;">
        <li class="nav-item mr-2">
          <a class="nav-link" href="dashboard.php">DASHBOARD</a>
        </li>
        <li class="nav-item mr-2">
          <a class="nav-link" href="vote.php">VOTE</a>
        </li>
        <li class="nav-item dropdown active">
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

<section class="mt-4">
  <div class="container">
    <h2>Update Details</h2>
  <hr>
  <?php
  if ($msg && $flag) {
    echo '<div class="alert alert-danger mt-4" role="alert">' . $msg . '</div>';
  } else if ($msg && !$flag) {
    echo '<div class="alert alert-success mt-4" role="alert">' . $msg . '</div>';
  }
  ?>
    <form action="update.php" method="post">
    <div class="form-group row mt-4">
        <label class="col-sm-2 col-form-label">VoterID</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" disabled name="ch-voterID" value="<?php echo $fetchedData['voterID']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Full Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" required name="ch-voterName" value="<?php echo $fetchedData['voterName']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Date of Birth</label>
        <div class="col-sm-10">
          <input type="date" class="form-control" required name="ch-voterDob" value="<?php echo $fetchedData['voterDob']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Gender</label>
        <div class="col-sm-2 mt-2">
          <input type="radio" value="male" name="ch-voterGender" checked> Male
          <input type="radio" value="female" name="ch-voterGender"> Female
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" required name="ch-voterEmail" value="<?php echo $fetchedData['voterEmail']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Phone</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" required name="ch-voterPhone" value="<?php echo $fetchedData['voterPhone']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">City</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" required name="ch-voterCity" value="<?php echo $fetchedData['voterCity']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
          <textarea class="form-control" required name="ch-voterAddress" rows="6"><?php echo $fetchedData['voterAddress']; ?></textarea>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary" name="update">Update</button>
        </div>
      </div>
    </form>
  </div>
</section>


<?php
require('footer.php');
?>