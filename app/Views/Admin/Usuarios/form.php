<div class="form-row">

    <div class="form-group col-md-4">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo  old('nome', esc($usuario->nome)) ?>">
    </div>

    <div class="form-group col-md-2">
        <label for="cpf">CPF</label>
        <input type="text" class="form-control cpf" id="cpf" name="cpf" value="<?php echo old('cpf', esc($usuario->cpf)) ?>">
    </div>

    <div class="form-group col-md-3">
        <label for="telefone">Telefone</label>
        <input type="text" class="form-control sp_celphones" id="telefone" name="telefone" value="<?php echo old('telefone', esc($usuario->telefone)) ?>">
    </div>

    <div class="form-group col-md-3">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo old('email', esc($usuario->email)) ?>">
    </div>

</div>

<div class="form-row">

    <div class="form-group col-md-3">
        <label for="password">Senha</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <div class="form-group col-md-3">
        <label for="confirmation_password">Confirmar Senha</label>
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
    </div>

    <!-- <div class="form-group col-md-3">
        <label for="is_admin">Perfil de acesso</label>
        <select name="is_admin" id="is_admin" class="form-control">
            
        <?php if ($usuario->id) : ?>
            <option value="1" <?php echo ($usuario->is_admin == 't' ? 'selected' : '') ?> <?php echo set_select('is_admin', '1'); ?> >Administrador</option>
            <option value="0" <?php echo ($usuario->is_admin == 'f' ? 'selected' : '') ?> <?php echo set_select('is_admin', '0'); ?> >Cliente</option>

        <?php else : ?>
            <option value="1">Sim</option>
            <option value="0" selected="">Não</option>
        <?php endif; ?>
        </select>
    </div>

    <div class="form-group col-md-3">
        <label for="ativo">Ativo</label>
        <select name="ativo" id="ativo" class="form-control">
            
        <?php if ($usuario->id) : ?>
            <option value="1" <?php echo ($usuario->ativo == 't' ? 'selected' : '') ?> <?php echo set_select('ativo', '1'); ?> >Sim</option>
            <option value="0" <?php echo ($usuario->ativo == 'f' ? 'selected' : '') ?> <?php echo set_select('ativo', '0'); ?> >Não</option>

        <?php else : ?>
            <option value="1">Sim</option>
            <option value="0" selected="">Não</option>
        <?php endif; ?>
        </select>
    </div> -->

</div>

<div class="form-check form-check-flat form-check-primary mb-2">
    <label for="ativo" class="form-check-label">
        <input type="hidden" name="ativo" value="0">
        <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" <?php if (old('is_admin', $usuario->ativo) == 't') : ?> checked="" <?php endif; ?>>
        Ativo
    </label>

</div>

<div class="form-check form-check-flat form-check-primary mb-4">
    <label for="is_admin" class="form-check-label">
        <input type="hidden" name="is_admin" value="0">
        <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" value="1" <?php if (old('is_admin', $usuario->is_admin) == 't') : ?> checked="" <?php endif; ?>>
        Administrador
    </label>

</div>


<button type="submit" class="btn btn-primary mr-2 btn-sm">
    <i class="mdi mdi-checkbox-marked-circle btn-icon-append"></i>
    Salvar
</button>
