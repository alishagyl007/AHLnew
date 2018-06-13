<?php include 'header.php'; include 'assets/page/func.php'; 
$id = $_GET['id']; 
$sql = mysql_query("select * from ipo where id = '$id'");
$ipo = mysql_fetch_assoc($sql);
?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-6 important">
                <h3 class="page_title">Edit IPO</h3>
                <div class="whitebg">
                    <form method="post">
                        
                            
                           
                        <div class="form-group">
                        <label>IPO</label>
                       
                            <textarea rows="1" name="add_company_name" class="form-control" required><?php echo $ipo['Name']; ?></textarea>
                        </div>
                        <div class="form-group">
                        <label>Mininum Cut Off Price Band</label>
                            <input type="text" name="min_amount" class="form-control" required value="<?php echo $ipo['MinAmount'];?>" />
                        </div>
                        
                        <div class="form-group">
                        <label>Price Band</label>
                            <input type="text" name="price_band" class="form-control" required value="<?php echo $ipo['PriceBand'];?>" />
                        </div>
                         <div class="form-group">
                        <label>Lot Size</label>
                            <input type="text" name="lot_size" class="form-control" required value="<?php echo $ipo['LotSize'];?>" />
                        </div>
                        <div class="form-group">
                        <label>Open Date</label>
                            <input type="date" name="open_date" class="form-control" value="<?php echo $ipo['OpenDate'];?>" />
                        </div> 
                        <div class="form-group">
                        <label>Last Date</label>
                            <input type="date" name="last_date" class="form-control" value="<?php echo $ipo['LastDate'];?>" />
                        </div>                     
                        <div class="text-right">
                            <button type="submit" name="sbt" class="btn btn-default">Update</button>
                        </div>
                    </form>
<?php
if(isset($_REQUEST['sbt'])){
    $name = mysql_real_escape_string($_REQUEST['add_company_name']);
    $amount= mysql_real_escape_string($_REQUEST['min_amount']);
     $priceband= mysql_real_escape_string($_REQUEST['price_band']);
    $lotsize= mysql_real_escape_string($_REQUEST['lot_size']);
    $opendate= mysql_real_escape_string($_REQUEST['open_date']);
    $lastdate= mysql_real_escape_string($_REQUEST['last_date']);
    
    mysql_query("UPDATE `ipo` SET `Name`='$name',`MinAmount`=$amount,`PriceBand`='$priceband',`OpenDate`='$opendate',`LastDate`='$lastdate',`LotSize`='$lotsize',`Status`='1' WHERE id='$id'");
    header('Location: ipo.php');
}
?>
                </div>                                
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>