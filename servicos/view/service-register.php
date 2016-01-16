<?php require_once '../../includes/header.php'; ?>
<section class="container form">
    <div class="wrapper">
        <div class="register">
            <h3>Cadastro de Serviços</h3>
            <form action="" method="POST">
                <fieldset>
                    <ul>
                        <li>
                            <label for="serv-name">Serviço</label>
                            <input id="serv-name" type="input" name="_name" />
                        </li>
                        <li>
                            <label for="serv-resume">Descrição</label>
                            <input id="serv-resume" type="input" name="_resume" />
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
