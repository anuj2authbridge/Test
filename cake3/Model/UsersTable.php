<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->table('users');
	 $this->primaryKey('UID');
        $this->addAssociations([
            'belongsTo'=>[
                'Test'=>['className'=>'Test', 'foreignKey'=>'id']
            ]
        ]);
        
        
    }
    /*** for other db connection ***/	
     public static function defaultConnectionName() {
        return 'otherdb_name';
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
    	
    public function validationTest1(Validator $validator)
    {
        $validator
            ->notEmpty('first_name', 'First Name is Required')            
            ->notEmpty('last_name', 'Last Name is Required')
            ->notEmpty('email_id', 'Email Address is Required')
            ->notEmpty('mobile_no', 'Mobile Number is Required')
            ->notEmpty('company_name', 'Company Name is Required')
            ->notEmpty('company_address', 'Company Address is Required')
            ->notEmpty('pin_code', 'Pin Code is Required')
            ->notEmpty('city_id', 'City is Required')
            ->notEmpty('state_id', 'State is Required')
            ->notEmpty('country_id', 'Country is Required');
        
          $validator->add('email_id', 'validFormat', [
                'rule' => 'email',
                'message' => 'Email address must be Valid'
          ]);
                   
          $validator->add(
                'email_id', 
                ['unique' => [
                    'rule' => 'validateUnique', 
                    'provider' => 'table', 
                    'message' => 'Email Id is already in use.']
                ]
            );
          
          $validator->add(
                'mobile_no', 
                ['unique' => [
                    'rule' => 'validateUnique', 
                    'provider' => 'table', 
                    'message' => 'Mobile no. is already in use.']
                ]
            );

          $validator->add('pin_code', 'custom', [
                'rule' => [$this, 'validatePinCode'],
                'message' => 'Pin Code must be Valid'
          ]);
          
          $validator->add('is_aggree', 'custom', [
            'rule' => [$this, 'AcceptTerm'],
            'message' => 'You must agreed Term and Condition'
        ]);
        
        return $validator;
    }
	
    public function AcceptTerm($value,$context)
    {
        if($context['data']['is_aggree']==1)
            return true;
        else
            return false;
    }
	
    public function validatePinCode($value,$context)
    {
        if(!preg_match('/^\d{6}$/', $context['data']['pin_code']))        
            return false;
        else
            return true;
    }
	
    
   /****change Password ****/
 public function validationPassword(Validator $validator )
    {

        $validator
            ->add('old_password','custom',[
                'rule'=>  function($value, $context){
                    $user = $this->get($context['data']['id']);
                    if ($user) {
                        if ((new DefaultPasswordHasher)->check($value, $user->password)) {
                            return true;
                        }
                    }
                    return false;
                },
                'message'=>'The old password does not match the current password!',
            ])
            ->notEmpty('old_password');

        $validator
            ->add('password1', 'custom', [
                'rule' => [$this, 'validatePasswordStrength1'],
                'message' => 'Passwords must contain at least eight characters, including uppercase, lowercase letters, numbers and special characters!',
               
            ])
            ->add('password1',[
                'match'=>[
                    'rule'=> ['compareWith','password2'],
                    'message'=>'The passwords does not match!',
                ]
            ])
            ->notEmpty('password1');
        $validator
             ->add('password2', 'custom', [
                'rule' => [$this, 'validatePasswordStrength2'],
                'message' => 'Passwords must contain at least eight characters, including uppercase, lowercase letters, numbers and special characters!',
               
            ])
            ->add('password2',[
                'match'=>[
                    'rule'=> ['compareWith','password1'],
                    'message'=>'The passwords does not match!',
                ]
            ])
            ->notEmpty('password2');

        return $validator;
    }
	
    public function validatePasswordStrength1($value,$context)
    {
        if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@#!%^*?&()-_{}|])[A-Za-z\d$@#!%^*?&()-_{}|]{8,14}$/', $context['data']['password1']))        
            return false;
        else
            return true;
    }
}
