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
        <?php if ($session->get('role') == 'Visiteur Médical'): ?>
        <li>
            <?= anchor('Accueil', 'Accueil', ['title' => 'Accueil']) ?>
        </li>
        <li>
            <?= anchor('Gererfrais', 'Saisie fiche de frais', ['title' => 'Saisie fiche de frais']) ?>
        </li>
        <li>
            <?= anchor('Etatfrais', 'Mes fiches de frais', ['title' => 'Consultation de mes fiches de frais']) ?>
        </li>
        <?php else: ?>
        <li>
            <?= anchor('Accueil', 'Accueil', ['title' => 'Accueil']) ?>
        </li>
        <li>
            <?= anchor('Validerfrais', 'Valider les fiches de frais', ['title' => 'Valider les fiches de frais']) ?>
        </li>
        <li>
            <?= anchor('Remboursement', 'Remboursements', ['title' => 'Gestion des remboursements']) ?>
        </li>
        <?php endif; ?>
    </ul>
</div>