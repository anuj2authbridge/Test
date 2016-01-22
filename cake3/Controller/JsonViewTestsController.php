<?php
namespace App\Controller;
use Cake\Event\Event;
class JsonViewTestsController  extends AppController
{
   
    public function initialize()
    {
       parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function view_json()
    {
        
        $this->layout=false;
        $this->autoRender=false;
        $this->loadModel('Bookings');
                 $booking = $this->Bookings->find()->hydrate(false)
                            ->where(array('id !=' => 1,'OR'=>array('service_location'=>'agra','service_id'=>1)))
                            ->all()
                            ->toArray();
         
         //debug($booking->toArray());
   // $this->set(compact('booking'));
                echo json_encode($booking);
         //$this->set('_serialize', array('booking'));
    }
    
}
?>
