
<table  border="0" width="20%" cellspacing="1" cellpadding="3" bgcolor="#353535">
     <tr>                                                                        
         <td bgcolor="aqua"  align="center">                                     
                User Information
         </td>
     </tr> 
     <?php
                    $query = "SELECT * FROM person " . "WHERE person_id = '" . $_SESSION['id'] . "'";
                    $result = mysqli_query($link, $query) or die(mysqli_error($link));
                    $row = mysqli_fetch_array($result);
     ?>
             <tr>
                <td bgcolor="#FFFFFF" align="center">  Username :&nbsp;&nbsp; <?php echo $row['username']; ?>  </td>
              
             </tr>
             <tr>
                <td bgcolor="#FFFFFF" align="center">  Access Method :&nbsp;&nbsp;  <?php echo $row['access']; ?>  </td>
             </tr>
             <tr>
                 <td bgcolor="#FFFFFF" align="center"> 
                        <a href="inner.php?action=edit&id=<?php echo $row['person_id'];?>">[EDIT]</a>
                 </td>
             </tr>
     
 </table>
 
 
 