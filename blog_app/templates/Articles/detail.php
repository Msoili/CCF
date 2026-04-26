<h1><?= h($leArticle->title) ?></h1>
<p><?= nl2br(h($leArticle->content)) ?></p>
<p>
    <small>Created : <?= $leArticle->created->format(DATE_RFC850) ?></small><br/>
    <small>Created by : <?= $leArticle->user->username ?></small>
</p>

<?php
echo $this->Html->script('jquery371min');
?>

<script>
    $(document).ready(function () {
        $("#showcom").click(function () {
            if ($("#display").is(":visible") == false)
            {
                $("#display").show();
            } else {
                $("#display").hide();
            }
        });
    });
</script>

<div class="related">
    <?php if (count($leArticle->tags)) : ?>
        <h4><?= __('Aucun Tags associés') ?></h4>
    <?php else : ?>
        <h4><?= __(' Tags associés') ?></h4>
        <div class="table-responsive">
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <th><?= __('Title') ?></th>
                    <th><?= __('Modified') ?></th>
                    <th><?= __('Priority') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($leArticle->tags as $unTag) : ?>
                    <tr>
                        <td><?= h($unTag->id) ?></td>
                        <td><?= h($unTag->title) ?></td>
                        <td><?= h($unTag->modified->format(DATE_RFC850)) ?></td>
                        <td><?= h($unTag->ArticlesTags['priority']) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Tags', 'action' => 'view', $unTag->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Tags', 'action' => 'edit', $unTag->id]) ?>
                            <?=
                            $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'ArticlesTags', 'action' => 'deleteAT', $leArticle->id, $unTag->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $unTag->id),
                                    ]
                            )
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>
</div>

<h3>Les commentaires</h3>   
<?php foreach ($leArticle->comments as $comm): ?>
    <table border="1">
        <tr>
            <td><?= $comm->title ?> créé par <?= $comm->user->username ?></td>

        </tr>
        <tr>
            <td><?= nl2br(h($comm->content)) ?></td>
        </tr>
        <tr>
            <td>id : <?= $comm->id ?>
                Cr&eacute;&eacute; le : <?= $comm->created->format(DATE_RFC850) ?>
            </td>
        </tr>
        <tr>
            <td><?php
                $identity = $this->request->getAttribute('identity');
                if ($identity && ($comm->user_id == $identity->id || $leArticle->user_id == $identity->id)) {
                    echo $this->Form->postLink(
                            __('Supprimer'),
                            ['controller' => 'comments', 'action' => 'delete', $comm->id],
                            [
                                'confirm' => __("Vraiment supprimer {0} dont l'id vaut {1} ", $comm->title, $comm->id),
                                'class' => 'button',
                                'style' => 'background-color: Black']);
                }
                ?> 
            </td>
        </tr>
    </table>
<?php endforeach; ?>


<?=
$this->Html->link(
        'Ajoutez un commentaire', '#', ['class' => 'button', 'id' => 'showcom']
);
?>

<div id="display" style="display: none">
    <?= $this->element('comments'); ?>
</div>



<?=
$this->html->link('Retour à la liste des articles', [
    'controller' => 'articles',
    'action' => 'index']);
?>