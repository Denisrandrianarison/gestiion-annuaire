<?php

namespace Config;
/*
    |--------------------------------------------------------------------------
    | DATABASE CONFIG
    |--------------------------------------------------------------------------
    |
    | By default, database .env will be configured in this file config.
    |
*/

class env
{
    private $dbHost;
    private $dbUser;
    private $dbPassword;
    private $dbName;

    /*
    * Env server test
    */
    const HOST = "localhost";
    const DATABASE = "dbtestdevphpdeniss192709com";
    const USERNAME = "testdes192709com";
    const PASSWORD = "A68xq5";

    /*
    * Env local
    */
    // const HOST = "localhost";
    // const DATABASE = "annuaire";
    // const USERNAME = "root";
    // const PASSWORD = "root";

    function __construct()
    {
        $this->dbHost = self::HOST;
        $this->dbUser = self::USERNAME;
        $this->dbPassword = self::PASSWORD;
        $this->dbName = self::DATABASE;
    }

    public function getEnvDbHost()
    {
        return $this->dbHost;
    }

    public function getEnvDbUser()
    {
        return $this->dbUser;
    }

    public function getEnvDbPassword()
    {
        return $this->dbPassword;
    }

    public function getEnvDbName()
    {
        return $this->dbName;
    }
}
