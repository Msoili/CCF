<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ArticlesTable extends Table {

    public function initialize(array $config): void {
        $this->addBehavior('Timestamp');
        $this->belongsTo('Users');
        $this->hasMany('Comments', [
            'dependent' => true,
        ]);
         $this->belongsToMany('Tags', [
            'foreignKey' => 'article_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'articles_tags',
              ]);
    }

    public function validationDefault(Validator $validator): Validator {
        $validator
                ->notEmptyString('title', __('Veuillez renseigner un title'))
                ->notEmptyString('content', __('Veuillez renseigner un content'))
                ->notEmptyString('user_id', __('Veuillez renseigner un user'));

        return $validator;
    }
}
