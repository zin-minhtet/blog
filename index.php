<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container text-center mt-4" style="max-width: 600px;">
		<h1 class="h3 mb-4">Login</h1>

		<?php if(isset($_GET['incorrect'])): ?>
			<div class="alert alert-warning mb-3">
				Incorrect email or password
			</div>
		<?php endif ?>

		<form action="_actions/login.php" method="post" class="mb-3">
			<input type="email" class="form-control mb-2" name="email" placeholder="Email" required>
			<input type="password" class="form-control mb-2" name="password" placeholder="Password" required>

			<button class="btn btn-primary w-100">Login</button>
		</form>
		<a href="register.php">Register</a>
	</div>
</body>
</html>