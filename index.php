<!DOCTYPE html>

<html lang="pt-br">
    <meta charset="UTF-8">

<head>
	<title>Bem Vindo ao sistema</title>
	<link rel="stylesheet" type="text/css" href="css/style-tela-inicial.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/bg1.svg">
		</div>
		<div class="login-content">
			<form action="autenticacao.php?acao=logar" method="post">
				<img src="img/avatar1.svg">
				<h2 class="title">Bem-Vindo</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Digite seu e-mail</h5>
           		   		<input type="email" class="input" name="login">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Digite sua senha</h5>
           		    	<input type="password" class="input" name="senha">
            	   </div>
            	</div>

            	<input type="submit" class="btn" value="Entrar">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>