<!DOCTYPE html>
<html>
<head>
	<title>Chat - Settings</title>
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/login.css" />
</head>
<body>
	<div class="container">
		<h4>Dados</h4>

		<?php if(!empty($msg)): ?>
			<div class="warning">
				<?php echo $msg; ?>
			</div>
		<?php endif; ?>

		<form method="POST" >

			Nome: <br>
			<input type="text" name="name" value="<?php echo ucfirst($name);?>" readonly="true" class="settings"/>
			<small><a href="<?php BASE_URL;?>settings/updatename">Editar</a></small>
			<br/><br/>

			Email: <br>
			<input type="email" name="email" value="<?php echo ($email);?>" readonly="true" class="settings"/>
			<small><a href="<?php BASE_URL;?>settings/updateemail">Editar</a></small>
			<br/><br/>

			Username:<br/>
			<input type="text" name="username" value="<?php echo ($username);?>" readonly="true" class="settings"/>
			<small><a href="<?php BASE_URL;?>settings/updateusername">Editar</a></small>
			<br/><br/>

			Senha:<br/>
			<input type="password" name="pass" id="pass" value="<?php echo ($pass);?>" readonly="true" maxlength="8" class="settings"/>
			<small><a href="<?php BASE_URL;?>settings/resetpass">Editar</a></small>
			<br/> <br>

			<form action="https://www.w3docs.com/">
         
      </form>
            <a href="<?php BASE_URL;?>report" class="makeButton" target="_blank">Relatório</a>
            <br><br>
            <a href="<?php BASE_URL;?>/">Voltar</a> <br><br>
			<a href="<?php BASE_URL;?>settings/deleteuser">Excluir usuário</a>
		</form>
	</div>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/signup.js"></script>
</body>
</html>