<!DOCTYPE html>
<html>
<head>
	<title>Chat - Cadastrar</title>
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/login.css" />
</head>
<body>
	<div class="container">
		<h4>Cadastro</h4>

		<?php if(!empty($msg)): ?>
			<div class="warning">
				<?php echo $msg; ?>
			</div>
		<?php endif; ?>

		<form method="POST">

			Nome: <br>
			<input type="text" name="name" /><br/><br/>

			Email: <br>
			<input type="email" name="email" /><br/><br/>

			Username:<br/>
			<input type="text" name="username" /><br/><br/>

			Senha:<br/>
			<input type="password" name="pass" id="pass"/>
			<div id="security"></div>
			<br/>
            <input type="submit" id="submit" value="Cadastrar" />
            <br><br>
            <a href="<?php BASE_URL;?>/login">Voltar</a>
		</form>
	</div>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/signup.js"></script>
</body>
</html>