<?php
  require('../connect.php');
  $voter = $_GET['voter'];

  $res = mysqli_query($con, "DELETE FROM voter WHERE voterNo='$voter'");

  if ($res) {
    header('location: voters.php');
  }

?>