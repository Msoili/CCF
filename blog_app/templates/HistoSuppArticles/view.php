<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HistoSuppArticle $histoSuppArticle
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Histo Supp Article'), ['action' => 'edit', $histoSuppArticle->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Histo Supp Article'), ['action' => 'delete', $histoSuppArticle->id], ['confirm' => __('Êtes-vous sûr de vouloir supprimer # {0}?', $histoSuppArticle->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Histo Supp Articles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Histo Supp Article'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="histoSuppArticles view content">
            <h3><?= h($histoSuppArticle->titleart) ?></h3>
            <table>
                <tr>
                    <th><?= __('Titleart') ?></th>
                    <td><?= h($histoSuppArticle->titleart) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $histoSuppArticle->hasValue('user') ? $this->Html->link($histoSuppArticle->user->name, ['controller' => 'Users', 'action' => 'view', $histoSuppArticle->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($histoSuppArticle->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Idart') ?></th>
                    <td><?= $this->Number->format($histoSuppArticle->idart) ?></td>
                </tr>
                <tr>
                    <th><?= __('Datesupp') ?></th>
                    <td><?= h($histoSuppArticle->datesupp) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>