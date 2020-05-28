<?php 
    $connect = mysqli_connect("localhost", "root", "") or die ("Hey loser, check your server connection."); 
    $create = mysqli_query( $connect,"CREATE DATABASE IF NOT EXISTS user_info") or die(mysqli_error($connect)); 
    mysqli_select_db($connect,"user_info");
    
    switch ($_GET['action']) 
    { 
        case "edit": 
            $sql = "SELECT * FROM person WHERE person_id = '" . $_GET['id'] . "'";
            $result = mysqli_query($connect,$sql) or die("Invalid query: " . mysqli_error($connect)); 
            $row = mysqli_fetch_array($result);
            
           $username = $row['username'];
           $password = $row['password'] ;
           $first_name = $row['first_name'] ;
           $last_name = $row['last_name'] ;
           $middle_name = $row['middle_name'] ;
           $organization = $row['organization'] ;
           $position = $row['position'] ;
           $email = $row['email'] ;
           $phone_number = $row['phonenumber'] ;
           $access = $row['access'] ;
           $id =  $row['person_id'];
           
           include "edit.php";
           
        break;
        case "register":
            include "register.php";
        break;
        default:
            include "add.php";
        break;
    }
   ?>

 <html>
      <head> 
        <title><?php echo $_GET['action'];?></title> 
      </head> 
      <body>
      
      </body>
 </html> 