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
    
     if (isset($_POST['submit']) && $_POST['submit'] == "Register") 
     {
      if ($_POST['username'] != "" &&
           $_POST['password'] != "" && 
           $_POST['first_name'] != "" &&
           $_POST['last_name'] != "" && 
           $_POST['middle_name'] != "" &&  
           $_POST['organization'] != "" &&  
           $_POST['position'] != "" &&  
           $_POST['email'] != "" &&
           $_POST['phone_number'] != ""&& 
           $_POST['access'] != "Select access method..." 
           )
       { 
           $query = "SELECT username FROM person " . "WHERE username = '" . $_POST['username'] . "';";
            $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
            if (mysqli_num_rows($result) != 0) 
            { 
    ?>
              
             <font color="#FF0000"><b>The Username " <?php echo $_POST['username']; ?> " is already in use, please choose another!</b></font>
              <form action="register.php" method="post"> 
                  Username: <input type="text" name="username"><br>
                  Password: <input type="password" name="password" value="<?php echo $_POST['password']; ?>"><br>
                  First Name: <input type="text" class="txtName" name="first_name" value="<?php echo $_POST['first_name']; ?>"><br>
                  Last Name: <input type="text" class="txtName" name="last_name" value="<?php echo $_POST['last_name']; ?>"><br>
                  Middle Name: <input type="text" class="txtName" name="middle_name" value="<?php echo $_POST['middle_name']; ?>"><br>
                  Organization: <input type="text" name="organization" value="<?php echo $_POST['organization']; ?>"><br>
                  Position: <input type="text" name="position" value="<?php echo $_POST['position']; ?>"><br>
                  Email: <input type="text" name="email" value="<?php echo $_POST['email']; ?>"><br>
                  Phonenumber: <input type="text" class="only-numeric" name="phone_number" value="<?php echo $_POST['phone_number']; ?>"><br>
                               <div class="error" style="color: red; display: none">* Input digits (0 - 9)</div><br>
                  Access method &nbsp;&nbsp;&nbsp;&nbsp; <select name="access">
                                         <option value="Select access method..."  <?php if ("Select access method..."  == $_POST['access']) { echo " selected"; } ?>>Select access method...</option>
                                         <option value="Administrator"  <?php if ("Administrator"  == $_POST['access']) { echo " selected"; } ?>>Admistrator</option>
                                         <option value="User"<?php if ("User"  ==  $_POST['access']) { echo " selected"; } ?>>User</option>
                                  </select>
                  
                  <br><br> 
                 <input type="submit" name="submit" value="Register"> &nbsp; 
                 <input type="reset" value="Clear">
              </form> 
         
               <?php
               } 
               else 
               {
                $query = "INSERT INTO person (username, password, first_name, last_name, middle_name, organization, position, email, phonenumber, access) " . 
                         "VALUES ('" . $_POST['username'] . "', " .
                                   "(PASSWORD('" . $_POST['password'] . "')), '" .
                                    $_POST['first_name'] . "', '" . 
                                    $_POST['last_name'] . "', '" . 
                                    $_POST['middle_name'] . "', '" . 
                                    $_POST['organization'] . "', '" . 
                                    $_POST['position'] . "', '" . 
                                    $_POST['email'] . "', '" . 
                                    $_POST['phone_number'] . "', '" . 
                                    $_POST['access'] . "');";
                          $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
                          $_SESSION['user_logged'] = $_POST['username'];
                          $_SESSION['user_password'] = $_POST['password'];
               ?>
                <p> Thank you, <?php echo $_POST['first_name'] . " " . $_POST['last_name']; ?> for registering!<br>
              <?php 
                    echo "Your registration is complete! " . "You are being sent to the page you requested!<br>";
                    
                     Header("Location:index.php"); 
               }
       } 
       else
        {                                                                           
              ?> 
         <font color="#FF0000"><b>The  fields are required!</b></font>
             <form action="register.php" method="post">
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
                  Access method  &nbsp;&nbsp;&nbsp;&nbsp; <select name="access">
                                         <option value="Select access method..."  <?php if ("Select access method..."  == $_POST['access']) { echo " selected"; } ?>>Select access method...</option>
                                         <option value="Administrator"  <?php if ("Administrator"  == $_POST['access']) { echo " selected"; } ?>>Admistrator</option>
                                         <option value="User"<?php if ("User"  ==  $_POST['access']) { echo " selected"; } ?>>User</option>
                                  </select>
                  <br><br>
                 <input type="submit" name="submit" value="Register"> &nbsp; 
                 <input type="reset" value="Clear"> 
             </form>
            
    <?php 
        } 
     }
      else
      {
    ?>
           <font> Welcome to the registration page!<br>
               The All fields are required!</font>
               
              <form action="register.php" method="post">
                       Username: <input type="text" name="username"><br> 
                       Password: <input type="password" name="password"><br> 
                       First Name: <input type="text" name="first_name" class="txtName"><br>
                       Last Name: <input type="text" name="last_name" class="txtName"><br>
                      Middle Name: <input type="text" name="middle_name" class="txtName"><br>
                      Organization: <input type="text" name="organization" ><br>
                      Position: <input type="text" name="position" ><br>
                      Email:  <input type="text" name="email" ><br>
                      Phonenumber: <input type="text" name="phone_number" class="only-numeric"><br>
                                 <div class="error" style="color: red; display: none">* Input digits (0 - 9)</div><br>
                      Access method &nbsp;&nbsp;&nbsp;&nbsp; <select name="access">
                                                                    <option value="Select access method..."> Select access method... </option>
                                                                     <option value="Administrator" > Admistrator </option>
                                                                     <option value="User"> User </option>
                                                              </select>
                       <br><br> 
                       <input type="submit" name="submit" value="Register"> &nbsp; 
                       <input type="reset" name="clear" value="Clear"> 
              </form>
            
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
       