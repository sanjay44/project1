<?php
  $con = mysqli_connect("localhost", "root", "", "voting");

  if(mysqli_connect_errno()) {
    echo "Error while connecting to the database";
  }

?>