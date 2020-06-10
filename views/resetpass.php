<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/login.css" />

<body>
	<div class="container editContainer">
		<form method="POST">
			<h2>Digite a nova senha:</h2>
			<br />
			<input type="password" name="password" autofocus placeholder="Digite a nova senha" />
			<br /> <br>
			<input type="submit" value="Mudar senha" />
			<br><br>
			<a href="<?php BASE_URL; ?>/settings">Voltar</a>
		</form>