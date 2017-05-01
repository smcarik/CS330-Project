<?php
  include __DIR__.'\..\Controllers\DBController.php';

  try {
    $db = new ContactDB;
    $reject = $db->reject($_POST["prjName"], $_SESSION["User"]->getUName());
    if($reject){
      header('Location: /CS330-Project/UserHomePage/userHomePage.php');
    }
    else{
      $_SESSION['Error'] = "Failed to reject project";
      header('Location: /CS330-Project/UserHomePage/userHomePage.php');
    }
  } catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
  }
 ?>
