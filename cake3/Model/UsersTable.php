<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
public function beforeFilter(Event $event)
    {
	parent::initialize($config);
        $this->table('users');
        $this->primaryKey('UID');
        $this->Auth->allow(['regisstration']);
    }
	
	
    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('fname', 'A firstname is required')
            ->notEmpty('lname', 'A last name is required')
            ->notEmpty('email', 'email is required')
            ->notEmpty('password', 'A password is required') 
			 ->add('password', 'passwordsEqual', [
				'rule' => function ($value, $context) {
				return
					isset($context['data']['cpassword']) &&
					$context['data']['cpassword'] === $value;},
				'message'=>'Password not matched'	
				])
            ->notEmpty('tnc', 'You must accept our terms of service');

    }
    	

}
