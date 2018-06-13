<?php include 'header.php'; include 'assets/page/func.php'; ?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page_title">Admin History</h3>
            </div>
            <div class="col-md-6">
                <div class="whitebg">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Day</th>
                        </tr>
                        <?php
                        if(!$_GET['date']){
                        $sql = mysql_query("select * from admin order by id desc limit $start_from, $num_rec_per_page");
                        while($user = mysql_fetch_array($sql)){
                            echo "<tr>";
                            echo "<td>".$user['name']."</td>";
                            echo "<td>".date('d/m/Y', strtotime($user['date']))."</td>";
                            echo "<td>".$user['time']."</td>";
                            echo "<td>".date('l', strtotime($user['date']))."</td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                    </div>                    
                    <div class="text-center paginasion">
                        <?php                        
                        $total_records = mysql_num_rows(mysql_query("select * from admin"));
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
                    <?php }else{ 
                            echo "<p>Date : ".date('d/m/Y - l', strtotime($_GET['date']))."</p>";
                    $sql = mysql_query("select * from admin where date = '".$_GET['date']."' order by id desc");
                        while($user = mysql_fetch_array($sql)){
                            echo "<tr>";
                            echo "<td>".$user['name']."</td>";
                            echo "<td>".date('d/m/Y', strtotime($user['date']))."</td>";
                            echo "<td>".$user['time']."</td>";
                            echo "<td>".date('l', strtotime($user['date']))."</td>";
                            echo "</tr>";
                        }
                            echo "<p>Total Login : ".mysql_num_rows($sql)." times</p>";
                        ?>
                    </table>
                
                    </div>
<style>
    th{
        border-top: 2px solid #ddd !important;
    }
    .myshow{
        display: block !important;
    }
</style>
                    <?php } ?>
                    
                </div>
            </div>
            <div class="col-md-6 important">
                <div class="whitebg">
                    <form method="get">
                        <div class="form-group">
                            <label>Date</label>
                            <select class="form-control" name="date">
                                <option style="display:none"> -- Select Date -- </option>
                                <?php
                                $sql = mysql_query("select * from admin group by date order by id desc");
                                while($date = mysql_fetch_array($sql)){
                                    echo "<option value='".$date['date']."'>".date('d/m/Y', strtotime($date['date']))." - ".date('l', strtotime($date['date']))."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                    <br>
                <div class="whitebg myshow" style="display:none;">
                    <div id="post_chart" style="height: 250px; width: 100%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
<script>
    $("select").change(function(){
        $('form').submit();
    });
       
$(window).load(function(){
    chartsload();
});
function chartsload() {
	var chart = new CanvasJS.Chart("post_chart", {
		theme: "theme4",
		title:{
			text: "Admin Timeline",
            fontSize: 17
		},
        margin:0,
		animationEnabled: true,
        exportEnabled: 1,
        exportFileName: "Post Timeline",
		data: [              
		{
			type: "area",
			dataPoints: [
                <?php admin_inner_page_chart($_GET['date']); ?>
			]
		}
		]
	});
	chart.render();
}
</script>