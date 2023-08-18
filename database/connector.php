<?php

namespace Database;

use Config\env as envLoader;
use Exception;
use \PDO;

class connector
{
    public $dbHost;
    public $dbName;
    public $dbUser;
    public $dbPassword;
    public $envLoader;
    
    public $mysqlConnection;

    public function __construct()
    {
        $this->envLoader = new envLoader();
        $this->dbHost = $this->envLoader->getEnvDbHost();
        $this->dbName = $this->envLoader->getEnvDbName();
        $this->dbUser = $this->envLoader->getEnvDbUser();
        $this->dbPassword = $this->envLoader->getEnvDbPassword();
        try {
            $this->mysqlConnection = $this->connect();
        } catch (Exception $e) {
            die($e);
        }
    }

    public function connect()
    {
        try {
            // connect to the server and activate PDO error
            if ($this->mysqlConnection  === null) {
                $this->mysqlConnection = new PDO('mysql:dbname=' . $this->dbName . ';host=' . $this->dbHost . '', '' .  $this->dbUser . '', '' .  $this->dbPassword . '');
                $this->mysqlConnection->exec("set names utf8");
                $this->mysqlConnection->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );
            }
            return $this->mysqlConnection;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function formatInputSQL(string $sql, array $data): array
    {
        if (!isset($sql) || empty(trim($sql))) {
            throw new Exception("Please provide a valid SQL.");
        }

        preg_match_all('$:[a-zA-Z0-9_]+$', $sql, $keys);

        $keys = $keys[0];

        $queryData = [];

        foreach ($data as $key => $value) {
            if (in_array(":$key", $keys)) {
                $queryData[$key] = $value;
            }
        }

        return $queryData;
    }
    
    public function getQueryBuilder($sql, array $data = [], $fetch_obj = false)
    {
        try {
            if (!isset($this->mysqlConnection)) {
                throw new Exception("Please connect to server first.");
            }

            $queryData = $this->formatInputSQL($sql, $data);

            $statement = $this->mysqlConnection->prepare($sql);

            $statement->execute($queryData);

            if ($fetch_obj) {
                return $statement->fetchAll(PDO::FETCH_OBJ);
            }
            return $statement->fetchAll();
        } catch (Exception $e) {
            return ['error' => $e->getMessage() . ' when runing ' . $sql];
        }
    }

    public function setQueryBuilder($sql, array $data = [])
    {
        try {
            if (!isset($this->mysqlConnection)) {
                throw new Exception("Please connect to server first.");
            }

            $queryData = $this->formatInputSQL($sql, $data);

            $statement = $this->mysqlConnection->prepare($sql);

            $statement->execute($queryData);
            // $lastId = $statement->fetchColumn();

            return $statement;
        } catch (Exception $e) {
            return ['error' => $e->getMessage() . ' when runing ' . $sql];
        }
    }

    public function lastInsertId()
    {
        return $this->mysqlConnection->lastInsertId();
    }
}
