
<h1>Tous les utilisateurs du Blog</h1>
<?=
$this->html->link('Ajouter un utilisateur',
        ['controller' => 'users', 'action' => 'add'],
        ['class' => 'button']);
?>

<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>LastName</th>
        <th>Age</th>
        <th>Username</th>
        <th>Email</th>
        <th>NB ARTICLES</th>
        <th>Date de cr&eacute;ation</th>
        <th>Date de modification</th>
        <th>Actions</th>
    </tr>

    <!-- Ici se trouve l'itération sur l'objet query de notre $mesArticles, l'affichage des infos des articles -->
    <?php foreach ($mesUsers as $user): ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= $user->name ?></td>
            <td><?= $user->lastname ?></td>
            <td><?= $user->age ?></td>
            <td><?= $user->username ?></td>
            <td><?= $user->email ?></td>
            <td><?= count($user->articles) ?></td>
            <td><?= $user->created->format(DATE_RFC850) ?></td>
            <td><?= $user->modified->format(DATE_RFC850) ?></td>
            <td>
                <?=
                $this->html->link('Modifier',
                        ['controller' => 'users', 'action' => 'edit', $user->id],
                        [
                            'class' => 'button',
                            'style' => 'background-color: Orange']);
                ?>
                <?=
                $this->Form->postLink(
                        __('Supprimer'),
                        ['action' => 'delete', $user->id],
                        [
                            'confirm' => __("Vraiment supprimer l'utilisateur {0} dont l'id vaut {1} ", $user->username, $user->id),
                            'class' => 'button',
                            'style' => 'background-color: Black'])
                ?> 

            </td>
        </tr>
    <?php endforeach; ?>
</table>
