<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <link href="<?php echo URL_SITE; ?>assets/main.css" rel="stylesheet">
    <title>Partner Fusion | Home</title>
</head>
<body>
<header class="container header">
    <div class="wrapper">
        <div class="logo container">
            <img src="<?php echo URL_SITE; ?>assets/img/partner_fusion_logo.png" />
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