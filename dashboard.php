<?php include 'header.php'; include 'assets/page/func.php'; ?>

<div class="asidebar">
    <div class="inner_section">
        <div class="row">
            <div class="col-md-6 charts">
                <div class="whitebg">
                    <div id="admin_chart" style="height: 250px; width: 100%"></div>
                </div>
                <div class="whitebg">
                    <div id="topic_chart" style="height: 250px; width: 100%"></div>
                </div>
            </div>
            <div class="col-md-6 charts">                
                <div class="whitebg">
                    <div id="post_chart" style="height: 250px; width: 100%"></div>
                </div>
                <div class="whitebg">
                    <div id="comment_chart" style="height: 250px; width: 100%"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <h3>Users</h3>
                    <div class="row">
                        <div class="col-xs-4">
                            <a href="users.php?u=pending">
                                <i class="material-icons">sentiment_neutral</i>
                                <p><?php num_users('0'); ?></p>
                                <p>Pending Users</p>
                            </a>
                        </div>
                        <div class="col-xs-4">
                            <a href="users.php?u=activate">
                                <i class="material-icons">mood</i>
                                <p><?php num_users('1'); ?></p>
                                <p>Activate Users</p>
                            </a>
                        </div>
                        <div class="col-xs-4">
                            <a href="users.php?u=deactivated">
                                <i class="material-icons">mood_bad</i>
                                <p><?php num_users('2'); ?></p>
                                <p>Deactivated Users</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h3>Admin History</h3>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="whitebg">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Day</th>
                                        </tr>
                                        <?php admin_history(5); ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
            <div class="col-md-6">                
                <div class="card">
                    <h3>Latest Queries</h3>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="whitebg">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Name</th>
                                            <th>Product</th>
                                            <th>Comment</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                        </tr>
                                        <?php latest_post(5); ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <div class="card">
                <h3>Total</h3>
                <div class="row text-center">
                    <div class="col-md-2 col-xs-6">
                        <i class="material-icons">face</i>
                        <p><?php num_of_data('user'); ?></p>
                        <p>Users</p>
                    </div> 
                    <div class="col-md-2 col-xs-6">
                        <i class="material-icons">receipt</i>
                        <p><?php num_of_data('topic'); ?></p>
                        <p>Policies</p>
                    </div> 
                    <div class="col-md-2 col-xs-6">
                        <i class="material-icons">assignment</i>
                        <p><?php num_of_data('post'); ?></p>
                        <p>Properties</p>
                    </div> 
                    <div class="col-md-2 col-xs-6">
                        <i class="material-icons">mode_comment</i>
                        <p><?php num_of_data('reply'); ?></p>
                        <p>Dr. Appiontment</p>
                    </div>  
                    <div class="col-md-2 col-xs-6">
                        <i class="material-icons">thumb_up</i>
                        <p><?php num_of_data('likes'); ?></p>
                        <p>Queries</p>
                    </div>
                    <div class="col-md-2 col-xs-6">
                        <i class="material-icons">school</i>
                        <p><?php num_of_data('school'); ?></p>
                        <p>IPO</p>
                    </div>  
                    <div class="col-md-2 col-xs-6">
                        <i class="material-icons">verified_user</i>
                        <p><?php num_of_data('admin'); ?></p>
                        <p>Admin</p>
                    </div>                
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
<style>
    .row.text-center div:hover {
        color: #494949;
    }
    .row.text-center div {
        transition: all .3s;
        color: #777;
        text-transform: capitalize;
        font-weight: 500;
    }
    @media(min-width:768px){
        .row.text-center .col-md-2{
            width: 14.2855555%;
        }
    }
</style>
<script>
    
$(window).load(function(){
    chartsload();
});
    
$("#searchheader").click(function(){
    chartsload();
});
    
function chartsload() {
	var chart = new CanvasJS.Chart("post_chart", {
		theme: "theme4",
		title:{
			text: "Policies Timeline",
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
                <?php post_chart(); ?>
			]
		}
		]
	});
	chart.render();
    
	var chart1 = new CanvasJS.Chart("comment_chart", {
		theme: "theme4",
		title:{
			text: "Query Timeline",
            fontSize: 17         
		},
        margin:0,
		animationEnabled: true,
        exportEnabled: 1,
        exportFileName: "Queries Timeline",
		data: [              
		{
			type: "area",
			dataPoints: [
                <?php comment_chart(); ?>
			]
		}
		]
	});
	chart1.render();
    
	var chart2 = new CanvasJS.Chart("topic_chart", {
		theme: "theme4",
		title:{
			text: "Property Timeline",
            fontSize: 17    
		},
        margin:0,
		animationEnabled: true,
        exportEnabled: 1,
        exportFileName: "Property Timeline",
		data: [              
		{
			type: "area",
			dataPoints: [
                <?php topic_chart(); ?>
			]
		}
		]
	});
	chart2.render();
    
	var chart8 = new CanvasJS.Chart("admin_chart", {
		theme: "theme4",
		title:{
			text: "Admin Login Timeline",
            fontSize: 17
		},
        axis:{
            reversed: 1,
        },
        margin:0,
		animationEnabled: true,
        exportEnabled: 1,
        exportFileName: "Admin Login Timeline",
		data: [              
		{
			type: "area",
			dataPoints: [
                <?php admin_chart(); ?>
			]
		}
		]
	});
	chart8.render();
}
</script>
