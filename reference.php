<?php include 'header.php'; include 'assets/page/func.php'; 
 ?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-4 important">
                <h3 class="page_title">References</h3>
                <div class="whitebg">
                    <form method="post">
<div class="form-group">
                            <label>Add Reference</label>
                            
                        </div>   
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                        </div>
                       
                        <div class="text-right">
                            <button type="submit" name="sbt" class="btn btn-default">Save</button>
                        </div>
                    </form>
                </div>           
<?php
    if(isset($_REQUEST['sbt'])){
      $name= mysql_real_escape_string($_REQUEST['name']);
        
      mysql_query("INSERT INTO `reference`(`name`) VALUES ('$name')");
      header('Location: reference.php');
         
   
?>

<div class="col-md-12 text-center">
                <p><br>Reference Added</p>
            </div>

            
<?php } ?>
                    
                     
            </div>
            <div class="col-md-8">
                <h3 class="page_title"><a href="reference.php">All References</a></h3>
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                               
                                </tr>
                            <?php
                            $topic = mysql_query("select * from reference where status=1");
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                                echo "<td>".$tt['name']."</td>";
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
<?php  ?>