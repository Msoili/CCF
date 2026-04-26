<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HistoSuppArticle $histoSuppArticle
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Histo Supp Articles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="histoSuppArticles form content">
            <?= $this->Form->create($histoSuppArticle) ?>
            <fieldset>
                <legend><?= __('Add Histo Supp Article') ?></legend>
                <?php
                    echo $this->Form->control('idart');
                    echo $this->Form->control('titleart');
                    echo $this->Form->control('datesupp');
                    echo $this->Form->control('user_id', ['options' => $users]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
