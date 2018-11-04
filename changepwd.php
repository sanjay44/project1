<?php
  session_start();
  require('header.php');
  require('connect.php');

  $msg = '';
  $flag = 1;

  $voterNo = $_SESSION['voter'];

  if (isset($_POST["changepwd"])) {

    $res1 = mysqli_query($con, "SELECT voterPassword FROM voter WHERE voterNo = '$voterNo'");
    $fetchedData = mysqli_fetch_assoc($res1);

    $oldpass = mysqli_real_escape_string($con, $_POST["oldpass"]);
    $newpass = mysqli_real_escape_string($con, $_POST["newpass"]);
    $confirmnewpass = mysqli_real_escape_string($con, $_POST["confirmnewpass"]);

    $oldpass = md5($oldpass);
    $newpass = md5($newpass);
    $confirmnewpass = md5($confirmnewpass);

    if ($oldpass != $fetchedData["voterPassword"]) {
      $msg = "Incorrect Old Password";
    } 
    else if (strlen($newpass) < 8) {
      $msg = "Password must be atleast 8 characters long";
    } 
    else if ($newpass != $confirmnewpass) {
      $msg = "The two passwords donot match";
    } 
    else {
      $res2 = mysqli_query($con, "UPDATE voter SET voterPassword = '$newpass' WHERE voterNo = '$voterNo'");
      if($res2) {
        $msg = "Password changed successfully";
        $flag = 0;
      }
      else {
        $msg = "Attempt to change Password failed";
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

<section class="changePassword">
  <form action="changepwd.php" method="post">
    <h3 style="color: #218F76;" class="font-weight-bold">Change Password</h3>
      <hr>
      <?php
        if ($msg && $flag) {
          echo '<div class="alert alert-danger mt-4" role="alert">' . $msg . '</div>';
        }
        else if($msg && !$flag) {
          echo '<div class="alert alert-success mt-4" role="alert">' . $msg . '</div>';
        }
      ?>
    <div class="form-group">
      <label for="oldpass">Old Password</label>
      <input type="password" id="oldpass" name="oldpass" placeholder="Enter Old Password" class="form-control">
    </div>
    <div class="form-group">
      <label for="newpass">New Password</label>
      <input type="password" id="newpass" name="newpass" placeholder="Enter New Password" class="form-control">
    </div>
    <div class="form-group">
      <label for="newpass">Confirm New Password</label>
      <input type="password" id="confirmnewpass" name="confirmnewpass" placeholder="Confirm New Password" class="form-control">
    </div><br>
    <button type="submit" class="btn btn-success btn-block" name="changepwd">Change Password</button>    
  </form>
</section>



<?php
  require('footer.php');
?>