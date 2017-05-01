<?php
  include __DIR__.'\..\Controllers\DBController.php';

  try {
    $db = new ContactDB;
    $accept = $db->accept($_POST["prjName"], $_SESSION["User"]->getUName());
    if($accept){
      header('Location: /CS330-Project/UserHomePage/userHomePage.php');
    }
    else{
      $_SESSION['Error'] = "Failed to accept project";
      header('Location: /CS330-Project/UserHomePage/userHomePage.php');
    }
  } catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
  }
 ?>
