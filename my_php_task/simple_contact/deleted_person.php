 <?php
       $query = "SELECT * FROM person " . "WHERE person_id = '" . $_SESSION['id'] . "'";
                    $result = mysqli_query($link, $query) or die(mysqli_error($link));
                     $row = mysqli_fetch_array($result);
        
     if($row['access'] == "Administrator")
     {
 ?> 
        <table  class="table"> 
             <!--<thead>
                <tr>
                                <th>User name</th>    
                                <th>Name</th>    
                                <th>Mail</th>
                                <th>Phone</th>        
                            </tr>                
             </thead>-->
                <tbody id="deleted_users">
                
                <?php         
                              $personsql = "SELECT * FROM deleted_user ";
                              $result = mysqli_query($link,$personsql) or die("Invalid query: " . mysqli_error($link)); 
                              
                              while ($row = mysqli_fetch_array($result))
                               { 
                ?>  
                                 <tr> 
                                     <td>
                                      <?php echo  "USER&nbsp&nbsp <span style='color:blue'>".$row['username']."</span>&nbsp;&nbsp;",
                                       "( full name:&nbsp".$row['first_name']."&nbsp;&nbsp;".$row['last_name']."&nbsp;&nbsp;".$row['middle_name']."&nbsp;&nbsp;",
                                        ",  mail:  ".$row['email']."&nbsp;&nbsp;", 
                                         ",  phonenumber:  ".$row['phonenumber']."&nbsp;&nbsp;)"
                                        ?> 
                                       <?php echo  "<span style='color:red'> is deleted.</span>  &nbsp;&nbsp;&nbsp;". $row['deleted_date']  ?>
                                     </td>
                                    
                                    
                                 </tr>
                             <?php
                               } 
                }
                             ?>
                </tbody>                 
             </table>