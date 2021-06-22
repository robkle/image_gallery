<?php

require "database.php";
require $_SERVER['DOCUMENT_ROOT'] . "/image_gallery/classes/dbs.class.php";

/*
** Creates new database if it does not already exists.
*/

$newDB = new class
{
	public function create($host, $user, $password, $name)
	{
		try
		{
			$pdo = new PDO('mysql:host=' . $host, $user, $password);
			$pdo->exec("CREATE DATABASE IF NOT EXISTS `$name`;");
		}
		catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage();
		}
	}
};

$newDB->create($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);	

/*
** Creates tables in the database if they don't already exist.
*/

$newTable = new class ($DB_DSN, $DB_USER, $DB_PASSWORD) extends Dbs
{
	public function create($sql)
	{
		try
		{
			$stmt = $this->connect();
			$stmt->exec($sql);
		}
		catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage();
		}
	}
};

$table = "images";
$sql = "CREATE TABLE IF NOT EXISTS $table(
		img_id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
		img_file VARCHAR(255) NOT NULL,
		img_desc VARCHAR(255) NOT NULL,
		img_date DATETIME NOT NULL
		)";
$newTable->create($sql);
