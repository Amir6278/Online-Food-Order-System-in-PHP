


    
                        echo ' 
                   <tr>
                 <th scope="row">' . $i . '</th>
                 <td> ' .   $fetchRow['name'] . ' </td>
                 <td>' .   $fetchRow['mobile'] . '</td>
                

                 <td> <a type="button" href="?Id='.$fetchRow['id'].'" class=" edit btn  btn-outline-success my-3" id="'.$fetchRow['id'].'"   data-bs-target="#exampleModal"  data-bs-toggle="modal" > Edit</a> </a> 
                 <input type="hidden"  id="delsno" name="delsno">
                 
                 
                 ';

                  if($fetchRow['status']=='1'){
                      echo '  <a type="button" class="btn  btn-primary border-dark"  href="?Id='.$fetchRow['id'].'&type=deactive">Active</a> ';

                  }
                  else{
                      echo '<a type="button" class="btn  btn-warning border-dark" href="?Id='.$fetchRow['id'].'&type=active">Deactive </a> ';
                  }
                 
                //   <a href=""><span class="badge bg-primary p-2 my-1 ">Pending</a>
                  
                 echo '</td> <td> ' .   $fetchRow['added_on'] . ' </td>  </tr> ';
                        $i++;
                    }
                } else {
                    echo '<div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> No records found
                  </div>';
                }









<?php








