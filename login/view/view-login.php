<?php require_once '../../includes/header.php'; ?>
<section class="container form">
    <div class="wrapper">
        <div class="login">
            <form action="#" method="POST" >
                <fieldset>
                    <ul>
                        <li>
                            <label for="email">Email</label>
                            <input id="email" type="input" name="_email" />
                        </li>
                        <li>
                            <label for="pwd">Senha</label>
                            <input id="pwd" type="password" name="_pwd" />
                        </li>
                        <li>
                            <p class="rememberme">
                                <input id="remember" type="checkbox" name="_rememberme" />
                                <label for="remember">Manter conectado</label>
                            </p>
                            <input class="button btn-login" type="submit" value="Login" />
                        </li>
                    </ul>
                </fieldset>
            </form>
        </div>
    </div>
</section>
<?php require_once '../../includes/footer.php'; ?>
