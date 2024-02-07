<?php
/** @var string $tipoForm */
/** @var Corretor|null [] $corretores */

use App\Models\Corretor;

?>

<h2 class="mt-5">Lista de Corretores</h2>
<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>CRECI</th>
        <th>CPF</th>
        <th>Editar</th>
        <th>Deletar</th>
    </tr>
    </thead>
    <tbody>
    <!-- Aqui serão exibidos os dados dos corretores -->
    <?php foreach ($corretores as $elemento): ?>
        <tr>
            <td><?php echo $elemento->id; ?></td>
            <td><?php echo $elemento->nome; ?></td>
            <td><?php echo $elemento->creci; ?></td>
            <td><?php echo $elemento->cpf; ?></td>
            <td><a href="<?= "/user/edit/" . $elemento->id ?>"
                   class="btn btn-warning"
                >
                    Editar
                </a>
            </td>
            <td>
                <a href="<?= '/user/delete/' . $elemento->id ?>"
                   class="btn btn-danger"
                >
                    Deletar
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>