<table class="listeLegere">
    <tr>
        <th>Date</th>
        <th>Visiteur</th>
        <th>Montant</th>
    </tr>

    <?php foreach ($fiches as $fiche): ?>
        <tr>
            <td>
                <a href="<?= site_url('Rembourserfrais/' . $fiche['idFiche']) ?>">
                    <?= esc($fiche['dateModifFr']) ?>
                </a>
            </td>
            <td>
                <a href="<?= site_url('Rembourserfrais/' . $fiche['idFiche']) ?>">
                    <?= esc($fiche['nomComplet']) ?>
                </a>
            </td>
            <td>
                <a href="<?= site_url('Rembourserfrais/' . $fiche['idFiche']) ?>">
                    <?= esc($fiche['montantFormate']) ?> &#8364;
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>