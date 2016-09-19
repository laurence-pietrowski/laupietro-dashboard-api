<?php

/**
* Abstact class representing a Database connection, with calls to SQL databases
* @author Laurence Pietrowski
* @since v0.2
*/
abstract class DatabaseModel {
	
	private $connection;
	private static $instance = null;

	/**
	* DatabaseModel constructor
	* Private function, should return singleton for specific model
	* @param $connection (object) Database connection
	*/
	private function __construct($connection) {
		$this->connection = $connection;
	}

	/**
	* Returns an instance of this database model (usually a DAO)
	* @param $connection (object) Database connection
	* @return Instance of a database connection model
	*/
	public static function getInstance($connection) {
		if (!self::$instance) {
			self::$instance = new DatabaseModel($connection);
		}
		return self::$instance;
	}

	/**
	* Returns the first element found based on model criteria
	* @return Object
	*/
	abstract public function get();

	/**
	* Return all elements matching criteria
	* @return Array (Object[])
	*/
	abstract public function getAll();

	/**
	* Inserts a model into the database
	* @return boolean - TRUE if insert was successful
	*/
	abstract public function insert();

	/**
	* Updates one or more model(s) in the database
	* @return integer - number of rows updated
	*/
	abstract public function update();

	/**
	* Delets one or more model(s) from the database
	* @return integer - number of rows deleted
	*/
	abstract public function delete();


}

?>