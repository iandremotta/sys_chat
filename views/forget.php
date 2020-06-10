<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/login.css" />

<body>
	<div class="container editContainer">
		<form method="POST">
			<h2>Qual o seu e-mail? </h2>

			<input type="email" name=email autofocus required autocomplete="off" placeholder="Digite o seu e-mail" /> <br>
			<br>
			<input type="submit" value="Enviar">
			<br><br>
			<a href="<?php BASE_URL; ?>/">Voltar</a>
		</form>