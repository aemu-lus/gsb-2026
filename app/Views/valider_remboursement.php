<div id="etatMontant">
    <div id="montantValide">
        Montant validé
        <div><?= esc($fiche['montantFormate']) ?> &#8364;</div>
    </div>
    <?php if (!empty($actionRemboursement) && $fiche['idEtat'] === 'VA'): ?>
        <div>
            <form action="<?= esc($actionRemboursement) ?>" method="post">
                <?= csrf_field() ?>
                <button type="submit" class="btn-subtle theme-success">Valider le remboursement</button>
            </form>
        </div>
    <?php endif; ?>
</div>