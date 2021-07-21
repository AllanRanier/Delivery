<?php echo $this->extend('Admin/layout/principal');  ?>

<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php echo $this->endSection(); ?>


<?php echo $this->section('estilos'); ?>
<!-- Enviando para o template principal os estilos -->
<link rel="stylesheet" href="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.css') ?>" />
<?php echo $this->endSection(); ?>



<?php echo $this->section('conteudo'); ?>


<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo $titulo; ?></h4>

                <div class="ui-widget">
                    <input id="query" name='query' placeholder="Pesquise por um usuário" class="form-control bg-light mb-5"></h4>
                </div>

                <a class="btn btn btn-success float-right" href="<?php echo site_url("admin/usuarios/criar") ?>">
                    <i class="mdi mdi-plus btn-icon-append"></i>
                    Adicionar Usuário
                </a>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>CPF</th>
                                <th>Ativo</th>
                                <th>Situação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario) : ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo site_url("admin/usuarios/show/$usuario->id"); ?>"><?php echo $usuario->nome; ?></a>
                                    </td>
                                    <td><?php echo $usuario->email; ?></td>
                                    <td><?php echo $usuario->cpf; ?></td>
                                    <td><?php echo ($usuario->ativo == 't' && $usuario->deletado_em == null ? '<label class="badge badge-primary">Sim</label>' : '<label class="badge badge-danger">Não</label>'); ?></td>
                                    <td>

                                        <?php echo ($usuario->deletado_em == null ? '<label class="badge badge-primary">Disponivel</label>' : '<label class="badge badge-danger">Excluído</label>'); ?>
                                        <?php if ($usuario->deletado_em != null) : ?>

                                            <a class="badge badge-dark ml-2" href="<?php echo site_url("admin/usuarios/desfazerexclusao/$usuario->id") ?>">
                                                <i class="mdi mdi-undo btn-icon-append"></i>
                                                Desfazer
                                            </a>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php echo $this->endSection(); ?>



<?php echo $this->section('scripts'); ?>
<!-- Enviando para o template principal o scripts -->

<script src="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.js') ?>"></script>

<script>
    $(function() {

        $("#query").autocomplete({

            source: function(request, response) {

                $.ajax({

                    url: "<?php echo site_url('admin/usuarios/procurar'); ?>",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function(data) {

                        if (data.length < 1) {

                            var data = [{
                                label: 'Usuario não encontrado',
                                value: -1
                            }];

                        }
                        response(data); // Aqui temos valor no data

                    },

                }); // fim ajax

            },
            minLenght: 1,
            select: function(event, ui) {

                if (ui.item.value == -1) {

                    $(this).val("");
                    return false;

                } else {

                    window.location.href = '<?php echo site_url('admin/usuarios/show/'); ?>' + ui.item.id;
                }

            }

        }); // fim autocomplete



    });
</script>
<!-- 
<script>
    $(function () {
        $("#query").autocomplete({
            source: function(request, response){
                $.ajax({
                    url: "<?php echo site_url('admin/usuarios/procurar') ?>",
                    dataType: "json",
                    data:{
                        term: request.term
                    },
                    success: function(data){
                        if (data.length < 1) {
                            var data = [{
                                label: "Usuario Não Encontrado",
                                value: -1
                            }];
                        }
                        response(data); // aqui temos valor no data
                    },
                }); // fim ajax
            },

            minLenght: 1,
            select: function(event, ui){
                if (ui.item.value == -1) {
                    $(this).val("");
                    return false;
                }else {
                    window.localtion.href = '<?php echo site_url('admin/usuarios/show/'); ?>' + ui.item.id;
                }
            }
        }); // fim autocomplete
    })


</script> -->

<?php echo $this->endSection(); ?>