<?php include 'header.php'; include 'assets/page/func.php'; 
$user_id = $_GET['id']; 
$sql = mysql_query("select * from tasks where id = '$user_id'");
$user = mysql_fetch_assoc($sql);
?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-6 important">
                <h3 class="page_title">Edit Task</h3>
                <div class="whitebg">
                    <form method="post">
                        <div class="form-group">
                            <label>Task</label>
                            <textarea rows="7" class="form-control" name="name" required><?php echo $user['task']; ?></textarea>
                        </div>                      
                        <div class="text-right">
                            <button type="submit" name="sbt" class="btn btn-default">Update</button>
                        </div>
                    </form>
<?php
if(isset($_REQUEST['sbt'])){
    $name = mysql_real_escape_string($_REQUEST['name']);
    mysql_query("UPDATE `tasks` SET `task`='$name' WHERE `id` = '$user_id'");
    header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
}
?>
                </div>                                
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>