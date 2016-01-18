<?php include_once PATH_SITE . 'includes/header-menu.php'; ?>
<section class="container list">
    <div class="wrapper">
        <h2>Listagem de Clientes</h2>
        <ul class="container list list-head">
            <li><span>Nome</span></li>
            <li><span>Setor</span></li>
            <li><span>Telefone</span></li>
            <li><span>Data de Registro</span></li>
        </ul>
        <ul class="container list">
        <?php
        if ( $this->clients ) {
            foreach( $this->clients as $k => $v ) {  ?>
            <li><span><?php echo $v->client_name; ?></span><a href="?action=edit&id=<?php echo $v->client_id; ?>"> editar </a><a href="?action=delete&id=<?php echo $v->client_id; ?>"> excluir </a></li>
            <li><span><?php echo $v->client_branch; ?></span></li>
            <li><span><?php echo $v->client_phone; ?></span></li>
            <li><span><?php echo date( 'd/m/Y', strtotime( $v->client_register_date ) ); ?></span></li>
        <?php } } ?>
        </ul>
    </div>
</section>
<?php include_once PATH_SITE . 'includes/footer.php'; ?>
