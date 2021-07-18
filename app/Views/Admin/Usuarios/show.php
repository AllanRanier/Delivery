<?php echo $this->extend('Admin/layout/principal');  ?>

<?php echo $this->section('titulo');?> <?php echo $titulo; ?>  <?php echo $this->endSection(); ?>


<?php echo $this->section('estilos');?>
<!-- Enviando para o template principal os estilos -->
<?php echo $this->endSection(); ?>



<?php echo $this->section('conteudo');?>

<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-header bg-primary pb-0 pt-4 ">
                <h4 class="card-title text-white"><?php echo esc($titulo); ?></h4>   
            </div>
            <div class="card-body">
                <p class="card-text">
                    <span class="font-weight-bold">Nome:</span>
                    <?php echo esc($usuario->nome) ?>
                </p>
                <p class="card-text">
                    <span class="font-weight-bold">E-mail:</span>
                    <?php echo esc($usuario->email) ?>
                </p>
                <p class="card-text">
                    <span class="font-weight-bold">Ativo:</span>
                    <?php echo esc($usuario->ativo == 't' ? 'Sim': 'Não') ?>
                </p>
                <p class="card-text">
                    <span class="font-weight-bold">Perfil:</span>
                    <?php echo esc($usuario->is_admin == 't' ? 'Administrador': 'Cliente') ?>
                </p>
                <p class="card-text">
                    <span class="font-weight-bold">Criado:</span>
                    <?php echo $usuario->criado_em->humanize() ?>
                </p>
                <p class="card-text">
                    <span class="font-weight-bold">Atualizado:</span>
                    <?php echo $usuario->atualizado_em->humanize() ?>
                </p>

            </div>
            <div class="card-footer bg-primary pb-0 pt-4">
                <a class="card-title text-white btn btn-dark btn-sm mr-2" href="<?php echo site_url("admin/usuarios/editar/$usuario->id") ?>">
                    Editar
                </a>
                <a class="card-title text-white btn btn-danger btn-sm mr-2" href="<?php echo site_url("admin/usuarios/excluir/$usuario->id") ?>">
                    Excluir
                </a>
                <a class="card-title text-white btn btn-info btn-sm" href="<?php echo site_url("admin/usuarios/") ?>">
                    Voltar
                </a>
            </div>
        </div>
    </div>
</div>


<?php echo $this->endSection(); ?>



<?php echo $this->section('scpripts');?>
<!-- Enviando para o template principal o scripts -->
<?php echo $this->endSection(); ?>