<?php
require('header.php');
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
                <li>All  citizens  of  India  who  are above 18 years are eligible for Registration</li>

                 <li>As  an  elector  you  should  immedi
                      ately  check  whether  your  name  has  
                        been included in the electoral roll of th
                                            e constituency where 
                                                    you reside or not. </li>
                    <li> After successful registration your password will be sent to your e-mail . </li>
                
                <li>You  should  note  that  you  can  be  
                                 registered  only  at  one  place.  
                                   Registration in more than one place is an offence. </li>
                <li> 	You may now log in with your password. </li>
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
          <input type="text" id="voterID" name="voterID" placeholder="Enter Voter ID" class="form-control ">
        </div>
      </div>
      <div class="form-group row">
        <label for="voterName" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
          <input type="text" id="voterName" name="voterName" placeholder="Enter Name" class="form-control">
        </div>
      </div>
      <div class="form-group row">
        <label for="voterDOB" class="col-sm-2 col-form-label">Date of Birth</label>
        <div class="col-sm-10">
          <input type="date" id="voterDOB" name="voterDOB" placeholder="Enter DOB" class="form-control">
        </div>
      </div>
      <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email ID</label>
        <div class="col-sm-10">
          <input type="text" id="email" name="email" placeholder="Enter Email ID" class="form-control">
        </div>
      </div>
      <div class="form-group row">
        <label for="voterPhone" class="col-sm-2 col-form-label">Phone Number</label>
        <div class="col-sm-10">
          <input type="text" id="voterPhone" name="voterPhone" placeholder="Enter Phone Number" class="form-control">
        </div>
      </div>
      <div class="form-group row">
        <label for="voterGender" class="col-sm-2 col-form-label">Gender</label><br>
        <div class="col-sm-10">
          <input type="radio" name="voterGender" id="voterGender" value="male" class="form-ckeck-input"> Male
        <input type="radio" name="voterGender" id="voterGender" value="female" class="ml-4" class="form-ckeck-input"> Female
        </div>
      </div>
      <div class="form-group row">
        <label for="voterCity" class="col-sm-2 col-form-label">City</label>
        <div class="col-sm-10">
          <input type="text" id="voterCity" name="voterCity" placeholder="Enter City" class="form-control">
        </div>
      </div>
      <div class="form-group row">
        <label for="voterAddress" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
          <textarea id="voterAddress" name="voterAddress" placeholder="Enter Address" class="form-control" cols="30" rows="6"></textarea>
        </div>
      </div>
      <br>
      <button type="submit" class="btn btn-success btn-block" name="register">Register</button>
    </form>
  </section>



<?php
require('footer.php');
?>