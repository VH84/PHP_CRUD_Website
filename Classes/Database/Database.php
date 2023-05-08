<?php

namespace Classes\Database;

use PDO;

class Database extends PDO
{

    protected $options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];

    public function __construct()
    {
    return parent::__construct("mysql:host=localhost;dbname=uebung", "root", "", $this->options);
    }
}

