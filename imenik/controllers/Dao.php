<?php
class DB {
	private static $factory;

	public static function createInstance($config = null) {
		$settings['dbname'] = 'addressdb';
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

	private $indexShow = "SELECT * FROM addressdb WHERE id=?";
	private $indexCreate = "INSERT INTO addressdb(name, surname, address) VALUES (?,?,?)";
	private $indexUpdate = "UPDATE addressdb SET name = ?, surname = ?, address = ? WHERE id = ?";
	private $indexDestroy = "DELETE FROM addressdb WHERE id=?";
	private $indexFind = "SELECT * FROM addressdb WHERE name LIKE CONCAT('%', ?, '%') OR surname LIKE CONCAT('%', ?, '%') OR address LIKE CONCAT('%', ?, '%')";
	private $propertyAll = "SELECT * FROM addressdb";

	public function __construct() {
		$this->db = DB::createInstance();
	}

	public function indexShow($id) {
		$statement = $this->db->prepare($this->indexShow);
		$statement->bindValue(1, $id);
		$statement->execute();
		$results = $statement->fetchAll();
		return $results;
	}
	public function indexCreate($name, $surname, $address) {
		$statement = $this->db->prepare($this->indexCreate);
		$statement->bindValue(1, $name);
		$statement->bindValue(2, $surname);
		$statement->bindValue(3, $address);
		$statement->execute();
	}
public function indexUpdate($name, $surname, $address, $id) {
		$statement = $this->db->prepare($this->indexUpdate);
		$statement->bindValue(1, $name);
		$statement->bindValue(2, $surname);
		$statement->bindValue(3, $address);
		$statement->bindValue(4, $id);
		$statement->execute();
	}

	public function indexDestroy($id) {
		$statement = $this->db->prepare($this->indexDestroy);
		$statement->bindValue(1, $id);
		$statement->execute();
	}
	public function indexFind($search) {
		$statement = $this->db->prepare($this->indexFind);
		$statement->bindValue(1, $search);
		$statement->bindValue(2, $search);
		$statement->bindValue(3, $search);
		$statement->execute();
		$results = $statement->fetchAll();
		return $results;
	}
	public function propertyAll() {
		$statement = $this->db->prepare($this->propertyAll);
		$statement->execute();
		$result = $statement->fetchAll();
		return $result;
	}



}