<?php
  include __DIR__.'\..\Controllers\DBController.php';

  try {
    $db = new ContactDB;
    $added = $db->addIfUnique($newProjectName, $newProjectDescription);
    if($added){
      header('Location: /CS330-Project/UserHomePage/userHomePage.php');
    }
    else{
      $_SESSION['Error'] = "Failed to add project to DB";
      header('Location: createProject.php');
    }
  } catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
  }
 ?>
