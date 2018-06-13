<?php
session_start();
session_destroy();
?>

 <html>
    <head>
        <title>Title</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/custom.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="icon" href="assets/img/favicon.png">
    </head>
    <body class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="form_data">
                        <div class="logo_login">
                            <img src="assets/img/logoahl.png">
                        </div>
                        <form method="post" class="add_login">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            <div id="change"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <script src="assets/js/jquery.js" type="text/javascript"></script>
            <script src="assets/js/bootstrap.js" type="text/javascript"></script>
            <script src="assets/js/custom.js" type="text/javascript"></script>
        </footer>
    </body>
</html> 