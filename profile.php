<?php
session_start();
$login = isset($_SESSION['user']);

if (!$login) {
	header("location: index.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profile</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
	<div class="container" style="max-width: 800px;">
		<h1 class="h3 my-4">Profile</h1>

		<?php if(isset($_GET['error'])) : ?>
			<div class="alert alert-warning">
				Unable to upload
			</div>
		<?php endif ?>

		<?php if(file_exists("_actions/photos/profile.jpg")) : ?>
			<img src="_actions/photos/profile.jpg" alt="img-thumbnail" width="300">
		<?php endif ?>

		<form action="_actions/upload.php" method="post" enctype="multipart/form-data" class="input-group my-4">
			<input type="file" class="form-control" name="photo">
			<button class="btn btn-secondary">Upload</button>
		</form>

		<ul class="list-group mb-4">
			<li class="list-group-item">Name: Alice</li>
			<li class="list-group-item">Email: alice@gmail.com</li>
			<li class="list-group-item">Phone: 1651685451561</li>
			<li class="list-group-item">Address: Some Address</li>
		</ul>
		<a href="_actions/logout.php">Logout</a>
	</div>
</body>

</html>