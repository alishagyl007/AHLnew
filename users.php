<?php include 'header.php'; include 'assets/page/func.php'; 
$type = $_GET['u'];
if($type == 'pending')$condition = '0';
if($type == 'activate')$condition = '1';
if($type == 'deactivated')$condition = '2';

if($condition == '')header('Location: index.php');

?>

<div class="asidebar">
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
                        $sql = mysql_query("select * from user where `status` = '".$condition."' order by user_id desc limit $start_from, $num_rec_per_page");
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

<?php include 'footer.php';
if($condition == '2'){
    echo "<style>.deactivate{display:none}</style>";
}elseif($condition == '1'){
    echo "<style>.activate{display:none}</style>";
}elseif($condition == '0'){
    echo "<style>.deactivate,.login_his,.activate{display:none}</style>";
}
?>

<style>
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