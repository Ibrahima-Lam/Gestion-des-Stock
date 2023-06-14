<?php

namespace src;

use PDO;

class Database
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = new PDO("mysql:dbname=gestion;host=localhost", "root");
    }
    public function select(string $req, int|string $type = 2, bool $one = false): mixed
    {
        $state = $this->pdo->query($req);
        if (is_string($type)) $state->setFetchMode(PDO::FETCH_CLASS, $type);
        else $state->setFetchMode($type);
        return $one ? $state->fetch() : $state->fetchAll();
    }

    public function exec(string $req): bool
    {
        return $this->pdo->exec($req);
    }
}
