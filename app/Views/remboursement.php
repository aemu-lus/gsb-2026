<table class="table table-striped">
  <?php foreach ($remboursements as $remboursement): ?>
    <tr>
      <td><?= esc($remboursement['date']) ?></td>
      <td><?= esc($remboursement['nom']) ?></td>
      <td><?= esc($remboursement['montant']) ?></td>
    </tr>
  <?php endforeach; ?>
</table>