<?php
  $connect = mysqli_connect("localhost", "root", "") or die ("Hey loser, check your server connection."); 
        $create = mysqli_query( $connect,"CREATE DATABASE IF NOT EXISTS user_info") or die(mysqli_error($connect)); 
        mysqli_select_db($connect,"user_info");
        
        $output = '';
        $order = $_POST["order"];
        $select_item = $_POST['column_name'];
        $search = $_POST['query'];
        
        if($order == 'desc')
        {
            $order = 'asc';
        }
        else
        {
            $order = 'desc';
        }
        
        $output .='<table class="table table-striped table-bordered table-sm" id="dtBasicExample" > 
                            <thead>
                                <tr>
                                    <th> <a class="column_sort" id="username" data-order="'.$order.'"" href="#"> User name </a></th>
                                    <th> <a class="column_sort" id="first_name" data-order="'.$order.'"" href="#"> Full name   </th>
                                    <th> <a class="column_sort" id="organization" data-order="'.$order.'"" href="#">Organization   </th>
                                    <th> <a class="column_sort" id="position" data-order="'.$order.'"" href="#">Position  </th>
                                    <th> <a class="column_sort" id="email" data-order="'.$order.'"" href="#">Email   </th>
                                    <th> <a class="column_sort" id="phonenumber" data-order="'.$order.'"" href="#">Phone number   </th>
                                    <th> Action  </th>
                                </tr>
                            </thead>
                            <tbody>';
                            
         
                          
        if(isset($_POST['query']) && $_POST['query'] !=""){
            
          $search = $_POST['query'];
          $stmt = $connect->prepare("SELECT * FROM person WHERE username LIKE CONCAT('%',?, '%') ORDER BY ".$select_item." ".$order."");
          $stmt->bind_param("s", $search);
          $stmt->execute();
          $result = $stmt->get_result();

        }
        else
        {
             if(isset($select_item) && $select_item != "first_name"){
                 
                $query = "SELECT * FROM person ORDER BY first_name, last_name, middle_name ".$order.""; 
                  $result = mysqli_query($connect, $query);  
             }
             else
             {
                  $query = "SELECT * FROM person ORDER BY ".$select_item." ".$order.""; 
                  $result = mysqli_query($connect, $query); 
             }
        }   
     
         while($row = $result->fetch_assoc()){
             $output .='<tr>
                         <td> '.$row["username"].'</td>
                         <td> '.$row['first_name'].'&nbsp;'. $row['first_name'].' '. $row['middle_name'].'</td>
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
          $output .='</tbody> </table>';
   echo $output;
?>   