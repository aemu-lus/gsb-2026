<?php $session = session(); ?>

<div id="menuGauche">
    <div id="infosUtil">
        <div id="user">
            <img src="<?= base_url('assets/images/UserIcon.png') ?>" alt="Utilisateur" />
        </div>
        <div id="infos">
            <h2><?= esc($session->get('prenom') . ' ' . $session->get('nom')) ?></h2>
            <h3><?= esc($session->get('role')) ?></h3>  
        </div>
        <ul class="menuList">
            <li>
                <?= anchor('connexion/deconnexion', 'Déconnexion', ['title' => 'Se déconnecter']) ?>
            </li>
        </ul> 
    </div>  

    <ul id="menuPrincipal" class="menuList">
        <li>
            <?php foreach ($menuItems as $item): ?>
                <a href="<?= base_url($item["usecase"]) ?>" title="<?= esc($item['texte']) ?>">
                   
                </a>
            <?php endforeach; ?>
        </li>
    </ul>
</div>
