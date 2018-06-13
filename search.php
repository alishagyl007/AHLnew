<?php include 'header.php'; include 'assets/page/func.php'; $search = strtolower($_GET['q']); ?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row searchbar">
            <div class="col-md-12">
                <h3 class="page_title">Search : <span class="text-lowercase"><?php echo $search; ?></span></h3>
            </div>
            <div class="col-md-3">
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">
                            <tr class="head_table">
                                <th>Topic</th>
                            </tr>
                            <?php
                            $school_sql = mysql_query("select * from `topic` where `name` LIKE '%$search%' ");
                            while($ss = mysql_fetch_array($school_sql)){
                                echo "<tr class='ss_".$ss['id']."'>";
                                echo "<td class='ss_name'><a href='edit_topics.php?id=".$ss['topic_id']."'>".$ss['name']."</a></td>";
                                echo "</tr>";
                            }                              
                            ?>
                            <tr class="footer_table">
                                <th><?php echo mysql_num_rows($school_sql); ?> Result Found</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">
                            <tr class="head_table">
                                <th>Post</th>
                            </tr>
                            <?php
                            $school_sql = mysql_query("select * from `post` where `text` LIKE '%$search%' ");
                            while($ss = mysql_fetch_array($school_sql)){
                                echo "<tr class='ss_".$ss['id']."'>";
                                echo "<td class='ss_name'><a href='edit_post.php?id=".$ss['post_id']."'>".$ss['text']."</a></td>";
                                echo "</tr>";
                            }                              
                            ?>
                            <tr class="footer_table">
                                <th><?php echo mysql_num_rows($school_sql); ?> Result Found</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">
                            <tr class="head_table">
                                <th>School Name</th>
                            </tr>
                            <?php
                            $school_sql = mysql_query("select * from `school` where `name` LIKE '%$search%' ");
                            while($ss = mysql_fetch_array($school_sql)){
                                echo "<tr class='ss_".$ss['id']."'>";
                                echo "<td class='ss_name'><a href='school.php?school=".$ss['id']."&sname=".$ss['name']."'>".$ss['name']."</a></td>";
                                echo "</tr>";
                            }
                            ?>
                            <tr class="footer_table">
                                <th><?php echo mysql_num_rows($school_sql); ?> Result Found</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="whitebg">
                    <div class="table-responsive">
                        <table class="table">
                            <tr class="head_table">
                                <th>User Email</th>
                            </tr>
                            <?php
                            $school_sql = mysql_query("select * from `user` where `email` LIKE '%$search%' ");
                            while($ss = mysql_fetch_array($school_sql)){
                                echo "<tr class='ss_".$ss['id']."'>";
                                echo "<td class='ss_name'><a href='edit_user.php?id=".$ss['id']."'>".$ss['email']."</a></td>";
                                echo "</tr>";
                            }                   
                            ?>
                            <tr class="footer_table">
                                <th><?php echo mysql_num_rows($school_sql); ?> Result Found</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
    $(window).bind("load",function(){
        if($(window).width() > 768){
            $("#menuhide").click();
        }
    });    
</script>