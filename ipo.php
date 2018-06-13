<?php include 'header.php'; include 'assets/page/func.php'; 
if($_GET['Add'] == 'Add'){ ?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-4 important">
                <h3 class="page_title">IPO</h3>
                <div class="whitebg">
                    <form method="post">
<div class="form-group">
                            <label>Add new IPO</label>
                            
                        </div>   
                        <div class="form-group">
                            <input type="text" name="add_company_name" class="form-control" placeholder="Enter Company Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="min_amount" class="form-control" placeholder="Mininum Cut off band price" required>
                        </div>
                       
                        <div class="form-group">
                            <input type="text" name="price_band" class="form-control" placeholder="Price Band" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="lot_size" class="form-control" placeholder="Lot Size" required>
                        </div>
                        <div class="form-group">
                        <label>Open Date</label>
                            <input type="date" name="open_date" class="form-control" required >
                        </div>
                        <div class="form-group">
                        <label>Close Date</label>
                            <input type="date" name="last_date" class="form-control" required >
                        </div>
                        <div class="text-right">
                            <button type="submit" name="sbt" class="btn btn-default">Add IPO</button>
                        </div>
                    </form>
                </div>           
<?php
    if(isset($_REQUEST['sbt'])){
      $companyname= mysql_real_escape_string($_REQUEST['add_company_name']);
        $minamount= mysql_real_escape_string($_REQUEST['min_amount']);
        $open_date= mysql_real_escape_string($_REQUEST['open_date']);
          $last_date= mysql_real_escape_string($_REQUEST['last_date']); 
          $price_band= mysql_real_escape_string($_REQUEST['price_band']); 
           $lot_size= mysql_real_escape_string($_REQUEST['lot_size']); 
       
      mysql_query("INSERT INTO `ipo`(`Name`, `MinAmount`, `OpenDate`, `LastDate`, `PriceBand`, `LotSize`) VALUES 
      					('$companyname','$minamount','$open_date','$last_date','$price_band','$lot_size')");
    

       
   
?>

<div class="col-md-12 text-center">
                <p><br>IPO Added</p>
            </div>

            
<?php } ?>
                    
                     
            </div>
            <div class="col-md-8">
                <h3 class="page_title"><a href="ipo.php">All IPO</a></h3>
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Company Name</th>
                                <th>Minimum Cut Off Price Band</th>
                                <th>Price Band</th>
                                <th>Lot Size</th>
                                 <th>Open Date</th>
                                <th>Last Date</th>
                                </tr>
                            <?php
                            $topic = mysql_query("select * from ipo where status=1");
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                                echo "<td>".$tt['Name']."</td>";
                                echo "<td>".$tt['MinAmount']."</td>";
                                echo "<td>".$tt['PriceBand']."</td>";
                                echo "<td>".$tt['LotSize']."</td>";
                                 echo "<td>".date("d/m/Y",strtotime($tt['OpenDate']))."</td>";
                                echo "<td>".date("d/m/Y",strtotime($tt['LastDate']))."</td>";
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
                <h3 class="page_title"><?php num_rows('1','ipo') ?> - IPO </h3>
            </div>
            <div class="col-md-12">
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">                         
                            <tr>
                                <th>Company Name</th>
                                <th>Minimum Cut Off Price Band</th>
                                <th>Price Band</th>
                                <th>Lot Size</th>
                                 <th>Open Date</th>
                                <th>Last Date</th>
                               
                                
                                <th class="text-center">Edit IPO</th>
                                <th class="text-center">Delete IPO</th>
                            </tr>
                            <tbody>
                            <?php                            
                            $topic = mysql_query("select * from ipo where status=1 order by id desc limit $start_from, $num_rec_per_page");
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                                 echo "<td>".$tt['Name']."</td>";
                                echo "<td>".$tt['MinAmount']."</td>";
                                echo "<td>".$tt['PriceBand']."</td>";
                                echo "<td>".$tt['LotSize']."</td>";
                                 echo "<td>".date("d/m/Y",strtotime($tt['OpenDate']))."</td>";
                                echo "<td>".date("d/m/Y",strtotime($tt['LastDate']))."</td>";

                                                              
                            ?>
                            
                            <td class="text-center"><a href="edit_ipo.php?id=<?php echo $tt['id']; ?>"><i class="material-icons">edit</i></a></td>
                            <td class="text-center"><a class="deletetopic" href="assets/page/disable.php?table=ipo&id=<?php echo $tt['id']; ?>"><i class="material-icons">delete</i></a></td>
                            <?php
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center paginasion">
                        <?php                        
                        $total_records = mysql_num_rows(mysql_query("select * from ipo where status = '1'"));
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