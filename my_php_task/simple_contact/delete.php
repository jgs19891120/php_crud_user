<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "") or die("Could not connect: " . mysqli_error($connect));
    mysqli_select_db($connect, 'user_info') or die ( mysqli_error($connect));
     
      if (!isset($_GET['do']) || $_GET['do'] != 1) 
      { 
?>
          <p align="center" style="color:#FF0000"> Are you sure you want to delete this <?php echo $_GET['type']; ?>?<br>
           <a href="<?php echo $_SERVER['REQUEST_URI']; ?>&do=1">yes</a> or <a href="main.php">Main</a> 
          </p> 
<?php
      }
      else
       {   
         $query = "SELECT * FROM person " . "WHERE person_id = '" . $_SESSION['id'] . "'";
         $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
         $row = mysqli_fetch_array($result);
            
         if ($row['access'] == 'User')
             {    
                  if ($_SESSION['id'] == $_GET['id'] )
                  {      
                       $sql = "SELECT * FROM person WHERE " . $_GET['type'] . "_id = '" . $_GET['id'] . "' LIMIT 1"; 
                        $result = mysqli_query($connect, $sql) or die("Invalid query: " . mysqli_error($connect));
                        $row = mysqli_fetch_array($result);
                        
                        
                        $query = "INSERT INTO deleted_user (username, password, first_name, last_name, middle_name, organization, position, email, phonenumber, access) " . 
                         "VALUES ('" . $row['username'] . "', " .
                                   "(PASSWORD('" . $row['password'] . "')), '" .
                                    $row['first_name'] . "', '" . 
                                    $row['last_name'] . "', '" . 
                                    $row['middle_name'] . "', '" . 
                                    $row['organization'] . "', '" . 
                                    $row['position'] . "', '" . 
                                    $row['email'] . "', '" . 
                                    $row['phonenumber'] . "', '" . 
                                    $row['access'] . "');";
                                     
                                    
                        $result = mysqli_query($connect, $query) or die("Invalid query: " . mysqli_error($connect));
                       
                       
                       $sql = "DELETE FROM " . $_GET['type'] . " WHERE " . $_GET['type'] . "_id = '" . $_GET['id'] . "' LIMIT 1";
                       $result = mysqli_query($connect, $sql) or die("Invalid query: " . mysqli_error($connect));
                  ?>
                       <p align="center" style="color:#FF0000"> Your <?php echo $_GET['type']; ?> has been deleted. <a href="index.php">Log out</a> </p>
                       
                   <?php 
                  }
                  else
                  {
                    ?>
                      
                     <p align="center" style="color:#FF0000"> You can not delete <?php echo $_GET['type']; ?> because of access in not allowed <a href="main.php">Main</a> </p> 
                      
                  <?php 
                  }
             } 
             else
             {
                 
                        $sql = "SELECT * FROM person WHERE " . $_GET['type'] . "_id = '" . $_GET['id'] . "' LIMIT 1"; 
                        $result = mysqli_query($connect, $sql) or die("Invalid query: " . mysqli_error($connect));
                        $row = mysqli_fetch_array($result);
                        
                        
                                     
                 $query = "INSERT INTO deleted_user (username, password, first_name, last_name, middle_name, organization, position, email, phonenumber, access,deleted_date) " . 
                         "VALUES ('" . $row['username'] . "', " .
                                   "(PASSWORD('" . $row['password'] . "')), '" .
                                    $row['first_name'] . "', '" . 
                                    $row['last_name'] . "', '" . 
                                    $row['middle_name'] . "', '" . 
                                    $row['organization'] . "', '" . 
                                    $row['position'] . "', '" . 
                                    $row['email'] . "', '" . 
                                    $row['phonenumber'] . "', '" . 
                                    $row['access'] . "', '" . 
                                    date("Y-m-d h:i:sa"). "');"; 
                                     
                                     
                        $result = mysqli_query($connect, $query) or die("Invalid query: " . mysqli_error($connect));

                
                 
             
              $sql = "DELETE FROM " . $_GET['type'] . " WHERE " . $_GET['type'] . "_id = '" . $_GET['id'] . "' LIMIT 1";
               // echo SQL for debug purpose 
               echo "<!--" . $sql . "-->"; 
               $result = mysqli_query($connect, $sql) or die("Invalid query: " . mysqli_error($connect));
               
                if ($_SESSION['id'] == $_GET['id'] )
                {
                 ?>
                         <p align="center" style="color:#FF0000"> Your <?php echo $_GET['type']; ?> has been deleted. <a href="index.php">Log out</a> </p>
                 <?php   
                }
                else
                { ?>
                   <p align="center" style="color:#FF0000"> Your <?php echo $_GET['type']; ?> has been deleted. <a href="main.php">Main</a> </p> 
           <?php
                }
               
      
             }
         } 
      ?>
  
  