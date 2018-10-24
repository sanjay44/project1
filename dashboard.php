<?php
  require('header.php');
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
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">SETTINGS</a>
          <div class="dropdown-menu mt-3 nav-dropdown">
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
          <img class="card-img-top" style="padding: 40px;" src="assets/images/man.svg" alt="Card image cap">
          <div class="card-body text-white bg-secondary">
            <h5 class="card-title font-weight-bold mb-4">NAME OF PERSON</h5>
            <h6 class="card-subtitle mb-2" style="font-size: 14px;">VTU12345</h6>
          </div>
          <ul class="list-group list-group-flush" style="font-size: 14px;">
            <li class="list-group-item status"><i class="far fa-check-circle"></i> APPROVED</li>
            <li class="list-group-item">Bangalore</li>
            <li class="list-group-item">test@test.com</li>
            <li class="list-group-item">9876543210</li>
            <li class="list-group-item">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, a?</li>
          </ul>
        </div>
      </div>
      <div class="col-md-8">

        <div class="card mb-4">
          <div class="card-header bg-dark text-white">
            Election News
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              No Elections are pending
            </li>
          </ul>
        </div>

        <div class="card mb-3">
          <div class="card-header bg-info text-white">Notifications</div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item text-muted font-weight-bold">
                <p>Your Registration has been successfully Approved</p>
                <small>12-08-2018 17:28</small>
              </li>
              <li class="list-group-item text-muted font-weight-bold">
                <p>Your Registration has been successfully Approved</p>
                <small>12-08-2018 17:28</small>
              </li>
              <li class="list-group-item text-muted font-weight-bold">
                <p>Your Registration has been successfully Approved</p>
                <small>12-08-2018 17:28</small>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<?php
  require('footer.php');
?>