<?php
  $connect = mysqli_connect("localhost", "root", "") or die ("Hey loser, check your server connection."); 
        $create = mysqli_query( $connect,"CREATE DATABASE IF NOT EXISTS user_info") or die(mysqli_error($connect)); 
        mysqli_select_db($connect,"user_info");
        
        
        $output = '';
        
        if(isset($_POST['query'])){
          $search = "%{$_POST['query']}%";
          
          $stmt = $connect->prepare("SELECT * FROM person WHERE username LIKE ?");
          $stmt->bind_param("s", $search);
        }
        else
        {
           $query = "SELECT * FROM person ";
         
        }  
        
        
        $stmt->execute();
        $result = $stmt->get_result();
        $result->num_rows;
      
        
        if( $result->num_rows > 0){
            $output .='<table class="table table-striped table-bordered table-sm" id="dtBasicExample" > 
                        <thead >
                            <tr>
                                <th> <a class="column_sort" id="username" data-order="desc" href="#"> User name </a></th>
                                <th> <a class="column_sort" id="first_name" data-order="desc" href="#"> Name   </th>
                                <th> <a class="column_sort" id="organization" data-order="desc" href="#">Organization   </th>
                                <th> <a class="column_sort" id="position" data-order="desc" href="#">Position  </th>
                                <th> <a class="column_sort" id="email" data-order="desc" href="#">Email   </th>
                                <th> <a class="column_sort" id="phonenumber" data-order="desc" href="#">Phone number   </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>';
                        while($row = $result->fetch_assoc()){
                              $output .='<tr>
                         <td> '.$row["username"].'</td>
                         <td> '.$row['first_name'].' </td>
                         <td> '.$row['organization'].' </td>
                         <td>  '.$row['position'].'</td> 
                         <td> '.$row['email'].'</td>
                         <td>  '.$row['phonenumber'].'</td>
                         <td> 
                                 <a href="inner.php?action=edit&id='.$row['person_id'].'&access='.$row['access'].'>" title="Update Record" data-toggle="tooltip">
                                 <span class="glyphicon glyphicon-pencil"></span>
                                 </a> 
                                 <a href="delete.php?type=person&id='.$row['person_id'].'&access='.$row['access'].'>" title="Delete Record" data-toggle="tooltip"><span class="glyphicon glyphicon-trash"></span></a> 
                         </td> 
                     </tr>';  
                    }
             $output .='</tbody></table>';
        echo $output;   
    }
       
         
?>   