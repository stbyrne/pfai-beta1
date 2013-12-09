<?php
$username = null;
$password = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	require_once('database.php');
	
	if(!empty($_POST["username"]) && !empty($_POST["password"])) {
		$username = $_POST["username"];
		$password = $_POST["password"];
	
		$query = $connection->prepare("SELECT `user_id` FROM `users` WHERE `user_login` = ? and `user_password` = PASSWORD(?)");
		$query->bind_param("ss", $username, $password);
		$query->execute();
		$query->bind_result($userid);
		$query->fetch();
		$query->close();
		
		if(!empty($userid)) {
			session_start();
			$session_key = session_id();
			
			$query = $connection->prepare("INSERT INTO `sessions` ( `user_id`, `session_key`, `session_address`, `session_useragent`, `session_expires`) VALUES ( ?, ?, ?, ?, DATE_ADD(NOW(),INTERVAL 1 HOUR) );");
			$query->bind_param("isss", $userid, $session_key, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'] );
			$query->execute();
			$query->close();
			
			
            header('Location: index.php');
		}
		else {
			header('Location: login.php');
		}
		
	} else {
		header('Location: login.php');
	}
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>PFAI Tansfer List Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/form.css"/>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <!--<link href="css/bootstrap-responsive.css" rel="stylesheet">-->
	
</head>
<body>
<div id="page">
	<!-- [banner] -->
	<header id="banner">
		<hgroup>
			<h1>PFAI Tansfer List Login</h1>
		</hgroup>		
	</header>
	<!-- [content] -->
	<section id="content">
		<form id="login" class="form-horizontal" role="form" method="post">
            
            <div class="form-group">
                <label class="control-label col-lg-2" for="username">Username</label>
                    <div class="col-lg-10">
                        <input id="username" class="form-control" name="username" type="text" placeholder="username" required>
                    </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-lg-2" for="password">Password</label>
                    <div class="col-lg-10">
                        <input id="password" class="form-control" name="password" type="password" placeholder="password" required>
                    </div>
            </div>
            
			<div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-default" value="Login"><span class="glyphicon glyphicon-log-in"></span> Login</button>
                </div>
            </div>
		</form>
	</section>
	<!-- [/content] -->
	
	<footer id="footer">
		
	</footer>
</div>
<!-- [/page] -->
</body>
</html>
<?php } ?>
