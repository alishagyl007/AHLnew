<?php include 'header.php'; include 'assets/page/func.php'; ?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page_title">School</h3>
            </div>
            <div class="col-md-6">
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>School Name</th>
                                <th>Edit</th>
                            </tr>
                            <?php
                            $school_sql = mysql_query("select * from `school` order by id desc");
                            while($ss = mysql_fetch_array($school_sql)){
                                echo "<tr class='ss_".$ss['id']."'>";
                                echo "<td class='ss_name'>".$ss['name']."</td>";
                                echo "<td><a href='?school=".$ss['id']."&sname=".$ss['name']."'><i class='material-icons'>send</i></a></td>";
                                echo "</tr>";
                            }                                
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            <div class="row">
            <?php if($_GET['school']){ 
            $school_id = $_GET['school'];
            ?>
            <div class="col-md-12 important" style="margin-bottom:30px;">
                <div class="whitebg">
                    <form method="post" class="change_school">
                        <div class="form-group">
                            <label>Edit School Name</label>
                            <hr>
                            <input type="text" value="<?php echo $_GET['sname']; ?>" name="s_name" class="form-control" required autofocus>
                            <input type="text" value="<?php echo $_GET['school']; ?>" name="id" class="hidden">
                        </div>
                        <div class="text-left">
                            <button type="submit" class="btn btn-danger">Change</button>
                        </div>
                    </form>
                </div>
            </div>
            <style>
                .ss_<?php echo $school_id; ?>{
                    background: #f1f1f1;
                    border-top: 3px solid #f00 !important;
                    border-bottom: 3px solid #f00 !important;
                    border-right: 4px solid #f00 !important;
                    border-left: 5px solid #f00 !important;
                }
            </style>
            <?php } ?>
            <div class="col-md-12 important">
                <div class="whitebg">
                    <form method="post">
                        <div class="form-group">
                            <label>Add School</label>
                            <hr>
                            <input type="text" name="add_school_name" class="form-control" placeholder="Enter School Name" required>
                        </div>
                        <div class="text-left">
                            <button type="submit" name="sbt" class="btn btn-danger">Add School</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>

<?php include 'footer.php';
if(isset($_REQUEST['sbt'])){
    $add_school_name = mysql_real_escape_string($_REQUEST['add_school_name']);
    mysql_query("INSERT INTO `school`(`name`) VALUES ('".$add_school_name."')");
    echo "<script>alert('School Added');</script>";
    header('Location: school.php');
}
?>

<script>
    $(document).ready(function(){
       
        $(".change_school input").attr("autocomplete",'off');
        
        $(".change_school input").keyup(function(){
            $(".ss_<?php echo $school_id; ?> .ss_name").html($(this).val());
            $(".ss_<?php echo $school_id; ?> a").attr("href","<?php echo "?school=".$school_id."&sname=" ?>"+$(this).val());
        });
        
        $(".change_school").submit(function(){
            $(".change_school button").html('Please Wait...');
            $.ajax({
                type: "POST",
                url: "assets/page/school.php",
                data: $('.change_school').serialize(),
                cache:1,
                success: function(changes){
                    $(".change_school button").html('Change Successful...');
                }
            });
            return false;
        });
        
    });    
</script>