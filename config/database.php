<?php

namespace Config;

class Database
{
	public static function createDbInstance($host, $dbName, $username, $password)
	{
		$dsn = sprintf(
			"mysql:host=%s;dbname=%s;charset=utf8",
			$host,
			$dbName
		);

		$options = [
			\PDO::ATTR_ERRMODE 			  => \PDO::ERRMODE_EXCEPTION,
			\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
		];

		try {
			$pdo = new \PDO($dsn, $username, $password, $options);
		} catch(\PDOException $e) {
            fwrite(STDERR, $e->getMessage());
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
            die(1);
		}

		return $pdo;
	}
}