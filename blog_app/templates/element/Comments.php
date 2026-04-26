<h1>Ajouter un comment</h1>
<?php
echo $this->Form->create($leNewComment);
echo $this->Form->control('title');
echo $this->Form->control('content');
echo $this->Form->button(__("Sauvegarder le commentaire"));
echo $this->Form->end();
?>


<?=
$this->html->link('Retour aux articles',
        ['controller' => 'articles', 'action' => 'index'],
        ['class' => 'button']);
?>

