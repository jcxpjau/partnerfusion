<?php include_once PATH_SITE . 'includes/header-menu.php';
if ( isset( $_GET[ 'id' ] ) && $_GET[ 'id' ]  ) {
    $action = URL_SITE . 'clientes/?action=edit&id=' . $_GET['id'];
    $text = 'Edição';
} else {
    $action = URL_SITE . 'clientes/?action=insert';
    $text = 'Cadastro';
}
?>
<section class="container form">
    <div class="wrapper">
        <div class="register">
            <h3><?php echo $text; ?> de Cliente</h3>
            <h3><a href="<?php echo URL_SITE; ?>clientes">Voltar</a></h3>
            <form action="<?php echo $action; ?>" method="POST">
                <fieldset>
                    <ul>
                        <li>
                            <label for="cli-name">Nome</label>
                            <input id="cli-name" type="text" name="_name" value="<?php echo $this->v[ '_name' ]; ?>"/>
                        </li>
                        <li>
                            <label for="cli-branch">Setor</label>
                            <input id="cli-branch" type="text" name="_branch" value="<?php echo $this->v[ '_branch' ]; ?>"/>
                        </li>
                        <li>
                            <label for="cli-phone">Telefone</label>
                            <input id="cli-phone" class="phone-number" type="text" name="_phone" value="<?php echo $this->v[ '_phone' ]; ?>"/>
                        </li>
                        <li>
                            <input type="hidden" name="client-form" value="1" />
                            <input class="button" type="submit" value="Gravar" />
                            <span><?php echo $this->error; ?></span>
                        </li>
                    </ul>
                </fieldset>
            </form>
        </div>
    </div>
</section>
<?php include_once PATH_SITE . 'includes/footer.php'; ?>
