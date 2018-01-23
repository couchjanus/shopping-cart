 <?php

 class Connection
 {
 	public static function make()
 	{
 		$db = include CONFIG.'db.php';

 		$config = $db['database'];

		try {
			return new PDO(
				$config['connection'].';dbname='.$config['name'],
				$config['username'],
				$config['password'],
				$config['options']
			);

		} catch (PDOException $e) {
			die($e->getMessage());
		}
 	}
 }
