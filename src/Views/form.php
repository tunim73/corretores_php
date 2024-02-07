<?php
/** @var string $tipoForm */
/** @var Corretor|null $corretor */
/** @var Corretor|null $corretorError */

use App\Models\Corretor;

if (isset($_SESSION['adicionandoCorretor'])) {
    $corretorError = $_SESSION['adicionandoCorretor']['corretor'];
    unset($_SESSION['adicionandoCorretor']);
}

$valuesForm = $corretor ?? $corretorError ?? null;

?>
<h1><?= $corretorError->nome ?></h1>
<h1>Cadastro de Corretores</h1>
<form action="<?= ($tipoForm === 'Salvar') ? '/user/update' : '/user' ?>     " method="POST">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome"
               placeholder=""
               minlength="2"
               maxlength="20" required
               value="<?= $valuesForm->nome ?> ">
    </div>
    <div class="mb-3">
        <label for="creci" class="form-label">CRECI:</label>
        <input type="text" class="form-control" id="creci" name="creci"
               minlength="2" maxlength="8" required value="<?= $valuesForm->creci ?>">
    </div>
    <div class="mb-3">
        <label for="cpf" class="form-label">CPF:</label>
        <input type="text" pattern="[0-9]{11}" class="form-control" id="cpf" name="cpf"
               placeholder="12345678901"
               value="<?= $valuesForm->cpf ?>" minlength="11" maxlength="11" required>
    </div>
    <input type="number" name="id" hidden="true" value="<?= $corretor->id ?>">
    <button
            type="submit"
            class="btn btn-primary"
    ><?= $tipoForm ?></button>
</form>