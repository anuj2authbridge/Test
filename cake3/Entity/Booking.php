<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
use Cake\Utility\Inflector;

class Booking extends Entity
{
    // Make all fields mass assignable for now.
   // protected $_accessible = array('service_id'=>false,'*'=>false);
    //$_properties['id'] = 'mudit';
   // protected $_virtual = ['full_name'];
    //  protected $_hidden = ['service_location'];


//     protected function _setServiceLocation($service_location)
//    {
//       
//        $this->set('slug', Inflector::slug($service_location));
//        return $service_location;
//    } 
    protected function _getFullName()
    {
        return $this->_properties['service_location']. '  '.$this->_properties['service_id'];
    }
//following creates problem in form
//   protected function _getServiceLocation()
//    {
//        return ucwords($this->_properties['service_location']);
//    }	

}
