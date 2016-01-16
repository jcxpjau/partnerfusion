<?php
include_once 'config.php';
include_once PATH_SITE . 'includes/header.php';
?>
<section class="home container">
    <div class="wrapper">
        <div class="catalog">
            <ul class="catalog">
                <li>
                    <div class="box-client">
                        <a href="<?php echo URL_SITE . 'clientes'?>">Clientes</a>
                    </div>
                </li>
                <li>
                    <div class="box-service">
                        <a href="<?php echo URL_SITE . 'servicos'?>">Serviços</a>
                    </div>
                </li>
                <li>
                    <div class="box-order">
                        <a href="<?php echo URL_SITE . 'pedidos'?>">Ordens</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>
<?php include_once PATH_SITE . 'includes/footer.php'; ?>
