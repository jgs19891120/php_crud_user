<?php 
//connect to MySQL 
$connect = mysqli_connect("localhost", "root", "") or die ("Hey loser, check your server connection."); 
//make sure we're using the right database 
mysqli_select_db($connect, "user_info");
 //insert data into "person" table
  $insert = "INSERT INTO person (person_id, username, password ," .
               "first_name, last_name," .
               "middle_name, organization," .
               "position, email,".
               "phonenumber, access )" .
               
               "VALUES (1, 'aaa', 'pass',
                     'aaa', 'bbb', 
                     'ccc', 'aaa',
                      'bbb', 'ccc',
                       13123213, 'User')";
             
    $results = mysqli_query($connect,$insert) or die(mysqli_error($connect));
    
      $delete = "INSERT INTO deleted_user (person_id, username, password ," .
               "first_name, last_name," .
               "middle_name, organization," .
               "position, email,".
               "phonenumber, access )" .
               
               "VALUES (1, 'aaa', 'pass',
                     'aaa', 'bbb', 
                     'ccc', 'aaa',
                      'bbb', 'ccc',
                       13123213, 'User')";
    
    mysqli_close($connect);
    echo "Data inserted successfully!";
   ?>