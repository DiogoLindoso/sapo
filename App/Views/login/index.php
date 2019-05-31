<!DOCTYPE html>

<html lang="pt-br">

<head>

	<title>Login SAPO</title>

	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

<!--===============================================================================================-->	

	<link rel="icon" type="image/png" href="http://<?php echo APP_HOST; ?>/public/img/favicon.ico"/>

<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="http://<?php echo APP_HOST; ?>/public/css/bootstrap.min.css">

<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="http://<?php echo APP_HOST; ?>/public/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="http://<?php echo APP_HOST; ?>/public/css/animate.css">

<!--===============================================================================================-->	

	<link rel="stylesheet" type="text/css" href="http://<?php echo APP_HOST; ?>/public/css/hamburgers.min.css">

<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="http://<?php echo APP_HOST; ?>/public/css/select2.min.css">

<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="http://<?php echo APP_HOST; ?>/public/css/util.css">

	<link rel="stylesheet" type="text/css" href="http://<?php echo APP_HOST; ?>/public/css/main.css">

<!--===============================================================================================-->

</head>

<body>

	

	<div class="limiter">

		<div class="container-login100">

			<div class="wrap-login100">

				<div class="login100-pic js-tilt" data-tilt>

					<img src="http://<?php echo APP_HOST; ?>/public/img/frog-157934_640.png" alt="IMG">

				</div>



				<form class="login100-form validate-form" method="POST" action="http://<?php echo APP_HOST; ?>/login/logar">

					<span class="login100-form-title">

						Login Usuário

					</span>



					<div class="wrap-input100 validate-input" data-validate = "Email valido requerido: ex@abc.xyz">

						<input class="input100" type="email" name="email" id="email" placeholder="Email" autocomplete="username">

						<span class="focus-input100"></span>

						<span class="symbol-input100">

							<i class="fa fa-envelope" aria-hidden="true"></i>

						</span>

					</div>



					<div class="wrap-input100 validate-input" data-validate = "Senha requerida">

						<input class="input100" type="password" name="senha" id="senha" placeholder="Senha" autocomplete="current-password">

						<span class="focus-input100"></span>

						<span class="symbol-input100">

							<i class="fa fa-lock" aria-hidden="true"></i>

						</span>

					</div>

					

					<div class="container-login100-form-btn">

						<button class="login100-form-btn" type="submit">

							Entrar

						</button>

					</div>



					<div class="text-center p-t-12">

						<span class="txt1">

							Esqueceu

						</span>

						<a class="txt2" href="#">

							Usuário / Senha?

						</a>

					</div>



					<div class="text-center p-t-136">

						<a class="txt2" href="#">

							Crie sua conta

							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>

						</a>

					</div>

				</form>

			</div>

		</div>

	</div>

	

	



	

<!--===============================================================================================-->	

	<script src="http://<?php echo APP_HOST; ?>/public/js/core/jquery.3.2.1.min.js"></script>

<!--===============================================================================================-->

	<script src="http://<?php echo APP_HOST; ?>/public/js/core/popper.min.js"></script>

	<script src="http://<?php echo APP_HOST; ?>/public/js/core/bootstrap.min.js"></script>

<!--===============================================================================================-->

	<script src="http://<?php echo APP_HOST; ?>/public/js/select2.min.js"></script>

<!--===============================================================================================-->

	<script src="http://<?php echo APP_HOST; ?>/public/js/tilt.jquery.min.js"></script>

	<script >

		$('.js-tilt').tilt({

			scale: 1.1

		})

	</script>

<!--===============================================================================================-->

	<script src="http://<?php echo APP_HOST; ?>/public/js/main.js"></script>

</body>

</html>