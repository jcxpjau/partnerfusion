<?php
include_once 'config.php';
include_once PATH_SITE . 'includes/header.php'; ?>
<section class="container form">
    <div class="wrapper">
        <div class="login">
            <form action="<?php echo URL_SITE; ?>" method="POST" >
                <fieldset>
                    <ul>
                        <li>
                            <label for="email">Email</label>
                            <input id="email" type="text" name="_email" />
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
                            <input type="hidden" name="login-form" value="1" />
                        </li>
                    </ul>
                </fieldset>
            </form>
            <span><?php echo ( isset( $this->error ) && $this->error ) ? $this->error : ''; ?></span>
        </div>
    </div>
</section>
<?php include_once PATH_SITE . 'includes/footer.php'; ?>

