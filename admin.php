<?php
	include("vendor/autoload.php");

	use Libs\Database\MySQL;
	use Libs\Database\UsersTable;
	use Helpers\Auth;

	$auth = Auth::check();

	$table = new UsersTable(new MySQL);
	$users = $table->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
	<nav class="navbar navbar-dark bg-dark navbar-expand">
		<div class="container">
			<a href="#" class="navbar-brand">Admin</a>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="profile.php" class="nav-link">
						<strong><?= $auth->name ?></strong>
					</a>
				</li>
				<li class="nav-item">
					<a href="_actions/logout.php" class="nav-link">
						Logout
					</a>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container mt-4">
		<table class="table table-dark table-striped table-bordered">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Role</th>
				<th></th>
			</tr>

			<?php foreach($users as $user) : ?>
				<tr>
					<td><?= $user->id ?></td>
					<td><?= $user->name ?></td>
					<td><?= $user->email ?></td>
					<td><?= $user->phone ?></td>
					<td><?= $user->role ?></td>
					<td>
						<div class="btn-group dropdown">
							<?php if ($auth->role_id === 3) : ?>
								<a href="#" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown">Role</a>
								<div class="dropdown-menu dropdown-menu-dark">
									<a href="_actions/role.php?role=1&id=<?= $user->id ?>" class="dropdown-item">User</a>
									<a href="_actions/role.php?role=2&id=<?= $user->id ?>" class="dropdown-item">Manager</a>
									<a href="_actions/role.php?role=3&id=<?= $user->id ?>" class="dropdown-item">Admin</a>
								</div>
							<?php endif ?>

							<?php if ($auth->role_id >= 2) : ?>
								<?php if ($user->suspended) : ?>
								<a href="_actions/unsuspend.php?id=<?= $user->id ?>" class="btn btn-warning btn-sm">Ban</a>
								<?php else : ?>
									<a href="_actions/suspend.php?id=<?= $user->id ?>" class="btn btn-outline-warning btn-sm">Ban</a>
								<?php endif ?>
							<?php endif ?>

							<?php if ($auth->role_id === 3) : ?>
								<a href="_actions/delete.php?id=<?= $user->id ?>" class="btn btn-outline-danger btn-sm">DELETE</a>
							<?php endif ?>
						</div>
					</td>
				</tr>
			<?php endforeach ?>
		</table>
	</div>
</body>
</html>