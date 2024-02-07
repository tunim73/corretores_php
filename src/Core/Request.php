<?php

namespace App\Core;

class Request
{

    public static function getBody()
    {

        $dados = [];
        $dados['id'] = $_POST['id'] ?? '';
        $dados['nome'] = $_POST['nome'] ?? '';
        $dados['creci'] = $_POST['creci'] ?? '';
        $dados['cpf'] = $_POST['cpf'] ?? '';

        return $dados;

    }

    public static function getRouteParams(): array
    {
        $route = $_SERVER["REQUEST_URI"] ?? '/';
        $pattern = "/\/(\d+)\/?/";
        preg_match_all($pattern, $route, $param);
        return $param[1];
    }

}