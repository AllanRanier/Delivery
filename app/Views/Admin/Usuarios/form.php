<div class="form-row">

    <div class="form-group col-md-4">
        <label for="nome">Nome</label>
        <input type="text" class="border border-secondary form-control form-control" id="nome" name="nome" value="<?php echo  old('nome', esc($usuario->nome)) ?>">
    </div>

    <div class="form-group col-md-2">
        <label for="cpf">CPF</label>
        <input type="text" class="border border-secondary form-control form-control cpf" id="cpf" name="cpf" value="<?php echo old('cpf', esc($usuario->cpf)) ?>">
    </div>

    <div class="form-group col-md-3">
        <label for="telefone">Telefone</label>
        <input type="text" class="border border-secondary form-control form-control sp_celphones" id="telefone" name="telefone" value="<?php echo old('telefone', esc($usuario->telefone)) ?>">
    </div>

    <div class="form-group col-md-3">
        <label for="email">E-mail</label>
        <input type="email" class="border border-secondary form-control" id="email" name="email" value="<?php echo old('email', esc($usuario->email)) ?>">
    </div>

</div>

<div class="form-row">

    <div class="form-group col-md-3">
        <label for="password">Senha</label>
        <input type="password" class="border border-secondary form-control form-control" id="password" name="password">
    </div>

    <div class="form-group col-md-3">
        <label for="confirmation_password">Confirmar Senha</label>
        <input type="password" class="border border-secondary form-control form-control" name="password_confirmation" id="password_confirmation">
    </div>

    <div class="form-group col-md-3">
        <label for="is_admin">Perfil de acesso</label>
        <select name="is_admin" id="is_admin" class="border border-secondary form-control text-dark">
            
        <?php if ($usuario->id) : ?>
            <option value="1" <?php echo ($usuario->is_admin == '1' ? 'selected' : '') ?> <?php echo set_select('is_admin', '1'); ?> >Administrador</option>
            <option value="0" <?php echo ($usuario->is_admin == '0' ? 'selected' : '') ?> <?php echo set_select('is_admin', '0'); ?> >Cliente</option>

        <?php else : ?>
            <option value="1">Administrador</option>
            <option value="0" selected="">Cliente</option>
        <?php endif; ?>
        </select>
    </div>

    <div class="form-group col-md-3">
        <label for="ativo">Ativo</label>
        <select name="ativo" id="ativo" class="border border-secondary form-control text-dark">
            
        <?php if ($usuario->id) : ?>
            <option value="1" <?php echo ($usuario->ativo == '1' ? 'selected' : '') ?> <?php echo set_select('ativo', '1'); ?> >Sim</option>
            <option value="0" <?php echo ($usuario->ativo == '0' ? 'selected' : '') ?> <?php echo set_select('ativo', '0'); ?> >Não</option>

        <?php else : ?>
            <option value="1">Sim</option>
            <option value="0" selected="">Não</option>
        <?php endif; ?>
        </select>
    </div>

</div>


<button type="submit" class="btn btn-primary mr-2 btn-sm">
    <i class="mdi mdi-checkbox-marked-circle btn-icon-append"></i>
    Salvar
</button>
