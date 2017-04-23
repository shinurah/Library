<?php
ob_start();
	include_once 'config.php';
?>

<?php
$msg = '';

$username = $_POST['username'];
	
$result = $conn->query("SELECT * FROM users WHERE username='$username'");	
$user = $result->fetch_object();

session_start();
$username = $conn->real_escape_string($user->username);
$password = $conn->real_escape_string($user->password);

 if(isset($_POST['login_btn']) && !empty($_POST['username']) && !empty($_POST['password'])) {
 	if($_POST['username'] == $username && md5($_POST['password'] == $password)) {
        $_SESSION['username'] = $username;
		$_SESSION['fhjd'] = "ja";
        header("location: http://lisa.bendiksens.net");
	} else {
    	$msg = 'Wrong username or password';
    }
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>The Library</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
	</head>
	<body>
		<div id="login">
			<div id="login_header">
				<img src="/library/images/logo_theLibrary.png" />	
			</div>
			<div id="loginForm">
				<form method='post' action="">
					<table>
						<tr>
							<h2>Log in</h2>
						</tr>
						<tr>
							<td><label>Username:</label></td>
							<td><input id="loginInput" class='input' type='text' name='username' size='25' required autofocus/></td>
						</tr>
						<tr>
							<td><label>Password:</label></td>
							<td><input id="loginInput" class='input' type='password' name='password' size='25' required/></td>
						</tr>
						<tr>
							<h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
						</tr>
					</table>
					<input class="btn" id='loginbtn' name="login_btn" type='submit' value='' />
				</form>
			</div>
		</div>
	</body>
</html>
<?php
	//include '../movie_library/footer.php';
?>
