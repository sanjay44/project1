<?php
  session_start();
  require('connect.php');
  require('functions.php');
  require('header.php');
  
  $error = '';
  $voterID = '';
  $voterName = '';
  $voterDob = '';
  $voterGender = '';
  $voterPhone = '';
  $voterEmail = '';
  $voterPassword = '';
  $voterCity = '';
  $voterAddress = '';

  if(isset($_POST['register'])) {

    $voterID = mysqli_real_escape_string($con, $_POST['voterID']);
    $voterName = mysqli_real_escape_string($con, $_POST['voterName']);
    $voterDob = mysqli_real_escape_string($con, $_POST['voterDob']);
    $voterGender = mysqli_real_escape_string($con, $_POST['voterGender']);
    $voterPhone = mysqli_real_escape_string($con, $_POST['voterPhone']);
    $voterEmail = mysqli_real_escape_string($con, $_POST['voterEmail']);
    $voterPassword = mysqli_real_escape_string($con, $_POST['voterPassword']);
    $voterCity = mysqli_real_escape_string($con, $_POST['voterCity']);
    $voterAddress = mysqli_real_escape_string($con, $_POST['voterAddress']);
    
    if(!preg_match("/^\d{10}$/", $voterPhone)) {
      $error = 'Please enter 10 digit Phone number only.';
    }
    else if(strlen($voterPassword) < 8) {
      $error = 'Password must be atleast 8 characters long.';
    }
    else if(voter_exists($con, $voterID)) {
      $error = 'Voter already exists';
    }
    else {
      $voterPassword = md5($voterPassword);

      $res = mysqli_query($con, "INSERT INTO voter(voterID, voterName, voterGender, voterDob, voterEmail, voterPassword, voterPhone, voterCity, voterAddress, voterIsapproved) VALUES('$voterID', '$voterName', '$voterGender', '$voterDob', '$voterEmail', '$voterPassword', '$voterPhone', '$voterCity', '$voterAddress', 0)");

      if($res) {

        $last_id = mysqli_insert_id($con);

        $cur_date1 = date("Y-m-d");

        $res4 = mysqli_query($con, "INSERT INTO message(msgSender, msgReceiver, msgSubject, msgMsg, dateSent) VALUES('$last_id', 11, 'Request for Approval', 'Kindly verify the details.', '$cur_date1')");

        $cur_date2 = date("Y-m-d");

        $res4 = mysqli_query($con, "INSERT INTO message(msgSender, msgReceiver, msgSubject, msgMsg, dateSent) VALUES(11, '$last_id', 'Request for Approval sent', 'Your request for approval has been sent to the administrator.', '$cur_date2')");

        header('location:register_success.php');

      }
      else {
        $error = 'Registration Failed';
      }
    }

  }
?>


  <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavId">
        <ul class="navbar-nav mt-2 mt-lg-0" style="font-size: 14px;">
          <li class="nav-item mr-2">
            <a class="nav-link" href="index.php">HOME</a>
          </li>
          <li class="nav-item mr-2">
            <a class="nav-link" href="login.php">LOGIN</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="register.php">REGISTER</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="register-form">
    <form action="register.php" method="post"  style="font-size: 14px;">
      <h3 style="color: #218F76;" class="font-weight-bold">Voter Registeration</h3>
      <hr>
      <?php
        if($error) {
          echo '<div class="alert alert-danger mt-4" role="alert">'.$error.'</div>';
        }
      ?>
      <small>Please read the <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg">Instructions</a> for the registration process.</small>
      <br><br>
      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Instructions for Registration</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <!-- Instructions -->

            <div class="modal-body">
              <ol>
                <li>You must have the Voter ID number in order to cast vote.</li>
                <li>All  citizens  of  India  who  are above 18 years are eligible for Registration.</li>
                <li>As  an  elector  you  should  immediately  check  whether  your  name  has been included in the electoral roll of the constituency where you reside or not. </li>
                <li>You  should  note  that  you  can  be registered  only  at  one  place. Registration in more than one place is an offence. </li>
                <li>You can log in with your password after successful Registration. </li>
              </ol>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label for="voterID" class="col-sm-2 col-form-label">Voter ID</label>
        <div class="col-sm-10">
          <input type="text" id="voterID" name="voterID" placeholder="Enter Voter ID" class="form-control" required>
        </div> 
      </div>
      <div class="form-group row">
        <label for="voterName" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
          <input type="text" id="voterName" name="voterName" placeholder="Enter Name" class="form-control" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="voterDOB" class="col-sm-2 col-form-label">Date of Birth</label>
        <div class="col-sm-10">
          <input type="date" id="voterDOB" name="voterDob" placeholder="Enter DOB" class="form-control" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email ID</label> 
        <div class="col-sm-10">
          <input type="email" id="email" name="voterEmail" placeholder="Enter Email ID" class="form-control" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Create Password</label>
        <div class="col-sm-10">
          <input type="password" id="password" name="voterPassword" placeholder="Create your Password" class="form-control" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="voterPhone" class="col-sm-2 col-form-label">Phone Number</label>
        <div class="col-sm-10">
          <input type="text" id="voterPhone" name="voterPhone" placeholder="Enter Phone Number" class="form-control" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="voterGender" class="col-sm-2 col-form-label">Gender</label><br>
        <div class="col-sm-10">
          <input type="radio" name="voterGender" id="voterGender" value="male" class="form-ckeck-input" checked> Male
          <input type="radio" name="voterGender" id="voterGender" value="female" class="ml-4" class="form-ckeck-input"> Female
        </div>
      </div>
      <div class="form-group row">
        <label for="voterCity" class="col-sm-2 col-form-label">City</label>
        <div class="col-sm-10">
          <input type="text" id="voterCity" name="voterCity" placeholder="Enter City" class="form-control" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="voterAddress" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
          <textarea id="voterAddress" name="voterAddress" placeholder="Enter Address" class="form-control" cols="30" rows="6" required></textarea>
        </div>
      </div>
      <br>
      <button type="submit" class="btn btn-success btn-block" name="register">Register</button>
    </form>
  </section>



<?php
require('footer.php');
?>