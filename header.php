<?php
error_reporting(0);
include 'assets/page/connection.php';
$s_name = $_SESSION['a_name'];
$s_pass = $_SESSION['a_pass'];
$sql = mysql_query("select * from `admin` where `name` = '".$s_name."' and `password` = '".$s_pass."' and `check` = 'checked' order by id asc limit 1");
$result = mysql_num_rows($sql);
if($result == '0'){
    header('Location: login.php');
}
$num_rec_per_page = '10';
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $num_rec_per_page;
?>
<html>
    <head>
        <title>Amit Helpline</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/custom.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="icon" href="assets/img/logoahl.png">
    </head>
    <body>
        <header>
            <div class="hidemenubar_res"></div>
            <span class="hidden" id="mobileswipe_menuhide"></span>
            <div id="closemenu">
                <i class="material-icons">close</i>
            </div>
            <div class="sidebar">
                <div class="sidebar_inner_bar">
                    <div class="logo">
                        <img src="assets/img/logoahl.png">
                    </div>
                    <div class="sidebar_menu">
                        <ul>
                            <li><a href="dashboard.php"><i class="material-icons">home</i> Dashboard</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="material-icons">face</i> Users <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="add_user.php"><i class="material-icons">sentiment_neutral</i> Add User</a></li>
                                    <li><a href="users.php?u=activate"><i class="material-icons">mood</i> All Users</a></li>
                                    
                                   
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="material-icons">receipt</i> Policies <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="policies_lic.php?Add=Add"><i class="material-icons">add</i> Add LIC Policy</a></li>
                                    <li><a href="policies_general.php?Add=Add"><i class="material-icons">add</i> Add General Policy</a></li>
                                    <li><a href="upload_pdf.php"><i class="material-icons">event_note</i> Upload Policy PDF</a></li>
                                    <li><a href="policies_lic.php"><i class="material-icons">book</i> All LIC Policies</a></li>
                                    <li><a href="policies_general.php"><i class="material-icons">book</i> All General Policies</a></li>
                                    <li><a href="search_policies_general.php"><i class="material-icons">book</i> Search General Policies</a></li>
                                     <li><a href="search_policies_lic.php"><i class="material-icons">book</i> Search LIC Policies</a></li>
                                     <li><a href="general_policy_types.php"><i class="material-icons">add</i>General Policy Types</a></li>
                                     <li><a href="search_by_reference.php"><i class="material-icons">book</i> Search By Reference</a></li>
                                     <li><a href="reference.php"><i class="material-icons">add</i>Add References</a></li>
                                    
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="material-icons">assignment</i> Properties<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="property.php?Add=Add"><i class="material-icons">add</i> Add Property</a></li>
                                    <li><a href="property.php"><i class="material-icons">event_note</i> All Properties</a></li>
                                    <li><a href="search_properties.php"><i class="material-icons">book</i> Search Properties</a></li>
                                </ul>
                            </li>
				
				<li class="dropdown">
                                <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="material-icons">receipt</i> Pollution<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="pollution.php?Add=Add"><i class="material-icons">add</i> Add Pollution</a></li>
                                    <li><a href="pollution.php"><i class="material-icons">event_note</i> All Pollution</a></li>
                                 </ul>
                            </li>


                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="material-icons">mode_comment</i> Doctor Appiontment <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="comment.php"><i class="material-icons">insert_comment</i> All Appiontment</a></li>
                                    <li><a href="add_doctor.php"><i class="material-icons">add</i> Add Docotor</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="material-icons">credit_card</i> IPO <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="ipo.php"><i class="material-icons">report_problem</i> All IPO</a></li>
                                    <li><a href="ipo.php?Add=Add"><i class="material-icons">bug_report</i> Add IPO</a></li>
                                   

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="material-icons">credit_card</i> News <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="report.php"><i class="material-icons">report_problem</i> All News</a></li>
                                    <li><a href="post_report.php"><i class="material-icons">bug_report</i> Add News</a></li>
                                    

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="material-icons">credit_card</i> Queries<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="allqueries.php"><i class="material-icons">report_problem</i> All Queries</a></li>
                                    <li><a href="add_query.php"><i class="material-icons">bug_report</i> Add Query</a></li>
                                    <li><a href="search_query.php"><i class="material-icons">bug_report</i>Search Queries</a></li>
                                    

                                </ul>
                            </li>
                            <li class="hr"><a href="save_vote.php"><i class="material-icons">compare_arrows</i>Voting</a></li>
                           
                            <li class="hidden"><a href="#"><i class="material-icons">mail_outline</i> Messages</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="material-icons">face</i> Employee <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="add_user.php"><i class="material-icons">sentiment_neutral</i> Add Employee</a></li>
                                    <li><a href="users.php?u=activate"><i class="material-icons">mood</i> All Employee</a></li>
                                    <li><a href="task.php"><i class="material-icons">book</i>Tasks</a></li>
                                    <li><a href="task.php?Add=Add"><i class="material-icons">add</i>Add Task</a></li>
                                   
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="material-icons">settings</i> Setting <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="admin_history.php"><i class="material-icons">account_box</i> Admin History</a></li>
                                    <li><a href="change_password.php"><i class="material-icons">compare_arrows</i> Change Password</a></li>
                                    <li><a href="logout.php"><i class="material-icons">exit_to_app</i> Logout</a></li>
                                </ul>
                            </li>
                            <li class="hr"><a href="fcm_index.php"><i class="material-icons">file_upload</i> Send Notification</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="topbar">
                <div class="sidebar_inner">
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <a id="menuhide" data-placement="right" data-toggle="tooltip" title="Menu !">
                                <i class="material-icons">keyboard_arrow_left</i>
                            </a>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="#" id="searchheader" data-placement="left" data-toggle="tooltip" title="Search !">
                                <i class="material-icons">search</i>
                            </a>
                            <a href="logout.php" data-placement="left" data-toggle="tooltip" title="Logout !">
                                <i class="material-icons">exit_to_app</i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tag_search">
                <form method="get" action="search.php">
                    <input type="text" name="q" autocomplete="off" placeholder="Enter Here...">
                    <button type="submit"><i class="material-icons">search</i></button>
                </form>
            </div>
        </header>
        
         