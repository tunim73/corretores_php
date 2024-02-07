<?php
session_start();

$flashMessage = null;

if (isset($_SESSION['success'])) {
    $successMessage = $_SESSION['success'];
    $flashMessage = '<div class="alert alert-success" role="alert">' . $successMessage . ' </div>';

    unset($_SESSION['success']);
} else if (isset($_SESSION['error'])) {
    $errorMessage = $_SESSION['error']['message'];
    /*    $corretor=$_SESSION['error']['corretor'];*/
    $flashMessage = '<div class="alert alert-danger" role="alert">' . $errorMessage . ' </div>';
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Corretores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body>
<div class="container mt-5">
    <?php
    if (!is_null($flashMessage)) {
        echo $flashMessage;
    }
    ?>
