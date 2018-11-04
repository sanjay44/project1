<?php
  require('../connect.php');

  $res1 = mysqli_query($con, "SELECT * FROM voter WHERE voterID != 'ADMIN' AND voterID != 'ALL'");
  
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
        <li class="list-group-item menu-items">
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
        <li class="list-group-item menu-items active-menu">
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
    <div class="admin-overlay">
      <img src="../assets/images/admin1.png" alt="no admin">
    </div>
  </section>


  <section class="content">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">VoterID</th>
          <th scope="col">Name</th>
          <th scope="col">Gender</th>
          <th scope="col">DOB</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">City</th>
          <th scope="col">Address</th>
          <th scope="col">IsApproved</th>
          <th scope="col">Approve</th>
          <th scope="col">Delete</th>          
        </tr>
      </thead>
      <tbody>   
      <?php
        $i = 1;
        while($fetchedData = mysqli_fetch_assoc($res1)) {

          $voterNo = $fetchedData['voterNo'];
          if($fetchedData['voterIsApproved']) {
            $approval = 'Yes';
          }
          else {
            $approval = 'No';
          }
          echo '<tr><td>' . $i .'</td><td>' . $fetchedData['voterID'] . '</td><td>'. $fetchedData['voterName'] .'</td><td>'. $fetchedData['voterGender'] .'</td><td>'. $fetchedData['voterDob'] .'</td><td>'. $fetchedData['voterEmail'] .'</td><td>'. $fetchedData['voterPhone'] .'</td><td>'. $fetchedData['voterCity'] .'</td><td>'. $fetchedData['voterAddress'] .'</td><td>'. $approval. '</td><td class="text-center"><a href="approve.php?voter='. $voterNo . '" title="This will approve the user"><i class="fas fa-check text-secondary"></i></a></td><td class="text-center"><a href="deleteVoter.php?voter=' . $voterNo . '" title="This will completely delete user"><i class="fas fa-trash-alt text-danger"></i></a></td></tr>';
          $i++;
        }
      ?>
      </tbody>
    </table>
  </section>

  </body>
  </html>