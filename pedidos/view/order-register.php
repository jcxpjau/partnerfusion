<?php require_once '../../includes/header.php'; ?>
<section class="container form">
    <div class="wrapper">
        <div class="register">
            <h3>Cadastro de Clientes</h3>
            <form action="" method="POST">
                <fieldset>
                    <ul>
                        <li>
                            <label for="client">Cliente</label>
                            <select id="client" name="_client_id">
                                <option>Selecione</option>
                            </select>
                        </li>
                        <li>
                            <label for="service">Serviço</label>
                            <select id="service" name="_service_id">
                                <option>Selecione</option>
                            </select>
                        </li>
                        <li>
                            <label for="dt-start">Data de inicío</label>
                            <input id="dt-start" class="date" type="input" name="_start" />
                        </li>
                        <li>
                            <label for="dt-end">Data de Término</label>
                            <input id="dt-end" class="date" type="input" name="_end" />
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
