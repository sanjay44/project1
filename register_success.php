<?php
  session_start();
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
          <li class="nav-item">
            <a class="nav-link" href="register.php">REGISTER</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <section id="register_success">
    <div class="container">
      <div class="alert alert-success" role="alert" style="margin: 100px 0 100px 0;">
        <h4 class="alert-heading">Registration Successful</h4><hr>
        <p>Your request has been sent to the Administration. After Verification, You will be approved for voting.</p>
        <p class="mb-0">You can vote only after getting approved.</p><br>
        <p>You can login to your account to get updates.</p>
      </div>
    </div>
  </section>

<?php
require('footer.php');
?>