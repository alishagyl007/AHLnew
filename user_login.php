<?php include 'header.php'; include 'assets/page/func.php'; 
$user = $_GET['user']; 
$date = $_GET['date']; 
function secondsToTime($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    $hour = $dtF->diff($dtT)->format('%a');
    if($hour == '0')return $dtF->diff($dtT)->format('<b>%h</b> hour and <b>%i</b> min');
    else return $dtF->diff($dtT)->format('<b>%a</b> day, <b>%h</b> hour and <b>%i</b> min');
}
?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-4 important">
                <h3 class="page_title"> User Login History</h3>
                <div class="whitebg">
                    <form onsubmit="return false">
                        <div class="form-group">
                            <label>Search</label>
                            <input type="search" class="searchuser form-control">
                        </div>
                        <div class="divdata"></div>
                    </form>
                </div>  
                <?php if($user){ ?>
                <div class="whitebg">                    
                    <form method="get" id="myform">
                        <input type="text" class="hidden" name="user" value="<?php echo $user; ?>">
                        <div class="form-group">
                            <label>Select Date</label>
                            <select name="date" class="form-control">
                                <option value="" class="hidden"> -- Select Date --</option>
                                <?php
                                $sqlbb = mysql_query("select * from login where `email` = '".$user."' group by login_date");
                                while($rrr = mysql_fetch_array($sqlbb)){
                                    echo "<option value='".$rrr['login_date']."'>".date('d/m/Y',strtotime($rrr['login_date']))."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <?php if($user and $date){ ?>
                        <a href="user_login.php?user=<?php echo $user; ?>">View All Records</a>
                        <?php } ?>
                    </form>
                </div>
                <?php } ?>
            </div>
            <?php if($user and $date){ ?>
            <div class="col-md-8">
                <h3 class="page_title"><span class="text-lowercase"><?php echo $user; ?></span></h3>
                <div class="whitebg">
                    <p>Date : <?php echo date('d/m/Y',strtotime($date)); ?></p>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th class="br" colspan="2">Login</th>
                                <th class="br" colspan="2">Logout</th>
                                <th>Total</th>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <th class="br">Time</th>
                                <th>Date</th>
                                <th class="br">Time</th>
                                <th>Time</th>
                            </tr>
                            <?php                                                
                            $sql = mysql_query("select * from login where `email` = '".$user."' and `login_date` = '".$date."' order by id desc");
                            while($rr = mysql_fetch_array($sql)){
                            ?>
                            <tr>
                                <td><?php echo date("d/m/Y", strtotime($rr['login_date'])); ?></td>
                                <td class="br"><?php echo date("h:i:sa", strtotime($rr['login_time'])); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($rr['logout_date'])); ?></td>
                                <td class="br"><?php echo date("h:i:sa", strtotime($rr['logout_time'])); ?></td>
                                <td>
                                <?php
                                $first = date("Y-m-d G:i:s", strtotime($rr['logout_date'].$rr['logout_time']));
                                $second = date("Y-m-d G:i:s", strtotime($rr['login_date'].$rr['login_time']));
                                $time_diff = strtotime($first) - strtotime($second);
                                $minutes = round($time_diff);
                                
                                echo secondsToTime($minutes);
                                                                
                                ?>
                                </td>
                            </tr>
                            <?php } if(mysql_num_rows($sql) == '0'){ ?>
                            <tr>
                                <td colspan="7">No History Found</td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        <?php } elseif($user){ ?>
            <div class="col-md-8">
                <h3 class="page_title"><span class="text-lowercase"><?php echo $user; ?></span></h3>
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th class="br" colspan="2">Login</th>
                                <th class="br" colspan="2">Logout</th>
                                <th>Total</th>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <th class="br">Time</th>
                                <th>Date</th>
                                <th class="br">Time</th>
                                <th>Time</th>
                            </tr>
                            <?php                                                
                            $sql = mysql_query("select * from login where `email` = '".$user."' order by id desc limit $start_from, $num_rec_per_page");
                            while($rr = mysql_fetch_array($sql)){
                            ?>
                            <tr>
                                <td><?php echo date("d/m/Y", strtotime($rr['login_date'])); ?></td>
                                <td class="br"><?php echo date("h:i:sa", strtotime($rr['login_time'])); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($rr['logout_date'])); ?></td>
                                <td class="br"><?php echo date("h:i:sa", strtotime($rr['logout_time'])); ?></td>
                                <td>
                                <?php
                                $first = date("Y-m-d G:i:s", strtotime($rr['logout_date'].$rr['logout_time']));
                                $second = date("Y-m-d G:i:s", strtotime($rr['login_date'].$rr['login_time']));
                                $time_diff = strtotime($first) - strtotime($second);
                                $minutes = round($time_diff);
                                
                                echo secondsToTime($minutes);
                                                                
                                ?>
                                </td>
                            </tr>
                            <?php } if(mysql_num_rows($sql) == '0'){ ?>
                            <tr>
                                <td colspan="7">No History Found</td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <div class="text-center paginasion">
                        <?php                        
                        $total_records = mysql_num_rows(mysql_query("select * from login where `email` = '".$user."'"));
                        $total_pages = ceil($total_records / $num_rec_per_page);
                        for ($i=1; $i<=$total_pages; $i++) { 
                            echo "<a href='?page=".$i."&user=".$user."' class='active$i'>".$i."</a> "; 
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
        <?php } ?>            
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
<script>
    $(".searchuser").keyup(function(){
        $value = $(this).val();
        if($value.trim() == ''){
            $(".divdata").fadeTo(500,0.5);
        }else{
            $(".divdata").fadeTo(500,1);
            $('.divdata').html('Wait...');
            $.ajax({ 
                type: 'GET', 
                url: 'assets/page/user.php', 
                data: { q: $value }, 
                success: function (data) { 
                    $('.divdata').html(data);
                }
            });
        }
    });
    
    $("header a").attr("tabindex","-1");
    
    $("select").change(function(){
        $("#myform").submit();
    });
</script>
<style>
    
    .loader img{
        display: block;
        margin: 10px auto;
        width: 50px;
    }
    .loader{
        text-align: center;
        margin-top: 35px;
    }
    
    .whitebg form{
        margin: 0;
    }
    .whitebg{
        margin-bottom: 25px;
    }
    .divdata a:first-child{
        border: 0;
    }
    .divdata a{
        display: block;
        color: #000;
        border-top: 1px dashed #ccc;
        padding: 5px;
    }
    
    .table *{
        text-align: center;
    }
    .br {
    border-right: 2px solid #ddd !important;
}
</style>