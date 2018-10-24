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

<section class="deleteAccount">
  <form action="deleteAccount.php" method="post">
    <h3 class="font-weight-bold text-danger">Delete Account</h3>
      <hr>
    <div class="form-group">
      <label for="delpass">Account Password</label>
      <input type="password" id="delpass" name="delpass" placeholder="Enter Password" class="form-control">
    </div>
    <br>
    <button type="submit" class="btn btn-danger btn-block" name="delpwd">I am Sure, Delete my Account</button>    
  </form>
</section>



<?php
require('footer.php');
?>