<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Models\BlackList;
use App\Models\Corretor;

class CorretorController
{
    public function index(): void
    {
        $user = new Corretor();
        $corretores = $user->findAll();

        $tipoForm = 'Enviar';

        require_once __DIR__ . "/../Views/index.php";
    }

    public function store(): void
    {
        session_start();
        $body = Request::getBody();

        $blackList = new BlackList();
        $blackList->nome = trim($body['nome']);
        $result = $blackList->findByNome();

        if ($result) {
            $_SESSION['error'] = ['message' => $result->nome . ' está na blacklist e não pode ser adicionado.'];
            header('Location:/users');
            exit;
        }

        $user = new Corretor();

        $user->nome = trim($body['nome']);
        $user->cpf = $body['cpf'];
        $user->creci = $body['creci'];


        $newUser = $user->store();
        if (is_string($newUser)) {
            $_SESSION['error'] = ['message' => $newUser];
            $_SESSION['adicionandoCorretor'] = ['corretor' => $user];
            header('Location:/users');
            exit;
        }

        $_SESSION['success'] = 'Corretor adicionado com sucesso !';
        header('Location:/users');
        exit;
    }

    public function edit(array $params): void
    {
        $id = $params[0][0];
        $corretor = new Corretor();
        $corretor->id = intval($id);
        $result = $corretor->findById();

        if (is_string($result)) {
            Response::json(status: 400, data: [
                'error' => true,
                'message' => $result
            ]);
        }

        $tipoForm = 'Salvar';

        require_once __DIR__ . "/../Views/Edit.php";
    }

    public function update(): void
    {
        session_start();
        $body = Request::getBody();
        $user = new Corretor();

        $user->id = $body['id'];
        $user->nome = trim($body['nome']);
        $user->cpf = $body['cpf'];
        $user->creci = $body['creci'];

        $blackList = new BlackList();
        $blackList->nome = $body['nome'];
        $result = $blackList->findByNome();

        if ($result) {
            $_SESSION['error'] = ['message' => $result->nome . ' está na blacklist e não pode ser adicionado.'];
            header('Location:/user/edit/' . $user->id);
            exit;
        }


        $updatedUser = $user->update();

        if (is_string($updatedUser)) {
            $_SESSION['error'] = ['corretor' => $user, 'message' => $updatedUser];

            header('Location:/user/edit/' . $user->id);
            exit;
        }

        $_SESSION['success'] = 'Corretor atualizado com sucesso !';
        header('Location:/users');
        exit;

    }

    public function destroy(array $params): void
    {
        $id = $params[0][0];

        $user = new Corretor();
        $user->id = intval($id);
        $deletedUser = $user->destroy();

        session_start();
        if (is_string($deletedUser)) {
            $_SESSION['error'] = ['message' => $deletedUser];
            header('Location:/users');
            exit;
        }

        $_SESSION['success'] = 'Corretor deletado com sucesso !';

        header('Location:/users');

    }

}