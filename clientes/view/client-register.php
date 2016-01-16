<?php require_once '../../includes/header.php'; ?>
<section class="container form">
    <div class="wrapper">
        <div class="register">
            <h3>Cadastro de Clientes</h3>
            <form action="" method="POST">
                <fieldset>
                    <ul>
                        <li>
                            <label for="cli-name">Nome</label>
                            <input id="cli-name" type="input" name="_name" />
                        </li>
                        <li>
                            <label for="cli-branch">Setor</label>
                            <input id="cli-branch" type="input" name="_branch" />
                        </li>
                        <li>
                            <label for="cli-phone">Telefone</label>
                            <input id="cli-phone" class="phone-number" type="input" name="_phone" />
                        </li>
                        <li>
                            <input class="button" type="submit" value="Gravar" />
                        </li>
                    </ul>
                </fieldset>
            </form>
        </div>
    </div>
</section>
<?php require_once '../../includes/footer.php'; ?>
