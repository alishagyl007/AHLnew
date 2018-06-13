<?php include 'header.php'; include 'assets/page/func.php'; 
$user_id = $_GET['id']; 
$sql = mysql_query("select * from user where user_id = '$user_id'");
$user = mysql_fetch_assoc($sql);
?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-4 important">
                <h3 class="page_title">Search by Name</h3>
                <div class="whitebg">
                    <form method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>" required>
                        </div>
                        
                                          
                        <div class="text-right">
                            <button type="submit" name="btnname" class="btn btn-default">Search</button>
                        </div>
                    </form>
                </div>                                
            </div>
            <div class="col-md-4 important">
                <h3 class="page_title">Search By Mobile</h3>
                <div class="whitebg">
                    <form method="post">
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" class="form-control" name="mobile" required>
                        </div>
                        <div class="text-right">
                            <button type="submit" name="btnmobile" class="btn btn-default">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 important">
                <h3 class="page_title">Search By Date</h3>
                <div class="whitebg">
                    <form method="post">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" class="form-control" name="sdate" required>
                        </div>
                        <div class="text-right">
                            <button type="submit" name="btndate" class="btn btn-default">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            </div>
      
<?php include 'footer.php';

if(isset($_REQUEST['btnname'])){
$name=mysql_real_escape_string($_REQUEST['name']);
    $topic = mysql_query("select a.id,a.name,a.mobile,a.email,b.name as pname from queries a,product b where a.product_id=b.id and a.name LIKE '%$name%' order by a.id desc limit $start_from, $num_rec_per_page");
    }

if(isset($_REQUEST['btnmobile'])){
    $mobile=mysql_real_escape_string($_REQUEST['mobile']);
    $topic = mysql_query("select a.id,a.name,a.mobile,a.email,b.name as pname from queries a,product b where a.product_id=b.id and a.mobile LIKE '%$mobile%' order by a.id desc limit $start_from, $num_rec_per_page");
}

if(isset($_REQUEST['btndate'])){
    $sdate=mysql_real_escape_string($_REQUEST['sdate']);
    $topic = mysql_query("select a.id,a.name,a.mobile,a.email,b.name as pname from queries a,product b,query_details c where a.product_id=b.id and c.followdate LIKE '%$sdate%' order by a.id desc limit $start_from, $num_rec_per_page");
}

?>
<div class="col-md-12">
                
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Product</th>
                                <th class="text-center">View Query</th>
                               <th class="text-center">Delete Query</th>
                            </tr>
                            <tbody>
                            <?php                            
                        
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                                echo "<td>".$tt['name']."</td>";                           
                                echo "<td>".$tt ['mobile']."</td>";
                                echo "<td>".$tt['email']."</td>";
                                echo "<td>".$tt['pname']."</td>";
                              
                            ?>
                            <td class="text-center"><a href="view_query.php?id=<?php echo $tt['id']; ?>"><i class="material-icons">visibility</i></a></td>
                            <td class="text-center"><a class="deletetopic" href="assets/page/disable.php?table=topic&id=<?php echo $tt['topic_id']; ?>"><i class="material-icons">delete</i></a></td>
                            <?php
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>                
            </div>

  </div>
    </div>
</div>
