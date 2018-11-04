<?php
  require('../connect.php');
  $voter = $_GET['voter'];

  $res = mysqli_query($con, "UPDATE voter SET voterIsApproved=1 WHERE voterNo='$voter'");

  if($res) {
  $cur_date1 = date("Y-m-d");

  $res4 = mysqli_query($con, "INSERT INTO message(msgSender, msgReceiver, msgSubject, msgMsg, dateSent) VALUES(11, '$voter', 'Congratulations!', 'You are now approved to vote.', '$cur_date1')");

    header('location: voters.php');
  }

?>