<?php
class DB {
	private static $factory;

	public static function createInstance($config = null) {
		$settings['dbname'] = 'property';
		$settings['dbhost'] = '127.0.0.1';
		$settings['dbuser'] = 'root';
		$settings['dbpass'] = '';

		try {
			$dsn = 'mysql:dbname=' . $settings['dbname'] . ';host=' . $settings['dbhost'];
			$pdo = new PDO($dsn, $settings['dbuser'], $settings['dbpass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

			self::$factory[$config] = $pdo;

			return self::$factory[$config];
		} catch (PDOException $e) {
			die('Connection failed: ' . $e->getMessage());
		}
	}
}

class DAO {
	private $db;

	private $usernameExist = "SELECT * FROM users WHERE username=?";
	private $usernameInsert = "INSERT INTO users(username, password, email,created_at, role,salt) VALUES (?,?,?,NOW(),?,?)";
	private $propertyGet = "SELECT * FROM property WHERE uploaded=?";
	private $propertyAll = "SELECT * FROM property";

	public function __construct() {
		$this->db = DB::createInstance();
	}

	public function usernameExist($username) {
		$statement = $this->db->prepare($this->usernameExist);
		$statement->bindValue(1, $username);
		$statement->execute();
		$result = $statement->fetch();
		return $result;
	}
	public function propertyGet($uploaded) {
		$statement = $this->db->prepare($this->propertyGet);
		$statement->bindValue(1, $uploaded);
		$statement->execute();
		$result = $statement->fetch();
		return $result;
	}
	public function propertyAll() {
		$statement = $this->db->prepare($this->propertyAll);
		$statement->execute();
		$result = $statement->fetchAll();
		return $result;
	}

	public function usernameInsert($username, $password, $email, $role, $salt) {
		$statement = $this->db->prepare($this->usernameInsert);
		$statement->bindValue(1, $username);
		$statement->bindValue(2, $password);
		$statement->bindValue(3, $email);
		$statement->bindValue(4, $role);
		$statement->bindValue(5, $salt);
		$statement->execute();
	}

}