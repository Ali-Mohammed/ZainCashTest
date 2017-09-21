<?php

namespace App\Database;

use mysqli;

require_once __DIR__ . '/Config.php';

class DatabaseHelper
{

    /**
     * @return mysqli
     */
    public static function connect()
    {
        $connection = new mysqli(
          config::DB_SERVER_HOST,
          config::DB_USERNAME,
          config::DB_PASSWORD,
          config::DB_NAME
        );

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        return $connection;
    }

}