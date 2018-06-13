<?php include 'header.php'; include 'assets/page/func.php';
if($_GET['Add'] == 'Add'){ ?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-4 important">
                <h3 class="page_title">Add Property</h3>
                <div class="whitebg">
                    <form method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Address 1</label>
                            <input type="text" class="form-control" name="address1" value="<?php echo $user['email']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Address 2</label>
                            <input type="text" class="form-control" name="address2" value="<?php echo $user['mobile']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" name="city" required>
                        </div>
                        <div class="form-group">
                            <label>Size</label>
                            <input type="text" class="form-control" name="size" required>
                        </div>
                        <div class="form-group">
                            <label>Rent</label>
                            <input type="text" class="form-control" name="rent" required>
                        </div>
                                          
                        <div class="text-right">
                            <button type="submit" name="sbt" class="btn btn-default">Add</button>
                        </div>
                    </form>
                </div>           
<?php
    if(isset($_REQUEST['sbt'])){
        $name = mysql_real_escape_string($_REQUEST['name']);
        $address1 = mysql_real_escape_string($_REQUEST['address1']);
        $address2 = mysql_real_escape_string($_REQUEST['address2']);
	$city = mysql_real_escape_string($_REQUEST['city']);
	$size = mysql_real_escape_string($_REQUEST['size']);
	$rent = mysql_real_escape_string($_REQUEST['rent']);

        /*mysql_query("INSERT INTO `properties`(`name`, `address`, `address1`, `city`,`size`,`rent`) VALUES ('".$name."','".$address1."','".$address2."', '".$city."', '".$size."', '".$rent."')"); */
	mysql_query("INSERT INTO `properties`(`name`, `address`, `address1`, `city`,`size`,`rent`) VALUES ('$name','$address1','$address2', '$city', '$size', '$rent')");
?>
            
                <p><br>Post Added</p>
            
<?php } ?>
                    
                     
            </div>
            <div class="col-md-8">
                <h3 class="page_title"><a href="post.php">All Post</a></h3>
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Address1</th>
                                <th>Address2</th>
                                <th>City</th>
                                <th>Size</th>
                                 <th>Rent</th>
                            </tr>
                            <?php
                            $topic = mysql_query("select * from properties order by property_id desc limit 10");
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                                echo "<td>".$tt['name']."</td>";
                                echo "<td>".$tt['address1']."</td>";
                               echo "<td>".$tt['address2']."</td>";
                                echo "<td>".$tt['city']."</td>";
                                 echo "<td>".$tt['size']."</td>";
                                   echo "<td>".$tt['rent']."</td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
}else{
?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page_title"><?php num_rows('1','post') ?> - Post</h3>
            </div>
            <div class="col-md-12">
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">                         
                            <tr>
                               
                                <th>Name</th>
                                <th>Address1</th>
                                <th>Address2</th>
                                <th>City</th>
                                <th>Size</th>
                                 <th>Rent</th>
                                <th class="text-center">View </th>
                                <th class="text-center">Edit </th>
                                <th class="text-center">Delete</th>
                            </tr>
                            <tbody>
                            <?php                            
                            $topic = mysql_query("select * from properties where status = '1' order by property_id desc limit $start_from, $num_rec_per_page");
                            while($tt = mysql_fetch_assoc($topic)){
                               echo "<tr>";
                                echo "<td>".$tt['name']."</td>";
                                echo "<td>".$tt['address1']."</td>";
                               echo "<td>".$tt['address2']."</td>";
                                echo "<td>".$tt['city']."</td>";
                                 echo "<td>".$tt['size']."</td>";
                                   echo "<td>".$tt['rent']."</td>";
                               
                            ?>
                            <td class="text-center"><a href="view_post.php?id=<?php echo $tt['post_id']; ?>"><i class="material-icons">visibility</i></a></td>
                            <td class="text-center"><a href="edit_post.php?id=<?php echo $tt['post_id']; ?>"><i class="material-icons">edit</i></a></td>
                            <td class="text-center"><a class="deletetopic" href="assets/page/disable.php?table=post&id=<?php echo $tt['post_id']; ?>"><i class="material-icons">delete</i></a></td>
                            <?php
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center paginasion">
                        <?php                        
                        $total_records = mysql_num_rows(mysql_query("select * from post where status = '1'"));
                        $total_pages = ceil($total_records / $num_rec_per_page);
                        for ($i=1; $i<=$total_pages; $i++) { 
                            echo "<a href='?page=".$i."' class='active$i'>".$i."</a> "; 
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

<?php include 'footer.php'; ?>

<style>
    th.text-center {
        width: 16px;
    }
    .hidetime{
        display: none;
    }
    p#aboutresult {
        margin: 5px 0 0 5px;
    }
    .redbg *{
        background: #f00;
        color: #fff;
    }
</style>

<script>
      
    $(".deletetopic").click(function(){
        $(this).parent().parent().addClass("redbg");
        $(".redbg").fadeOut();
        $.ajax({
            type: "POST",
            url: $(this).attr('href'),
            data: "123",
            success: function(login){
                
            }
        });
        return false;
    });
    
    
</script>
<?php } ?>