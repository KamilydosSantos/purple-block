<?php
session_start();

$base_url = "/purple-block";
?>

<div class="menu">
    <img src="<?= $base_url ?>/assets/img/logo.png" alt="Logo" class="logo" width="60" height="60">

    <ul class="menu-items">
        <li>
            <a href="<?= $base_url ?>/notas/notas.php">
                <img src="<?= $base_url ?>/assets/icons/notaIcon.svg" alt="Notas" width="30" height="30">
                <span>Notas Colaborativas</span>
            </a>
        </li>

        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
            <li>
                <a href="<?= $base_url ?>/administrativo/adminDashboard.php">
                    <img src="<?= $base_url ?>/assets/icons/dashboardIcon.svg" alt="Painel" width="30" height="30">
                    <span>Painel Administrativo</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>

    <ul class="logout">
        <li>
            <a href="<?= $base_url ?>/autenticacao/logout.php">
                <img src="<?= $base_url ?>/assets/icons/logoutIcon.svg" alt="Sair" width="30" height="30">
                <span>Sair</span>
            </a>
        </li>
    </ul>
</div>