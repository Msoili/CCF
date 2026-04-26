<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CommentsTable extends Table {

    public function initialize(array $config): void {
        $this->addBehavior('Timestamp');
        $this->belongsTo('Articles');
        $this->belongsTo('Users');
    }

    public function validationDefault(Validator $validator): Validator {
        $validator
                ->notEmptyString('title', __('Veuillez renseigner un title'))
                ->notEmptyString('content', __('Veuillez renseigner un content'))
                ->notEmptyString('article_id', __('Veuillez renseigner un article'));

        return $validator;
    }
}
