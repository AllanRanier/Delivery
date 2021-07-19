<div class="form-row">

    <div class="form-group col-md-4">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" value="<?php echo $usuario->nome ?>">
    </div>

    <div class="form-group col-md-2">
        <label for="cpf">CPF</label>
        <input type="text" class="form-control cpf" id="cpf" value="<?php echo $usuario->cpf ?>">
    </div>

    <div class="form-group col-md-3">
        <label for="telefone">Telefone</label>
        <input type="text" class="form-control sp_celphones" id="telefone" value="<?php echo $usuario->telefone ?>">
    </div>

    <div class="form-group col-md-3">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" id="email" value="<?php echo $usuario->email ?>">
    </div>

</div>

<div class="form-row">

    <div class="form-group col-md-3">
        <label for="password">Senha</label>
        <input type="password" class="form-control" id="password">
    </div>

    <div class="form-group col-md-3">
        <label for="confirmation_password">Confirmar Senha</label>
        <input type="password" class="form-control" name="confirmation_password" id="confirmation_password">
    </div>

</div>


<button type="submit" class="btn btn-primary mr-2 btn-sm">
    <i class="mdi mdi-checkbox-marked-circle btn-icon-append"></i>
    Salvar
</button>
<a class="btn text-white btn btn-info btn-sm" href="<?php echo site_url("admin/usuarios/show/$usuario->id") ?>">
    <i class="mdi mdi-arrow-left btn-icon-append"></i>
    Voltar
</a>