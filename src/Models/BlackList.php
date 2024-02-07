<?php

namespace App\Models;

use App\Core\Database;
use PDOException;

class BlackList
{
    public int $id;
    public string $nome;

    public function findByNome()
    {
        try {
            $sql = " SELECT * FROM blacklist where nome = ?";

            $db = Database::connect()->prepare($sql);
            $db->bindValue(1, $this->nome);
            $db->execute();

            return $db->fetchObject(BlackList::class);
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }

    }
}