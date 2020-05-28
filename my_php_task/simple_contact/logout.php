<?php
     session_start();
    unset($_SESSION['username']);
    unset($_SESSION['id'] );
    unset($_SESSION['access']);
      mysqli_close($link);
    header("Location:index.php");
?>
