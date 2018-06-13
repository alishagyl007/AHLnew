<?php include 'header.php'; include 'assets/page/func.php'; 
if($_GET['Add'] == 'Add'){ ?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-4 important">
                <h3 class="page_title">Add Task</h3>
                <div class="whitebg">
                    <form method="post">
<div class="form-group">
                            <label>Employee</label>
                            <select class="form-control" name="school">
                                <?php
                                $selec = mysql_query("select * from user order by user_id desc");
                                while($school = mysql_fetch_assoc($selec)){
                                        echo "<option value='".$school['user_id']."'>".$school['name']."</option>";
                                }
                                ?>
                            </select>
                        </div>   
                        <div class="form-group">
                            <textarea required name="task" autofocus class="form-control" placeholder="Enter Task" rows="7"></textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit" name="sbt" class="btn btn-default">Add Task</button>
                        </div>
                    </form>
                </div>            
<?php
    if(isset($_REQUEST['sbt'])){
        $task = mysql_real_escape_string($_REQUEST['task']);
        $employee_id = mysql_real_escape_string($_REQUEST['school']);
        mysql_query("INSERT INTO `tasks`(`employee_id`, `task`, `status`) VALUES ('".$employee_id."','".$task."','1')");
?>
            <div class="col-md-12 text-center">
                <p><br>Task Added</p>
            </div>
<?php } ?>
                    
                     
            </div>
            <div class="col-md-8">
                <h3 class="page_title"><a href="topics.php">All Tasks</a></h3>
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Employee</th>
                                <th>Task</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                            <?php
                            $topic = mysql_query("select * from tasks order by id desc limit 10");
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                                
                                $userschool = mysql_query("select * from user where user_id = '".$tt['employee_id']."' limit 1");
                                $school = mysql_fetch_assoc($userschool);
                                echo "<td>".$school['name']."</td>";

                                echo "<td>".$tt['task']."</td>";
                                echo "<td>".date("d/m/Y",strtotime($tt['timestamp']))."</td>";
                                echo "<td>".date("h:i:sa",strtotime($tt['timestamp']))."</td>";
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
                <h3 class="page_title"><?php num_rows('1','tasks') ?> - Tasks </h3>
            </div>
            <div class="col-md-12">
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">                         
                            <tr>
                                <th>Employee</th>
                                <th>Task</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th class="text-center">View Task</th>
                                <th class="text-center">Edit Task</th>
                                <th class="text-center">Delete Task</th>
                            </tr>
                            <tbody>
                            <?php                            
                            $topic = mysql_query("select * from tasks where status = '1' order by id desc limit $start_from, $num_rec_per_page");
                            while($tt = mysql_fetch_assoc($topic)){
                                echo "<tr>";
                               
                                $userschool = mysql_query("select * from user where user_id = '".$tt['employee_id']."' limit 1");
                                $school = mysql_fetch_assoc($userschool);
                                echo "<td>".$school['name']."</td>";

                                echo "<td>".$tt['task']."</td>";
                                echo "<td>".date("d/m/Y",strtotime($tt['timestamp']))."</td>";
                                echo "<td>".date("h:i:sa",strtotime($tt['timestamp']))."</td>";
                            ?>
                            <td class="text-center"><a href="view_topics.php?id=<?php echo $tt['id']; ?>"><i class="material-icons">visibility</i></a></td>
                            <td class="text-center"><a href="edit_topics.php?id=<?php echo $tt['id']; ?>"><i class="material-icons">edit</i></a></td>
                            <td class="text-center"><a class="deletetopic" href="assets/page/disable.php?table=tasks&id=<?php echo $tt['id']; ?>"><i class="material-icons">delete</i></a></td>
                            <?php
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center paginasion">
                        <?php                        
                        $total_records = mysql_num_rows(mysql_query("select * from topic where status = '1'"));
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