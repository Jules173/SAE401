<?php

session_start();

$users = [
	[ "username"=>"toto", "password"=>"zuzu", "admin"=>false ],
	[ "username"=>"admin", "password"=>"toor", "admin"=>true ]
];

if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
	header("Location: ./index.php");
	exit();
}

$userMsg = "";
$passwordMsg = "";

if (isset($_POST['login'])) {
	$accountExists = false;
	foreach ($users as $user) {
		if ($user['username'] === $_POST['username'] && $user['password'] === $_POST['password']) {
			$_SESSION['username'] = $user['username'];
			$_SESSION['password'] = $user['password'];
			$_SESSION['isAdmin'] = $user['admin'];
			header("Location: ./index.php");
			exit();
		} else if ($user['username'] === $_POST['username']) {
			$accountExists = true;
		}
	}
	if ($accountExists) {
		$passwordMsg = "<div class='login-failure'>Mot de passe incorrect</div>";
	} else {
		$userMsg = "<div class='login-failure'>Ce compte n'existe pas !</div>";
	}
}

?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Connection</title>
		<link rel="stylesheet" href="./style/all.css" media="all" type="text/css">
	</head>
	<body>
		<div id="body-wrapper">
			<div id="form-container">
				<div id="form-wrapper">
					<form method="POST" id="login-form">
						<div id="form-header">
							<span>
								<h2>Connexion</h2>
							</span>
						</div>
						<div id="username-wrapper">
							<input type="text" id="username" name="username" placeholder="Nom d'utilisateur" autocomplete="username">
						</div>
						<?php echo $userMsg; ?>
						<div id="password-wrapper">
							<input type="password" id="password" name="password" placeholder="Mot de passe" autocomplete="current-password">
						</div>
						<?php echo $passwordMsg; ?>
						<div id="submit-wrapper">
							<input type="submit" id="submit" name="login" value="Se Connecter">
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>