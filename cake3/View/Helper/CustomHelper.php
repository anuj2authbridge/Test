<?php
namespace App\View\Helper;
use Cake\ORM\TableRegistry; 
use Cake\View\Helper;
use Cake\View\View;
use Cake\Core\Configure;
use Cake\I18n\Time;
use Cake\I18n\Date;

class CustomHelper extends Helper 
{
    
    /*
     * Get country name and code
     */
    public function countryList()
    {
        $country = TableRegistry::get('Country');
        return $country->find('list', array('keyField'=>'COUNTRY_CODE', 'valueField'=>'COUNTRY_NAME'))->toArray();
    }
}
