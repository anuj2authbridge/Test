<?php
namespace ExcelProcessor\Controller;

use ExcelProcessor\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\Datasource\ConnectionManager;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Shared_Date;
use Cake\Utility\Hash;
class AjaxController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }
    
    public function index()
    {
        $this->viewBuilder()->layout(false);
        $this->autoRender = false;
        if($this->request->is('ajax'))
        {
            $this->loadModels(['Test']);
            $data = $this->request->data;
            $id = isset($data['id']) ? $data['id'] : "";
          
            if(!empty($id) && !empty($id))
            {         
              $data = $this->Test->getData($id);
              $this->set(compact('data'));
              $this->viewBuilder()->templatePath('Element/default');
              $this->render('test');  
            }else{
              echo "Invalid Request";
              exit();
              } 
        }
    }
}
