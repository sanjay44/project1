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

<section class="changePassword">
  <form action="changepwd.php" method="post">
    <h3 style="color: #218F76;" class="font-weight-bold">Change Password</h3>
      <hr>
    <div class="form-group">
      <label for="oldpass">Old Password</label>
      <input type="text" id="oldpass" name="oldpass" placeholder="Enter Old Password" class="form-control">
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