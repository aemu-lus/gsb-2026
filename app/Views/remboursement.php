<table class="table table-striped">
  <?php foreach ($remboursements as $remboursement): ?>
    <tr>
      <td><?= esc($remboursement['date']) ?></td>
      <td><?= esc($remboursement['montant']) ?></td>
      <td><?= esc($remboursement['mode_paiement']) ?></td>
    </tr>
  <?php endforeach; ?>
</table>