<?php include_once PATH_SITE .  'includes/header-menu.php'; ?>
<section class="container list">
    <div class="wrapper">
        <h2>Listagem de Trabalhos</h2>
        <ul class="container list list-head">
            <li><span>Empresa / Serviço</span></li>
            <li><span>Data Inicial</span></li>
            <li><span>Data Final</span></li>
            <li><span>Dias Restantes</span></li>
        </ul>
        <?php if ( !empty( $this->orders ) ) {
            $client = 0;
            foreach( $this->orders as $k => $v ) {
                if ( $v->client_id != $client ) {
                    $client = $v->client_id;
                    printf( '<span class="company-name"><strong>%s</strong></span>', $v->client_name );
                }
        ?>
        <ul class="container list">
            <li><span><?php echo $v->service_name; ?></span><a href="?action=edit&id=<?php echo $v->order_id; ?>"> editar </a><a class="btn-delete" href="?id=<?php echo $v->order_id; ?>"> excluir </a></li>
            <li><span><?php echo date( 'd-m-Y' , strtotime( $v->order_start ) ); ?></span></li>
            <li><span><?php echo date( 'd-m-Y' , strtotime( $v->order_end ) ); ?></span></li>
            <li><span><?php echo $v->rest_days; ?></span></li>
        </ul>
        <?php } } else { ?>
            <span>Nenhum trabalho cadastrado!</span>
        <?php } ?>
    </div>
</section>
<?php include_once PATH_SITE . 'includes/footer.php'; ?>
