<?php include 'header.php'; include 'assets/page/func.php'; 


?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
              <div class="col-md-4 important">
                <h3 class="page_title">Add User</h3>
                <div class="whitebg">
                    <form method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="Search text" required>
                        </div>
                  
                                            
                                          
                        <div class="text-right">
                            <button type="submit" name="sbt" class="btn btn-default">Search</button>
                        </div>
                    </form>
                </div>                                
            </div>
            </div>
            </div>
            <div class="inner_section">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page_title"><?php num_users($condition); echo " - "; ?><?php echo $type." "; ?>Users</h3>
            </div>
            <div class="col-md-12">
                <div class="whitebg">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th class="text-center login_his">View Login</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center activate">Activate</th>
                            <th class="text-center deactivate">Deactivate</th>
                        </tr>
                        <?php     
                       if(isset($_REQUEST['sbt'])){
                         $name = mysql_real_escape_string($_REQUEST['name']);                                           
                        $sql = mysql_query("select * from user where `name` LIKE '%$name%' order by user_id desc limit $start_from, $num_rec_per_page");
                        while($user = mysql_fetch_array($sql)){
                        ?>                        
                        <tr>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['mobile']; ?></td>
                            <td class="text-center login_his"><a href="user_login.php?user=<?php echo $user['email']; ?>"><i class="material-icons">remove_red_eye</i></a></td>
                            <td class="text-center"><a href="edit_user.php?id=<?php echo $user['user_id']; ?>"><i class="material-icons">edit</i></a></td>
                            <td class="text-center activate"><a class="deletetopic" href="assets/page/enabled.php?table=user&id=<?php echo $user['id']; ?>"><i class="material-icons">done</i></a></td>
                            <td class="text-center deactivate"><a class="deletetopic" href="assets/page/disable.php?table=user&id=<?php echo $user['id']; ?>"><i class="material-icons">delete</i></a></td>
                        </tr>
                        <?php
                        }
                        }
                        ?>
                    </table>
                </div>
                    
                    <div class="text-center paginasion">
                        <?php                        
                        $total_records = mysql_num_rows(mysql_query("select * from user where `status` = '".$condition."'"));
                        $total_pages = ceil($total_records / $num_rec_per_page);
                        for ($i=1; $i<=$total_pages; $i++) { 
                            echo "<a href='?page=".$i."&u=".$type."' class='active$i'>".$i."</a> "; 
                        }
                        ?>   
                        <style>
                            .paginasion a.active<?php echo $page; ?>{
                                background: #1976d2;
                                color: #fff;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
           