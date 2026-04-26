<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table {

    public function initialize(array $config): void {
        $this->addBehavior('Timestamp');
        $this->hasMany('Articles');
        $this->hasMany('Comments', ['dependant' => true,]);
    }
    
    public function validationDefault(Validator $validator): Validator {
        $validator 
            ->notEmptyString('password', __('Veuillez renseigner un password'))
            ->notEmptyString('name', __('Veuillez renseigner un name'))
            ->notEmptyString('lastname', __('Veuillez renseigner un lastname'))
            ->notEmptyString('age', __('Veuillez renseigner un age'))
            ->naturalNumber('age',__('L\'age doit etre un nombre positif'))
            ->add('email',
                ['unique' => 
                    ['rule' => 'validateUnique', 
                    'provider' => 'table', 
                    'message' => 'L\'email est deja utilisé']])
            ->notEmptyString('email', __('Veuillez renseigner un email'))
            ->add('username',
                ['unique' => 
                    ['rule' => 'validateUnique', 
                    'provider' => 'table', 
                    'message' => 'L\'username est déja utilisé']])
            ->notEmptyString('username', __('Veuillez renseigner un username'));

        return $validator;
    }

}
