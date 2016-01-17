<?php include_once PATH_SITE . 'includes/header-menu.php'; ?>
<section class="container list">
    <div class="wrapper">
        <h2>Listagem de Serviços</h2>
        <ul class="container list-service list-head">
            <li><span>Serviço</span></li>
            <li><span>Descrição</span></li>
            <li><span>Data de Registro</span></li>
        </ul>
        <ul class="container list-service">
        <?php if ( $this->services ) {
            foreach( $this->services as $k => $v ) { ?>
            <li><span><?php echo $v->service_name; ?></span><a href="?action=edit&id=<?php echo $v->service_id; ?>"> editar </a><a href="?action=delete&id=<?php echo $v->service_id; ?>"> excluir </a></li>
            <li><span><?php echo $v->service_resume; ?></span></li>
            <li><span><?php echo date( 'd-m-Y', strtotime( $v->service_register_date ) ); ?></span></li>
        <?php } } ?>
        </ul>
    </div>
</section>
<?php include_once PATH_SITE . 'includes/footer.php'; ?>
