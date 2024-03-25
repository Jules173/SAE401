<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Connection</title>
		<link rel="stylesheet" href="./style/all.css" media="all" type="text/css">
	</head>
	<body>
		<div id="body-wrapper">
			<header id="login-header">
				<img id="logo" src="./images/ulhn.png">
				<hr>
			</header>
			<div id="form-container">
				<div id="form-wrapper">
					<form id="login-form">
						<div id="username-wrapper">
							<label for="username">Nom d'utilisateur</label>
							<input type="text" id="username" name="username" placeholder="Nom d'utilisateur...">
						</div>
						<div id="password-wrapper">
							<label for="password">Mot de passe</label>
							<input type="password" id="password" name="password" placeholder="Mot de passe...">
						</div>
						<input type="submit" id="submit" name="login" value="Se Connecter">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>