<?php 
    $connect = mysqli_connect("localhost", "root", "") or die ("Hey loser, check your server connection."); 
    $create = mysqli_query( $connect,"CREATE DATABASE IF NOT EXISTS user_info") or die(mysqli_error($connect)); 
    mysqli_select_db($connect,"user_info");
?>
<html>
   <head>
    <title>Please Log In</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
  </head> 
     <body>
        <div class="container">
         <?php
             if (isset($_POST['login_Submit']) && $_POST['login_Submit'] = "login")
             {
                 if ($_POST['username'] != "" && $_POST['password'] != "" )
                 {
//                      $query = "SELECT * FROM person " . "WHERE username = '" . $_POST['username'] . "'"; 

                        $query = "SELECT *FROM person WHERE username = '" . $_POST['username'] . "'  AND password =(PASSWORD('" . $_POST['password'] . "'))";
                        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
                        
                        if (mysqli_num_rows($result) != 0)
                        {
                            while ($row = mysqli_fetch_array($result))
                            {
                               session_start();
                               $_SESSION['username'] = $row['username'];
                               $_SESSION['id'] = $row['person_id'];
                               
                               $_SESSION['access'] = $row['access'];
                                
                               Header("Location:main.php"); 
                            }
                        } 
                        else
                        {
                           echo "You are not allowed register";
                        }                      
                 }
                 else
                 {
                      echo "Please enter your uername and password";
                 } 
             }
               //if (isset($_POST['register_Submit']) && $_POST['register_Submit'] = "register")
//               {
//                      Header("Location:register.php"); 
//               } 
          ?>
          
               <form method="post" action="index.php" align=center>
                   <p>username: <input type="text" name="username"> </p>
                   <p>password: <input type="password" name="password"> </p>
                    <button type="submit"  class="login_btn" name="login_Submit" value="login"> Log in </button>
                    <button type="button" class="register_btn"> <a href="inner.php?action=register">Register</a> </button>
             </form> 
          </div>
     </body> 
</html>

                           