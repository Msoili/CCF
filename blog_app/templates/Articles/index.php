<h1>Tous les articles du Blog</h1>
<?=
$this->html->link('Ajouter un article',
        ['controller' => 'articles', 'action' => 'add'],
        ['class' => 'button']);
?>

<table>
    <tr>
        <th>Id</th>
        <th>Titre</th>
        <th>Date de cr&eacute;ation</th>
        <th>Date de modified</th>
        <th>Créé par</th> 
        <th>Comments</th> 
        <th>Action</th>

    </tr>

    <!-- Ici se trouve l'itération sur l'objet query de notre $mesArticles, l'affichage des infos des articles -->
    <?php foreach ($mesArticles as $article): ?>
        <tr>
            <td><?= $article->id ?></td>
            <td>
                <?=
                $this->html->link($article->title, [
                    'controller' => 'articles',
                    'action' => 'detail',
                    $article->id]);
//l’url généré sera de la forme /articles/detail/…
                ?>
            </td>
            <td><?= $article->created->format(DATE_RFC850) ?></td>
            <td><?= $article->modified->format(DATE_RFC850) ?></td>
            <td><?= $article->user->username ?></td>
            <td><?= count($article->comments) ?></td>
            <td><?php
                $identity = $this->request->getAttribute('identity');
                if ($identity && ($article->user_id == $identity->id)) {
                    if ($identity) {
                        echo $this->html->link('modifier', [
                            'controller' => 'articles', 'action' => 'edit', $article->id],
                                ['class' => 'button', 'style' => 'background-color: coral']);
                        ?>
                    </td>
                    <td>
                        <?=
                        $this->Form->postLink(
                                __('Supprimer'),
                                ['action' => 'delete', $article->id],
                                ['confirm' => __("Voulez vous vraiment supprimer {0} dont l'id vaut {1} ", $article->title, $article->id),
                                    'class' => 'button', 'style' => 'background-color: Green']);
                    }
                }
                ?> 
            </td>
        </tr>
    <?php endforeach; ?>
</table>

