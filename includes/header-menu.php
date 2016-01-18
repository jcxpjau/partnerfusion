<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <link href="<?php echo URL_SITE; ?>assets/main.css" rel="stylesheet">
    <title>Partner Fusion</title>
</head>
<body>
<section class="container admin-bar">
    <div class="wrapper">
        <ul>
            <li>
                <span class="user-info">Olá, <?php echo $_SESSION[ 'username' ]; ?></span>
            </li>
            <li>
                <a href="<?php echo URL_SITE . '?action=logout'; ?>">Logout</a>
            </li>
        </ul>
    </div>
</section>
<header class="container header">
    <div class="wrapper">
        <div class="logo container">
            <a href="<?php echo URL_SITE; ?>"><img src="<?php echo URL_SITE; ?>assets/img/partner_fusion_logo.png" /></a>
        </div>
        <nav class="menu">
            <ul class="menu-header">
                <li>
                    <a href="<?php echo URL_SITE . 'clientes/'; ?>">CLIENTES</a>
                    <ul class="submenu-nav">
                        <li><a href="<?php echo URL_SITE . 'clientes/?action=insert'; ?>">Novo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo URL_SITE . 'servicos/'; ?>">SERVIÇOS</a>
                    <ul class="submenu-nav">
                        <li><a href="<?php echo URL_SITE . 'servicos/?action=insert'; ?>">Novo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo URL_SITE . 'ordens/'; ?>">TRABALHOS</a>
                    <ul class="submenu-nav">
                        <li><a href="<?php echo URL_SITE . 'ordens/?action=insert'; ?>">Novo</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>