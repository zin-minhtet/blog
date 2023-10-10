<?php

namespace Libs\Database;

class UsersTable
{
	private $db;

	public function __construct(MySQL $mysql)
	{
		$this->db = $mysql->connect();
	}

	public function insert($data) {
		$statement = $this->db->prepare("INSERT INTO users (name, email, phone, address, password, created_at) VALUES (:name, :email, :phone, :address, :password, NOW())");
		$statement->execute($data);

		return $this->db->lastInsertId();
	}

	public function getAll()
	{
		$statement = $this->db->query(
			"SELECT users.*, roles.name AS role
			FROM users LEFT JOIN roles
			ON users.role_id = roles.id"
		);

		return $statement->fetchAll();
	}

	public function findByEmailAndPassword($email, $password) {
		$statement = $this->db->prepare("SELECT * FROM users WHERE email=:email AND  password=:password");
		$statement->execute(['email' => $email, 'password' => $password]);
		$user = $statement->fetch();

		return $user ?? false;
	}

	public function updatePhoto($id, $photo) {
		$statement = $this->db->prepare("UPDATE users SET photo=:photo WHERE id=:id");
		$statement->execute(['id' => $id, 'photo' => $photo]);

		return $statement->rowCount();
	}

	public function delete($id) {
		$statement = $this->db->prepare("DELETE FROM users WHERE id = :id");
		$statement->execute(['id' => $id]);

		return $statement->rowCount();
	}

	public function suspend($id) {
		$statement = $this->db->prepare("UPDATE users SET suspended = 1 WHERE id = :id");
		$statement->execute(['id' => $id]);

		return $statement->rowCount();
	}

	public function unsuspend($id) {
		$statement = $this->db->prepare("UPDATE users SET suspended = 0 WHERE id = :id");
		$statement->execute(['id' => $id]);

		return $statement->rowCount();
	}

	public function changeRole($id, $role_id) {
		$statement = $this->db->prepare("UPDATE users SET role_id = :role_id WHERE id = :id");
		$statement->execute(['id' => $id, 'role_id' => $role_id]);

		return $statement->rowCount();
	}
}