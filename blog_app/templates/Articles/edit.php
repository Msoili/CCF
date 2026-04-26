
<h1>Modifier le post "<?= $leArticle->title ?>" (id = <?= $leArticle->id ?>)</h1>
<?php
echo $this->Form->create($leArticle);
echo $this->Form->control('title');
echo $this->Form->control('content', ['rows' => '3']);
//echo $this->Form->control('user_id',
//        ['options' => $mesUsers, 'label' => 'Selectionnez un user']);

echo $this->Form->button(__("Mettre à jour le post"));
echo $this->Form->end();

?>
<div style="margin: 20px 0;">
    <label style="display: block; margin-bottom: 15px; font-weight: bold;">Associer des tags :</label>

    <?php foreach ($mesTags as $id => $tagName): ?>
        <div style="border: 1px solid #ddd; padding: 12px; margin-bottom: 10px; background: #f9f9f9; border-radius: 4px;">
            <div style="display: flex; justify-content: space-between; align-items: stretch; min-height: 36px;">
                <div style="display: flex; align-items: center; flex: 1;">
                    <?=
                    $this->Form->checkbox("tags[_ids][]", [
                        'value' => $id,
                        'style' => 'margin: 0; margin-right: 10px; width: 18px; height: 18px; vertical-align: middle;',
                        'id' => "tag-{$id}",
                        'hiddenField' => false
                    ])
                    ?>
                    <?=
                    $this->Form->label("tag-{$id}", $tagName, [
                        'style' => 'font-weight: 600; cursor: pointer; margin: 0; line-height: 1.5;'
                    ])
                    ?>
                </div>

                <div style="display: flex; align-items: center; gap: 8px; margin: 0; padding: 0;">
                    <span style="font-size: 14px; color: #666; line-height: 1.5;">Priorité :</span>
                    <?=
                    $this->Form->number("tags[_joinData][{$id}][priority]", [
                        'id' => "tags[_joinData][{$id}][priority]",
                        'style' => 'width: 70px; height: 32px; padding: 4px 8px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; margin: 0; box-sizing: border-box; line-height: 1;',
                        'min' => 1,
                        'max' => 5,
                        'value' => 1,
                        'label' => false
                    ])
                    ?>
                </div>
            </div>
        </div>
<?php endforeach; ?>
</div>
<br/>
<?=
$this->html->link('Retour a la liste des articles', [
    'controller' => 'articles',
    'action' => 'index']);
?>
