<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable  extends Table{
    
    public function validationDefault(Validator $validator) {
      
           $validator->notEmpty('email', 'Email required');
           $validator->notEmpty('password', 'Password required');
           $validator->add('email', 'valid-email', ['rule' => 'email']);
           return $validator;
    }
}
