<?php

require dirname(__FILE__).DIRECTORY_SEPARATOR.'config.php';

/**
* Database connection - facilitates connections to a multitude of databases
* @author Laurence Pietrowski
*/
class DatabaseHook {

	private static $host = null;
	private static $username = null;
	private static $password = null;
	private static $database = null;
	private static $autocommit = null;

	private $connection = null;

	private static $instance = null;

	private static $autocommitMessage = 'Autocommit is enabled for this connection - disable autocommit before beginning a transaction';

	private function __construct() {
		if (self::$host == null || self::$username == null || self::$password == null || self::$database == null) {
			throw new Exception('Database configuration incomplete. Unable to start DB connection');
		}
		$this->connect();
	}

	public static function getInstance() {
		if (self::$instance == null) {
			self::$instance = new DatabaseHook();
		}
		return self::$instance;
	}

	public static function configure($configFile) {
		if (!is_file($configFile)) {
			throw new Exception('Invalid database config file.');
		}
		$fileParts = pathinfo($configFile);
		try {
			switch($fileParts['extension']) {
				case 'ini':
					$parser = new ParserIni($configFile);
					break;
				case 'xml':
					$parser = new ParserXml($configFile);
					break;
				case 'json':
					$parser = new ParserJson($configFile);
					break;
				default:
					throw new Exception('Invalid database configuration file type.');
					break;
			}
		}
		catch (Exception $e) {
			throw $e;
		}
		self::configureWithValues($parser->getHost(), 
			$parser->getUsername(), 
			$parser->getPassword(), 
			$parser->getDatabase(),
			$parser->isAutocommit());
	} 

	public static function configureWithValues($host, $username, $password, $database, $autocommit = true) {
		self::$host = $host;
		self::$username = $username;
		self::$password = $password;
		self::$database = $database;
		self::$autocommit = $autocommit;
	}

	public function connect() {
		if ($this->connection == null) {
			$dsn = 'mysql:host='.self::$host.';dbname='.self::$database;
			try {
				$this->connection = new PDO($dsn, self::$username, self::$password);
			}
			catch (PDOException $pdoEx) {
				throw new Exception('Error connecting to database ('.$pdoEx->getCode().'): '.
					$pdoEx->getMessage());
			}
		}
	}

	public function beginTransaction() {
		if (!self::$autocommit) {
			try {
				$this->connection->beginTransaction();
			}
			catch (PDOException $pdoEx) {
				throw new Exception('Error starting transaction ('.$pdoEx->getCode().'): '.$pdoEx->getMessage());
			}
		}
		else {
			throw new Exception(self::$autocommitMessage);
		}
	}

	public function commit() {
		if (!self::$autocommit) {
			$this->connection->commit();
		}
		else {
			throw new Exception(self::$autocommitMessage);
		}
	}

	public function rollback() {
		if (!self::$autocommit) {
			$this->connection->rollBack();
		}
		else {
			throw new Exception(self::$autocommitMessage);
		}
	}

	public function execute($statement, $values = [], $autoTransaction = true) {
		// Validation
		if (gettype($statement) !== 'string') {
			throw new Exception('Invalid type for statement');
		}
		if ($values && !is_array($values)) {
			throw new Exception('Invalid type for statement values');
		}

		// Starts transaction, if needed
		if ($autoTransaction && !self::$autocommit) {
			$this->beginTransaction();
		}

		// Prepare and execute statement
		try {
			$query = $this->connection->prepare($statement);
			$query->execute($values);
			if (strpos(trim($statement), 'SELECT') === 0) {
				$ret = $query->fetchAll();
			}
			else {
				$ret = true;
			}
			if ($autoTransaction && !self::$autocommit) {
				$this->commit();
			}
			return $ret;
		} 
		catch (PDOException $pdoEx) {
			if ($autoTransaction && !self::$autocommit) {
				$this->rollback();
			}
			$errorMsg = 'Unable to execute statement ['.$statement.']';
			if ($values) {
				$errorMsg .= ' with values [';
				foreach($values as $key => $value) {
					$errorMsg .= '('.$key.') => '.$value.' ';
				}
				$errorMsg .= ']';
			}
			$errorMsg .= ' ('.$pdoEx->getCode().'): '.$pdoEx->getMessage();
			throw new Exception($errorMsg);
		}
	}

}

?>