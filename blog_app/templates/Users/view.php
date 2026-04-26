<h1>Détail de l'utilisateur <?= h($leUser->id) ?></h1>

<p>
    <small>Created : <?= $leUser->created->format(DATE_RFC850) ?></small><br/>
    <small>Modified : <?= $leUser->modified->format(DATE_RFC850) ?></small>
</p>

<table>
    <tr>
        <th>Champs</th>
        <th>Valeur</th>
    </tr>

    <?php foreach ($leUser->toArray() as $userKey => $userValue): ?>
    <tr>
        <td><?= $userKey ?></td><td><?= $userValue ?></td>
    </tr>
   <?php endforeach; ?>
</table>

<?=
$this->html->link('Retour à la liste des utilisateurs', [
'controller' => 'users',
 'action' => 'index']);
?>