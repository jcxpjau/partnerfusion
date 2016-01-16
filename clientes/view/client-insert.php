<?php include_once PATH_SITE . 'includes/header.php'; ?>
<section class="container form">
    <div class="wrapper">
        <div class="register">
            <h3>Cadastro de Clientes</h3>
            <form action="<?php echo URL_SITE . 'clientes/?action=insert'; ?>" method="POST">
                <fieldset>
                    <ul>
                        <li>
                            <label for="cli-name">Nome</label>
                            <input id="cli-name" type="text" name="_name" />
                        </li>
                        <li>
                            <label for="cli-branch">Setor</label>
                            <input id="cli-branch" type="text" name="_branch" />
                        </li>
                        <li>
                            <label for="cli-phone">Telefone</label>
                            <input id="cli-phone" class="phone-number" type="text" name="_phone" />
                        </li>
                        <li>
                            <input type="hidden" name="client-form" value="1" />
                            <input class="button" type="submit" value="Gravar" />
                        </li>
                    </ul>
                </fieldset>
            </form>
        </div>
    </div>
</section>
<?php include_once PATH_SITE . 'includes/footer.php'; ?>
