<?php

include("vendor/autoload.php");

// use Helpers\HTTP;
// HTTP::redirect("/index.php","redirect=test");

// use Helpers\Auth;
// $user = Auth::check();
// print_r($user);

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Faker\Factory as Faker;

// $mysql = new MySQL;
// $db = $mysql->connect();

// $result = $db->query("SELECT * FROM roles");
// print_r($result->fetchAll());

$faker = Faker::create();
$table = new UsersTable(new MySQL);

echo "Starting... <br>";
for($i = 0; $i < 20; $i++) {
	$table->insert([
		"name" => $faker->name,
		"email" => $faker->email,
		"phone" => $faker->phoneNumber,
		"address" => $faker->address,
		"password" => "password",
	]);
}
echo "Done";