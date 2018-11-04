<?php
  require('../connect.php');

  $res1 = mysqli_query($con, "SELECT COUNT(*) FROM voter");
  $fetchedData = mysqli_fetch_array($res1);
  $voterCount = $fetchedData[0] - 2;

  $res2 = mysqli_query($con, "SELECT COUNT(*) FROM candidate");
  $fetchedData2 = mysqli_fetch_array($res2);
  $canCount = $fetchedData2[0];

  $res3 = mysqli_query($con, "SELECT COUNT(*) FROM election");
  $fetchedData3 = mysqli_fetch_array($res3);
  $electionCount = $fetchedData3[0];

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
  <nav class="navbar navbar-expand-sm navbar-dark fixed-top" style="background-color: #218F76;">
      <a class="navbar-brand" href="#" style="font-size: 18px;"><img src="../assets/images/vote-green.svg" alt="logo" class="mr-2 mb-1" id="hello"><strong>ONLINE VOTING SYSTEM <span class="admin-panel">ADMIN PANEL</span></strong></a>
      <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
  </nav>

  <section class="side-menu">
    <div>
      <ul class="list-group list-group-flush menu-ul">
        <li class="list-group-item menu-items active-menu">
          <div class="menu-icon mt-1">
            <i class="fas fa-tachometer-alt float-right"></i>
          </div>
          <div class="menu-text">
            <a href="./dashboard.php">DASHBOARD</a>
          </div>
        </li>
        <li class="list-group-item menu-items">
          <div class="menu-icon mt-1">
            <i class="fas fa-envelope float-right"></i>
          </div>
          <div class="menu-text">
            <a href="./message.php">MESSAGES</a>
          </div>
        </li>
        <li class="list-group-item menu-items">
          <div class="menu-icon mt-1">
            <i class="fas fa-users float-right"></i>
          </div>
          <div class="menu-text">
            <a href="./voters.php">VOTERS</a>
          </div>
        </li>
        <li class="list-group-item menu-items">
          <div class="menu-icon mt-1">
            <i class="fas fa-address-card float-right"></i>
          </div>
          <div class="menu-text">
            <a href="./candidates.php">CANDIDATES</a>
          </div>
        </li>
        <li class="list-group-item menu-items">
          <div class="menu-icon mt-1">
            <i class="fas fa-plus-circle float-right"></i>
          </div>
          <div class="menu-text">
            <a href="elections.php">ADD ELECTION</a>
          </div>
        </li>
      </ul>
    </div>
  </section>


  <section class="content">
      <div class="jumbotron jumbotron-fluid ml-4 mt-4 rounded">
        <div class="container">
          <h1 class="display-4">Welcome, Admin</h1>
          <p class="lead mt-4">This is an admin portal for Online Voting System where you can manage activities related to voting process.</p>
        </div>
      </div>
  </section>


  <section class="content">
    <div class="number">
      <div style="background-color: #0A79DF; color: #fff;">
          <h4>NUMBER OF VOTERS</h4>
          <h1><?php echo $voterCount; ?></h1>
      </div>
      <div style="background-color: #FAD02E; color: #fff;">
          <h4>NUMBER OF CANDIDATES</h4>
          <h1><?php echo $canCount; ?></h1>
      </div>
      <div style="background-color: #E71C23; color: #fff;">
          <h4>TOTAL ELECTIONS HOSTED</h4>
          <h1><?php echo $electionCount; ?></h1>
      </div>
    </div>
  </section>

  </body>
  </html>