<?php helper('form'); ?>

<div id="etatMontant">
    <div id="etat" class="<?= esc($fiche['idEtat']) ?>">
        <?= esc($fiche['libelle']) ?> depuis le <?= esc($fiche['dateModifFr']) ?>
    </div>
    <div id="montantValide">
        Montant validé
        <div><?= esc($fiche['montantFormate']) ?> &#8364;</div>
    </div>

    <?php if (!empty($actionRemboursement) && $fiche['idEtat'] === 'VA'): ?>
        <div class="piedForm">
            <?= form_open($actionRemboursement) ?>
                <p>
                    <?= form_submit('btnRembourser', 'Valider le remboursement', ['class' => 'bouton']) ?>
                </p>
            <?= form_close() ?>
        </div>
    <?php endif; ?>
</div>