<?php
  require('header.php');
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

<section class="notice">
  <div class="container mt-4">
    <div class="alert alert-info" role="alert">
      <h5>Important Notice</h5><hr>
      <p>You can vote only once. Vote Wisely!</p>
  </div>
  </div>
</section>

<section class="vote">
  <form action="vote.php" method="post">
    <h5>Select any one</h5>
    <br>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" required>
      <label class="form-check-label ml-2" for="exampleRadios1">
        Default radio
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2" required>
      <label class="form-check-label ml-2" for="exampleRadios2">
        Second default radio
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" required>
      <label class="form-check-label ml-2" for="exampleRadios3">
        Third default radio
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4" value="option4" required>
      <label class="form-check-label ml-2" for="exampleRadios4">
        Fourth default radio
      </label>
    </div>
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
  require('footer.php');
?>