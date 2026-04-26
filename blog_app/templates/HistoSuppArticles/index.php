<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\HistoSuppArticle> $histoSuppArticles
 */
?>
<div class="histoSuppArticles index content">
    <?= $this->Html->link(__('New Histo Supp Article'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Tous les Histo Supp Articles du Blog') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('idart') ?></th>
                    <th><?= $this->Paginator->sort('titleart') ?></th>
                    <th><?= $this->Paginator->sort('datesupp') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($histoSuppArticles as $histoSuppArticle): ?>
                <tr>
                    <td><?= $this->Number->format($histoSuppArticle->id) ?></td>
                    <td><?= $this->Number->format($histoSuppArticle->idart) ?></td>
                    <td><?= h($histoSuppArticle->titleart) ?></td>
                    <td><?= h($histoSuppArticle->datesupp) ?></td>
                    <td><?= $histoSuppArticle->hasValue('user') ? $this->Html->link($histoSuppArticle->user->name, ['controller' => 'Users', 'action' => 'view', $histoSuppArticle->user->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $histoSuppArticle->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $histoSuppArticle->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $histoSuppArticle->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $histoSuppArticle->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>