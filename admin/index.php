<?php
  require('../connect.php');

  $error = '';

  if(isset($_POST['admin-login'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $adminpass = mysqli_real_escape_string($con, $_POST['admin-pass']);

    if($username === 'admin' && $adminpass === 'admin') {
      session_start();
      $_SESSION['super-access'] = true;
      header('location: ./dashboard.php');
    }
    else {
      $error = 'Wrong Credentials';
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="../assets/fontawesome/fontawesome-all.js"></script>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <title>Voting System</title>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 first">
      </div>
      <div class="col-md-4 second">
        <section class="admin-login"> 
          <h2 class="font-weight-bold text-muted" style="margin-bottom: 50px">ADMIN PANEL LOGIN</h2>
          <?php
          if ($error) {
            echo '<div class="alert alert-danger mt-4" role="alert">' . $error . '</div>';
          }
          ?>
          <form action="index.php" method="post">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="admin-pass">Password</label>
              <input type="password" class="form-control" id="admin-pass" name="admin-pass">
          </div>
            <button type="submit" class="btn btn-success mt-4" name="admin-login">Login <i class="fas fa-sign-in-alt ml-2"></i></button>
          </form>
        </section>
        <div class="admin-footer">
          <small class="text-muted">Online Voting System &copy; 2018</small>
        </div>
      </div>
    </div>
  </div>

</body>
</html>