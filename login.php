<?php
  require('header.php');
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
      <div class="form-group">
        <label for="voterID">Voter ID</label>
        <input type="text" id="voterID" name="voterID" placeholder="Enter Voter ID" class="form-control form-control-sm">
      </div>
      <div class="form-group">
        <label for="email">Email ID</label>
        <input type="text" id="email" name="email" placeholder="Enter Email ID" class="form-control form-control-sm">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter Password" class="form-control form-control-sm">
      </div><br>
      <button type="submit" class="btn btn-success btn-block btn-sm" name="login">Login</button>
    </form>
  </section>

<?php
  require('footer.php');
?>