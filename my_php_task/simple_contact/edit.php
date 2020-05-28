 <html>
     <head>
        <link rel="stylesheet" type="text/css" href="css/add_register.css">
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
     </head>
<body> 
    <?php
        
        $connect = mysqli_connect("localhost", "root", "") or die ("Hey loser, check your server connection."); 
        $create = mysqli_query( $connect,"CREATE DATABASE IF NOT EXISTS user_info") or die(mysqli_error($connect)); 
        mysqli_select_db($connect,"user_info");
        
        session_start();
    
     if (isset($_POST['submit']) && $_POST['submit'] = "Edit") 
     {
          if ($_POST['username'] != "" && $_POST['password'] != "" && $_POST['first_name'] != "" &&
               $_POST['last_name'] != "" && $_POST['middle_name'] != "" && $_POST['organization'] != "" &&  
               $_POST['position'] != "" &&  $_POST['email'] != "" && $_POST['phone_number'] != ""&& 
               $_POST['access'] != "Select access method..."  
               )
           { 
           ?>
           <?php
                    $query = "SELECT * FROM person " . "WHERE username = '" . $_POST['username'] . "'";
                    $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
                    $row = mysqli_fetch_array($result);
                    if (mysqli_num_rows($result) != 0 ) 
                    {
                                             

                        if($row['person_id'] != $_GET['id']){
                            
           ?>     <p> <font color="#FF0000"><b>Plesase select other username</b></font>
                    <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="post">
                          Username: <input type="text" name="username" value=""><br>
                          Password: <input type="password" name="password" value="<?php echo $_POST['password']; ?>"><br>
                          First Name: <input type="text" class="txtName" name="first_name" value="<?php echo $_POST['first_name']; ?>"><br>
                          Last Name: <input type="text" class="txtName" name="last_name" value="<?php echo $_POST['last_name']; ?>"><br>
                          Middle Name: <input type="text" class="txtName" name="middle_name" value="<?php echo $_POST['middle_name']; ?>"><br>
                          Organization: <input type="text" name="organization" value="<?php echo $_POST['organization']; ?>"><br>
                          Position: <input type="text" name="position" value="<?php echo $_POST['position']; ?>"><br>
                          Email: <input type="text" name="email" value="<?php echo $_POST['email']; ?>"><br>
                          Phonenumber: <input type="text" class="only-numeric" name="phone_number" value="<?php echo $_POST['phone_number']; ?>"><br>
                          <div class="error" style="color: red; display: none">* Input digits (0 - 9)</div><br>
                           Access method  &nbsp;&nbsp;&nbsp;&nbsp;<select name="access">
                                                 <option value="Select access method..."  <?php if ("Select access method..."  == $_POST['access']) { echo " selected"; } ?>>Select access method...</option>
                                                 <option value="Administrator"  <?php if ("Administrator"  == $_POST['access']) { echo " selected"; } ?>>Admistrator</option>
                                                 <option value="User"<?php if ("User"  ==  $_POST['access']) { echo " selected"; } ?>>User</option>
                                          </select>
                          
                          <br><br>
                         <input type="submit" name="submit" value="Edit"> &nbsp; 
                         <input type="reset"  value="Clear"> 
                     </form>
                   </p>            
                              
           <?php                  
                        }
                        else
                        {
                            
                            $query = "UPDATE person SET username='".$_POST['username']."',password =(PASSWORD('" . $_POST['password'] . "')) 
                              , first_name = '" . $_POST['first_name'] ."'
                               ,last_name = '".$_POST['last_name']."'
                               ,middle_name = '".$_POST['middle_name']."'
                               ,organization = '".$_POST['organization']."'
                               ,position = '".$_POST['position']."'
                               ,email = '".$_POST['email']."'
                               ,phonenumber = '".$_POST['phone_number']."'
                               ,access = '".$_POST['access']."'                            
                                WHERE person_id=".$_GET['id']."";
                                                
                              $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
                              
                              Header("Location:main.php");
                        }
                    } 
                    else
                    {
                             // $query = "UPDATE person 
//                              SET username = '" . $_POST['username'] ."', 
//                                  password =(PASSWORD('" . $_POST['password'] . "'))'" . "'
//                              WHERE person_id = '" .$_GET['id'] . "'";
//                              $query = "UPDATE person SET username='".$_POST['username']."',password =(PASSWORD('" . $_POST['password'] . "')) WHERE person_id=".$_GET['id']."";
                              $query = "UPDATE person SET username='".$_POST['username']."',password =(PASSWORD('" . $_POST['password'] . "')) 
                              , first_name = '" . $_POST['first_name'] ."'
                               ,last_name = '".$_POST['last_name']."'
                               ,middle_name = '".$_POST['middle_name']."'
                               ,organization = '".$_POST['organization']."'
                               ,position = '".$_POST['position']."'
                               ,email = '".$_POST['email']."'
                               ,phonenumber = '".$_POST['phone_number']."'
                               ,access = '".$_POST['access']."'                            
                                WHERE person_id=".$_GET['id']."";
                         
                                                
                              $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
                              
                              if($_SESSION['id'] == $row['person_id'])
                              {
                                  $_SESSION['username'] = $row['username'];
                                  $_SESSION['access'] = $row['access'];
                              
                              }
                              
                              Header("Location:main.php");
                              
                    }
                    
               
               ?>
              <?php 
               }
               else
                { 
                    ?> 
                <p> <font color="#FF0000"><b>The fields are required!</b></font>
                    <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="post">
                          Username: <input type="text" name="username" value="<?php echo $_POST['username']; ?>"><br>
                          Password: <input type="password" name="password" value="<?php echo $_POST['password']; ?>"><br>
                          First Name: <input type="text" class="txtName" name="first_name" value="<?php echo $_POST['first_name']; ?>"><br>
                          Last Name: <input type="text" class="txtName" name="last_name" value="<?php echo $_POST['last_name']; ?>"><br>
                          Middle Name: <input type="text" class="txtName" name="middle_name" value="<?php echo $_POST['middle_name']; ?>"><br>
                          Organization: <input type="text" name="organization" value="<?php echo $_POST['organization']; ?>"><br>
                          Position: <input type="text" name="position" value="<?php echo $_POST['position']; ?>"><br>
                          Email: <input type="text" name="email" value="<?php echo $_POST['email']; ?>"><br>
                          Phonenumber: <input type="text" class="only-numeric" name="phone_number" value="<?php echo $_POST['phone_number']; ?>"><br>
                          <div class="error" style="color: red; display: none">* Input digits (0 - 9)</div><br>
                           Access method  &nbsp;&nbsp;&nbsp;&nbsp;<select name="access">
                                                 <option value="Select access method..."  <?php if ("Select access method..."  == $_POST['access']) { echo " selected"; } ?>>Select access method...</option>
                                                 <option value="Administrator"  <?php if ("Administrator"  == $_POST['access']) { echo " selected"; } ?>>Admistrator</option>
                                                 <option value="User"<?php if ("User"  ==  $_POST['access']) { echo " selected"; } ?>>User</option>
                                          </select>
                          
                          <br><br>
                         <input type="submit" name="submit" value="Edit"> &nbsp; 
                         <input type="reset"  value="Clear"> 
                     </form>
                   </p> 
            <?php 
                }   
     }
      else
      {
    ?>
          
           <p> Welcome to the edit page!<br>
               All are required!
               
               
               <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="post"> 
                       Username: <input type="text" name="username" value="<?php echo $username; ?>"><br> 
                       Password: <input type="password" name="password" value="<?php echo $password; ?>"><br> 
                       First Name: <input type="text" class="txtName" name="first_name" value="<?php echo $first_name; ?>"><br>
                       Last Name: <input type="text" class="txtName" name="last_name" value="<?php echo $last_name; ?>"><br>
                      Middle Name: <input type="text" class="txtName" name="middle_name" value="<?php echo $middle_name; ?>"><br>
                      Organization: <input type="text" name="organization" value="<?php echo $organization; ?>"><br>
                      Position: <input type="text" name="position" value="<?php echo $position; ?>"><br>
                      Email: <input type="text" name="email" value="<?php echo $email; ?>"><br>
                      Phonenumber: <input type="text" class="only-numeric" name="phone_number" value="<?php echo $phone_number; ?>"><br>
                      <div class="error" style="color: red; display: none">* Input digits (0 - 9)</div><br>
                      Access method &nbsp;&nbsp;&nbsp;&nbsp; <select name="access">
                                         <option value="Select access method..."<?php if ("Select access method..."  == $access) { echo " selected"; } ?>> Select access method... </option>
                                         <option value="Administrator" <?php if ("Administrator"  == $access) { echo " selected"; } ?>> Admistrator </option>
                                         <option value="User"<?php if ("User"  == $access) { echo " selected"; } ?>> User </option>
                                  </select>
                       <br><br> 
                       
                       <input type="submit" name="submit" value="Edit"> &nbsp; 
                       <input type="reset" name="clear" value="Clear">
              </form>
           </p> 
      <?php
            
          }
      ?> 
        <script type="text/javascript">
    
    $(document).ready(function() {
      $(".only-numeric").bind("keypress", function (e) {
          var keyCode = e.which ? e.which : e.keyCode
               
          if (!(keyCode >= 48 && keyCode <= 57)) {
            $(".error").css("display", "inline");
            return false;
          }else{
            $(".error").css("display", "none");
          }
      });
    });
    
    $(function () {
      $('.txtName').keydown(function (e) {
          if (e.shiftKey || e.ctrlKey || e.altKey) {
              e.preventDefault();
          } else {
              var key = e.keyCode;
              if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
                  e.preventDefault();
              }
              
              
          }
      });
  });
     
</script>
   </body>
 </html>
       
       