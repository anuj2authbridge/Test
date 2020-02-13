<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class User extends Entity
{

    // Make all fields mass assignable except for primary key field "id".
    protected $_accessible = [
        '*' => true,
        'USER_ID' => false
    ];


    protected function _setUSER_PASSWORD($password)
    {
	   return (new DefaultPasswordHasher)->hash($password);
    }    

}
