<?php echo $this->extend('Admin/layout/principal');  ?>

<?php echo $this->section('titulo');?> <?php echo $titulo; ?>  <?php echo $this->endSection(); ?>


<?php echo $this->section('estilos');?>
<!-- Enviando para o template principal os estilos -->
<?php echo $this->endSection(); ?>



<?php echo $this->section('conteudo');?>
<!-- Enviando para o template principal o conteudo -->
<?php echo $titulo; ?>
<?php echo $this->endSection(); ?>



<?php echo $this->section('scpripts');?>
<!-- Enviando para o template principal o scripts -->
<?php echo $this->endSection(); ?>