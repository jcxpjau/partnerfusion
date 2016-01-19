<?php include_once PATH_SITE . 'includes/header-menu.php';
if ( isset( $_GET[ 'id' ] ) && $_GET[ 'id' ]  ) {
    $action = URL_SITE . 'ordens/?action=edit&id=' . $_GET['id'];
    $text = 'Edição';
} else {
    $action = URL_SITE . 'ordens/?action=insert';
    $text = 'Cadastro';
}
?>
<section class="container form">
    <div class="wrapper">
        <div class="register">
            <h3><?php echo $text; ?> de Trabalhos</h3>
            <h3><a href="<?php echo URL_SITE . 'ordens'; ?>">voltar</a></h3>
            <form action="<?php echo $action; ?>" method="POST">
                <fieldset>
                    <ul>
                        <li>
                            <label for="client">Cliente</label>
                            <select id="client" name="_client_id">
                                <option>Selecione</option>
                            <?php if ( $this->clients ) {
                                    foreach( $this->clients as $k => $c ) {
                                        printf( '<option value=%d %s>%s</option>',
                                            $c->client_id,
                                            ( $this->v[ '_client_id' ] == $c->client_id ) ? 'selected' : '',
                                            $c->client_name
                                        );
                                    }
                            }
                            ?>
                            </select>
                        </li>
                        <li>
                            <label for="service">Serviço</label>
                            <select id="service" name="_service_id">
                                <option>Selecione</option>
                            <?php if ( $this->services ) {
                                foreach( $this->services as $k => $s ) {
                                    printf( '<option value=%d %s>%s</option>',
                                        $s->service_id,
                                        ( $this->v[ '_service_id' ] == $s->service_id ) ? 'selected' : '',
                                        $s->service_name
                                    );
                                }
                            }
                            ?>
                            </select>
                            </select>
                        </li>
                        <li>
                            <label for="dt-start">Data de inicío</label>
                            <input id="dt-start" class="date" type="text" name="_start" value="<?php echo $this->v[ '_start' ]; ?>"/>
                        </li>
                        <li>
                            <label for="dt-end">Data de Término</label>
                            <input id="dt-end" class="date" type="text" name="_end" value="<?php echo $this->v[ '_end' ]; ?>"/>
                        </li>
                        <li>
                            <input type="hidden" name="order-form" value="1" />
                            <input class="button" type="submit" value="Gravar" />
                            <?php echo ( $this->error ) ? $this->error: $this->msg; ?>
                        </li>
                    </ul>
                </fieldset>
            </form>
        </div>
    </div>
</section>
<?php include_once PATH_SITE . 'includes/footer.php'; ?>
