<?php

namespace App\Models;

use App\Core\Database;
use PDO;
use PDOException;

class Corretor
{
    public int $id;
    public string $nome;
    public string $creci;
    public string $cpf;


    public function findAll()
    {
        try {
            $sql = " SELECT * FROM users order by nome ASC";
            $db = Database::connect()->prepare($sql);

            $db->execute();

            if ($db->rowCount() < 1) {
                return [];
            }

            return $db->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }

    }

    public function store(): bool|string
    {
        try {
            $sql = "INSERT INTO users (nome, creci, cpf) VALUE (?, ?, ?);";

            $db = Database::connect()->prepare($sql);
            $db->bindValue(1, $this->nome);
            $db->bindValue(2, $this->creci);
            $db->bindValue(3, $this->cpf);


            $db->execute();
            $this->id = Database::connect()->lastInsertId();
            return true;
        } catch (PDOException $e) {
            $messageError = $e->getMessage();

            if (!strpos($messageError, "Duplicate entry"))
                return $messageError;

            $pattern = "/for key 'users.(.*?)'/";
            preg_match($pattern, $messageError, $match);
            $keyName = $match[1];

            return "Já existe usuário com esse $keyName cadastrado";
        }


    }

    public function update(): bool|string
    {
        try {
            $db = Database::connect();
            $sql =
                "UPDATE users SET nome=?, creci=?, cpf=? WHERE id = ? ;";

            $db = $db->prepare($sql);

            $db->bindValue(1, $this->nome);
            $db->bindValue(2, $this->creci);
            $db->bindValue(3, $this->cpf);
            $db->bindValue(4, $this->id);


            $db->execute();
            return true;
        } catch (PDOException $exception) {
            $messageError = $exception->getMessage();

            if (!strpos($messageError, "Duplicate entry"))
                return $messageError;

            $pattern = "/for key 'users.(.*?)'/";
            preg_match($pattern, $messageError, $match);
            $keyName = $match[1];

            return "Já existe usuário com esse $keyName cadastrado";

        }
    }

    public function destroy()
    {
        try {
            if (!self::findById())
                return 'user not found';

            $sql = "DELETE FROM users WHERE id= ? ;";

            $db = Database::connect()->prepare($sql);
            $db->bindValue(1, $this->id);
            $db->execute();
            return true;
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
    }

    public function findById()
    {
        try {
            $sql = " SELECT * FROM users where id = ?";

            $db = Database::connect()->prepare($sql);
            $db->bindValue(1, $this->id);
            $db->execute();
            $result = $db->fetchObject(Corretor::class);

            $this->id = $result->id;
            $this->nome = $result->nome;
            $this->creci = $result->creci;
            $this->cpf = $result->cpf;
            return true;

        } catch (PDOException $exception) {
            return $exception->getMessage();
        }

    }

}