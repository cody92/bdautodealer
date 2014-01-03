<?php

class MySqlAdapter
{

    /**
     * conectare la baza de date folosind adaptorul PDO
     *
     * @return \PDO
     */
    public static function connect()
    {
        return new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD, array(
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            )
        );
    }

}
