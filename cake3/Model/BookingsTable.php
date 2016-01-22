<?php


/**
 * Description of BookingsTable
 *
 * @author mudittyagi
 */
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;
class BookingsTable extends Table {
  
    //put your code here
    
    public function initialize(array $config)
    {
         $this->belongsTo('Services');
         $this->hasMany('MyHobbies');
        // $this->belongsTo('NewServices', array('className' => 'Services','foreignKey' => 'service_id'));
    }
    public function validationUpdate(Validator $validator)
   {
    $validator = new Validator();
         $validator
        ->notEmpty('service_id', 'Type of Service field is require')
        ->notEmpty('service_date', 'Service date field is require')
        ->notEmpty('service_location', 'service location field is require');
    return $validator;       
    }
    
}
