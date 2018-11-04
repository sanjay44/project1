<?php
  require('connect.php');

  function voter_exists($con, $voterID) {
    $res1 = mysqli_query($con, "SELECT VoterID from voter WHERE voterID = '$voterID'");
    if(mysqli_num_rows($res1) == 1) {
      return true;
    }
    else {
      return false;
    }
  }

?>