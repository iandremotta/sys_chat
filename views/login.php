<!DOCTYPE html>
<html>

<head>
	<title>Chat - Login</title>
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/login.css" />
</head>

<body>
	<div class="container">
		<h2>Login</h2>

		<?php if (!empty($msg)) : ?>
			<div class="warning">
				<?php echo $msg; ?>
			</div>
		<?php endif; ?>

		<form method="POST" action="<?php echo BASE_URL; ?>login/signin">
			Usuário:<br />
			<input type="text" name="username" autofocus /><br /><br />

			Senha:<br />
			<input type="password" name="pass" /><br /><br />

			<input type="submit" value="Entrar" />
		</form>
		<br />
		<a href="<?php echo BASE_URL; ?>login/signup">Cadastre-se</a> | <a href="<?php echo BASE_URL; ?>login/forget">Recuperar senha</a>
	</div>
</body>

</html>