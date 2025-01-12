<?php
session_start();
if ($_SERVER['SERVER_PORT'] != '6969' && $_SERVER['HTTP_HOST'] == 'mongtutien.com') {
    header('location: /');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    <title>Login - Admin Panel</title>

    <link rel="icon" type="image/ico" href="favicon.ico"/>

    <link href="css/stylesheets.css" rel="stylesheet" type="text/css" />
    <link rel='stylesheet' type='text/css' href='css/fullcalendar.print.css' media='print' />

    <script type='text/javascript' src='../../../ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js'></script>
    <script type='text/javascript' src='../../../ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js'></script>
    <script type='text/javascript' src='js/plugins/jquery/jquery.mousewheel.min.js'></script>

    <script type='text/javascript' src='js/plugins/cookie/jquery.cookies.2.2.0.min.js'></script>

    <script type='text/javascript' src='js/plugins/bootstrap.min.js'></script>

    <script type='text/javascript' src='js/plugins/charts/excanvas.min.js'></script>
    <script type='text/javascript' src='js/plugins/charts/jquery.flot.js'></script>
    <script type='text/javascript' src='js/plugins/charts/jquery.flot.stack.js'></script>
    <script type='text/javascript' src='js/plugins/charts/jquery.flot.pie.js'></script>
    <script type='text/javascript' src='js/plugins/charts/jquery.flot.resize.js'></script>

    <script type='text/javascript' src='js/plugins/sparklines/jquery.sparkline.min.js'></script>

    <script type='text/javascript' src='js/plugins/fullcalendar/fullcalendar.min.js'></script>

    <script type='text/javascript' src='js/plugins/select2/select2.min.js'></script>

    <script type='text/javascript' src='js/plugins/uniform/uniform.js'></script>

    <script type='text/javascript' src='js/plugins/maskedinput/jquery.maskedinput-1.3.min.js'></script>

    <script type='text/javascript' src='js/plugins/validation/languages/jquery.validationEngine-en.js' charset='utf-8'></script>
    <script type='text/javascript' src='js/plugins/validation/jquery.validationEngine.js' charset='utf-8'></script>

    <script type='text/javascript' src='js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'></script>
    <script type='text/javascript' src='js/plugins/animatedprogressbar/animated_progressbar.js'></script>

    <script type='text/javascript' src='js/plugins/qtip/jquery.qtip-1.0.0-rc3.min.js'></script>

    <script type='text/javascript' src='js/plugins/cleditor/jquery.cleditor.js'></script>

    <script type='text/javascript' src='js/plugins/dataTables/jquery.dataTables.min.js'></script>

    <script type='text/javascript' src='js/plugins/fancybox/jquery.fancybox.pack.js'></script>

    <script type='text/javascript' src='js/cookies.js'></script>
    <script type='text/javascript' src='js/actions.js'></script>
    <script type='text/javascript' src='js/charts.js'></script>
    <script type='text/javascript' src='js/plugins.js'></script>

</head>
<body>

<div class="loginBox">
    <div class="loginHead">
        <img src="img/logo.png" alt="Phong Vân HayGame - Admin Panel" title="Phong Vân HayGame - Admin Panel"/>
    </div>
    <form class="form-horizontal" action="/admin/manage/admin_login.php" method="POST">
        <?php if ($_SESSION['admin_message']): ?>
            <div class="control-group">
                <div class="alert alert-error"><?php echo $_SESSION['admin_message'] ?></div>
                <?php unset($_SESSION['admin_message']) ?>
            </div>
        <?php endif; ?>
        <div class="control-group">
            <label for="inputEmail">Username</label>
            <input type="text" id="inputEmail" name="username"/>
        </div>
        <div class="control-group">
            <label for="inputPassword">Password</label>
            <input type="password" id="inputPassword" name="password"/>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-block">Sign in</button>
        </div>
    </form>
</div>
</body>
</html>
