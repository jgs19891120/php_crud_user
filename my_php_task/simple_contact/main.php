<?php
    session_start();
    $link = mysqli_connect("localhost", "root", "") or die("Could not connect: " . mysqli_error($link)); 
    mysqli_select_db($link, 'user_info' ) or die(mysqli_error($link)); 
?> 
<html>
 <head>
    <title>contact</title>
    <meta charset="utf-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <style type="text/css">
               
       #deleted_table{
        max-height: 100px;
        overflow: auto;
        overflow-x: hidden;
        } 
        
        #person_table{
            max-height: 300px;
            overflow: auto;
            overflow-x: hidden;
        } 
                 
 </style>
 </head>
 <body> 
        <div class="container" >
            <div class="row" >
                <div class="col-md-9" id="persons_table">
                         
                    <div class="page-header clearfix">
                        <h1 class="pull-left">Persons Details &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                             <a href="inner.php?action=add&id=" class="btn btn-success pull-right">ADD</a>
                        </h1>
                         
                    </div>
                     
                     <div class="table">
                                <table class='table table-striped table-bordered table-sm' id="dtBasicExample" > 
                                      <tr>
                                           
                                                <input type="text"
                                                 class="form-control form-control-lg rounded-0 border-primary" name="search" 
                                                 id="search_text" placeholder="Search...">
                                           
                                      </tr>
                                 </table>
                                 <div id="person_table">    
                                            <table class="table table-striped table-bordered table-sm" id="dtBasicExample" > 
                                                <thead >
                                                    <tr>
                                                        <th> <a class="column_sort" id="username" data-order="desc" href="#"> User name </a></th>
                                                        <th> <a class="column_sort" id="first_name" data-order="desc" href="#"> Full name   </th>
                                                        <th> <a class="column_sort" id="organization" data-order="desc" href="#">Organization   </th>
                                                        <th> <a class="column_sort" id="position" data-order="desc" href="#">Position  </th>
                                                        <th> <a class="column_sort" id="email" data-order="desc" href="#">Email   </th>
                                                        <th> <a class="column_sort" id="phonenumber" data-order="desc" href="#">Phone number   </th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                               <?php 
                                                     $personsql = "SELECT * FROM person ORDER BY username DESC" ;
                                                      
                                                      $result = mysqli_query($link,$personsql) or die("Invalid query: " . mysqli_error($link)); 
                                                      while ($row = mysqli_fetch_array($result))
                                                       { 
                                             ?>              
                                                        <tr> 
                                                             <td> <?php echo $row['username'];?></td>
                                                             <td><?php echo $row['first_name'] ."&nbsp" ,  $row['last_name']."&nbsp" ,$row['middle_name']; ?> </td>
                                                             <td> <?php  echo $row['organization'];?> </td>
                                                             <td> <?php  echo $row['position']; ?> </td> 
                                                             <td><?php echo $row['email'];?>  </td>
                                                             <td> <?php echo $row['phonenumber']; ?></td>
                                                             <td> 
                                                                     <a href="inner.php?action=edit&id=<?php echo $row['person_id'];?>&access=<?php echo $row['access'];?>" title='Update Record' data-toggle='tooltip'>
                                                                     <span class='glyphicon glyphicon-pencil'></span>
                                                                     </a> 
                                                                     <a href="delete.php?type=person&id=<?php echo $row['person_id']?>&access=<?php echo $row['access'];?>" title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a> 
                                                             </td> 
                                                         </tr> 
                                             <?php    
                                                       }  ?>
                                                  </tbody>
                                             </table>
                                             </div>
                                 
                     </div>
                    
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-2">
                        <table class="table">
                              
                              <tbody>
                                <tr colspan="2">
                                     <h3 style="text-align: center;">information</h3> 
                                </tr>
                                
                                <?php
                                    $query = "SELECT * FROM person " . "WHERE person_id = '" . $_SESSION['id'] . "'";
                                    $result = mysqli_query($link, $query) or die(mysqli_error($link));
                                     $row = mysqli_fetch_array($result);
                                ?>
                                <tr>
                                    <td>ID &nbsp;:</td> 
                                    <td><?php echo $row['username'];?></td>
                                </tr>
                                <tr>
                                    <td>Name &nbsp;:</td> 
                                    <td><?php echo $row['first_name'];?></td>
                                </tr>
                                <tr>
                                    <td>Email &nbsp;:</td> 
                                    <td><?php echo $row['email'];?></td>
                                </tr>
                                <tr>
                                    <td>Phone :</td> 
                                    <td><?php echo $row['phonenumber'];?></td>
                                </tr> 
                                <tr>
                                    <td>Method:</td> 
                                    <td><?php echo $row['access'];?></td>
                                </tr>  
                                <tr>
                                    <td><a href="inner.php?action=edit&id=<?php echo $row['person_id'];?>" class="btn btn-success pull-right">EDIT</a></td> 
                                    <td><a a href="logout.php" title="Logout" class="btn btn-danger">LOG OUT</a></td>
                                </tr>
                              </tbody>
                       
                        </table>
                    </div>
                </div>
                
            
          
  
        <div class="row" style="margin-top: 50px;">
            <div class="col-md-9" id="deleted_display">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-tag"></span>&nbsp; &nbsp; Recently deleted users. (Only Administrator can see list)</h3>
                    </div>
                    <div id="deleted_table">
                        <?php
                           include "deleted_person.php";
                        ?>
                    </div>
                </div>
            </div>
        </div>
       </div>
       
       
       
       <script>
   
    $(document).ready(function() {
         $(document).on("click",".column_sort", function(){
             
             
            var column_name = $(this).attr("id");
            var order = $(this).data("order");
            var query =  $("#search_text").val();
           
             if(order == 'desc')
             {
                 arrow = '&nbsp; <span class="glyphicon glyphicon-arrow-down" id="'+column_name+'" name="'+order+'"></span>'; 
             }
             else
             {
                 arrow = '&nbsp; <span class="glyphicon glyphicon-arrow-up" id="'+column_name+'" name="'+order+'"></span>';
             }
             
             $.ajax({
                url:"sort.php",
                method:"POST",
                data:{column_name:column_name, order:order, query:query},
                success:function(data)
                {    
                //alert(data); 
                    $('#person_table').html(data);
                    $('#'+column_name+'').append(arrow);
                  
                   
                } 
             });
        });
        
       
    });
    
    
        $("#search_text").keyup(function(){
       
                var column_name =$("span").attr("id")
                var order =  $("span").attr("name");
                var query =  $("#search_text").val();
                
               
                
                  if(column_name != ""){
                       
                      if(order == 'desc')
                         {
                             arrow = '&nbsp; <span class="glyphicon glyphicon-arrow-down" id="'+column_name+'" name="'+order+'"></span>'; 
                         }
                         else
                         {
                             arrow = '&nbsp; <span class="glyphicon glyphicon-arrow-up" id="'+column_name+'" name="'+order+'"></span>';
                         }
                   $.ajax({
                        url:"action.php",
                        method:"POST",
                        data:{query:query},
                        success:function(data)
                        {     
                            $('#person_table').html(data);
                            $('#'+column_name+'').append(arrow);
                        } 
                     });
                  }
                     
                  else
                  {
                       $.ajax({
                        url:"action.php",
                        method:"POST",
                        data:{  column_name:column_name, order:order, query:query},
                        success:function(data)
                        {     
                            $('#person_table').html(data);
                            $('#'+column_name+'').append(arrow);
                        } 
                     });
                     
                  }
              
        });
   
</script>
 
 </body> 
</html>

 