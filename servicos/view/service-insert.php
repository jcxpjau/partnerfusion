<?php include_once PATH_SITE . 'includes/header-menu.php';
if ( isset( $_GET[ 'id' ] ) && $_GET[ 'id' ]  ) {
    $action = URL_SITE . 'servicos/?action=edit&id=' . $_GET['id'];
    $text = 'Edição';
} else {
    $action = URL_SITE . 'servicos/?action=insert';
    $text = 'Cadastro';
}?>
<section class="container form">
    <div class="wrapper">
        <div class="register">
            <h3><?php echo $text; ?> de Serviços</h3>
            <h3><a href="<?php echo URL_SITE; ?>servicos">Voltar</a></h3>
            <form action="<?php echo $action; ?>" method="POST">
                <fieldset>
                    <ul>
                        <li>
                            <label for="serv-name">Serviço</label>
                            <input id="serv-name" type="text" name="_name" value="<?php echo $this->v[ '_name' ]; ?>"/>
                        </li>
                        <li>
                            <label for="serv-resume">Descrição</label>
                            <input id="serv-resume" type="text" name="_resume" value="<?php echo $this->v[ '_resume' ]; ?>"/>
                        </li>
                        <li>
                            <input type="hidden" name="service-form" value="1" />
                            <input class="button" type="submit" value="Gravar" />
                            <span><?php echo ( $this->error ) ? $this->error : $this->msg; ?></span>
                        </li>
                    </ul>
                </fieldset>
            </form>
        </div>
    </div>
</section>
<?php include_once PATH_SITE . 'includes/footer.php'; ?>
