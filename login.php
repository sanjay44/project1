<?php
  require('header.php');
  require('functions.php');

  $error = '';

  if(isset($_POST['login'])) {
    $voterID = mysqli_real_escape_string($con, $_POST['voterID']);
    $voterPassword = mysqli_real_escape_string($con, $_POST['voterPassword']);

    if(voter_exists($con, $voterID)) {
      $res1 = mysqli_query($con, "SELECT voterNo, voterPassword FROM voter WHERE voterID = '$voterID'");
      $fetched_password = mysqli_fetch_assoc($res1);

      if (md5($voterPassword) !== $fetched_password["voterPassword"]) {
        $error = "Wrong VoterID or Password";
      }
      else {
        session_start();
        $_SESSION['voter'] = $fetched_password["voterNo"];
        header("location: dashboard.php");
      }
    }
    else {
      $error = 'Voter does not exists';
    }
  }

?>

  <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavId">
        <ul class="navbar-nav mt-2 mt-lg-0" style="font-size: 14px;">
          <li class="nav-item mr-2">
            <a class="nav-link" href="index.php">HOME</a>
          </li>
          <li class="nav-item active mr-2">
            <a class="nav-link" href="login.php">LOGIN</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">REGISTER</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="login-form">
    <form action="login.php" method="post" style="font-size: 14px;">
      <h3 style="color: #218F76;" class="font-weight-bold">Login</h3>
      <hr>
      <?php
        if ($error) {
          echo '<div class="alert alert-danger mt-4" role="alert">' . $error . '</div>';
        }
      ?>
      <div class="form-group">
        <label for="voterID">Voter ID</label>
        <input type="text" id="voterID" name="voterID" placeholder="Enter Voter ID" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="voterPassword" placeholder="Enter Password" class="form-control" required>
      </div><br>
      <button type="submit" class="btn btn-success btn-block" name="login">Login</button>
    </form>
  </section>

<?php
  require('footer.php');
?>