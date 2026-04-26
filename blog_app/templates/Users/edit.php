<h1>Modifier l’utilisateur "<?= $leUser->username?>" (id = <?= $leUser->id ?>)</h1>
<?php
    echo $this->Form->create($leUser);
    echo $this->Form->control('name');
    echo $this->Form->control('lastname');
    echo $this->Form->control('age');
    echo $this->Form->control('email');
    echo $this->Form->control('username');
    echo $this->Form->control('password');
    echo $this->Form->button(__("Mettre à jour l’utilisateur"));
    echo $this->Form->end();
?>
<br/>
<?=
$this->html->link('Retour aux utilisateurs',
        ['controller' => 'users', 'action' => 'index'],
        ['class' => 'button']);
?>