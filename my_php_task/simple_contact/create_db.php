<?php 
  $connect = mysqli_connect("localhost", "root", "") or die ("Hey loser, check your server connection."); 
  $create = mysqli_query( $connect,"CREATE DATABASE IF NOT EXISTS user_info") or die(mysqli_error($connect)); 
  mysqli_select_db($connect,"user_info");
  
  
  $person = "CREATE TABLE person ( person_id int(11) NOT NULL auto_increment,
               username varchar(255) NOT NULL,  password  varchar(255) NOT NULL,
               first_name varchar(255) NOT NULL, last_name varchar(255) NOT NULL,
               middle_name varchar(255) NOT NULL, organization varchar(255) NOT NULL,
               position varchar(255) NOT NULL, email varchar(255) NOT NULL,
               phonenumber int(20) NOT NULL default 0,access varchar(255) NOT NULL,
               PRIMARY KEY  (person_id) )";
  $results = mysqli_query($connect, $person) or die (mysqli_error($connect));
  
  
  
  
  $deleted_user =  "CREATE TABLE deleted_user ( person_id int(11) NOT NULL auto_increment,
               username varchar(255) NOT NULL,  password  varchar(255) NOT NULL,
               first_name varchar(255) NOT NULL, last_name varchar(255) NOT NULL,
               middle_name varchar(255) NOT NULL, organization varchar(255) NOT NULL,
               position varchar(255) NOT NULL, email varchar(255) NOT NULL,
               phonenumber int(20) NOT NULL default 0,access varchar(255) NOT NULL, deleted_date varchar(255) NOT NULL,
               PRIMARY KEY  (person_id) )";
   $results = mysqli_query($connect, $deleted_user) or die (mysqli_error($connect));
  
  echo "users Database successfully created!";
  
     mysqli_close($connect);
  
  ?>
  