<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(array('login','index', 'add'));
    }

	
public function login()
    {
        $this->title_for_layout = "User Login";
        $this->viewBuilder()->layout('outer');
        $this->loadComponent('Cookie', ['expiry' => '2 day']);
	   if ($this->request->is('post'))		{
			
           if ( $this->Auth->identify()) 
			{
                $this->Auth->setUser($user);
				$user_form_data=$this->request->data;
				//pr($this->Auth->User());
				if($this->Auth->User('USER_STATUS')==0)
				{
					$this->Flash->error(__('Your login account has been disabled. Kindly confirm with your TL.'));	
					return $this->redirect($this->Auth->logout());
				}
				if($user_form_data['persistent']==1)
				{
					$this->Cookie->configKey('User', 'encryption', false);
					$this->Cookie->write('User',
						['USER_LOGINNAME' => $user_form_data['USER_LOGINNAME'], 'USER_PASSWORD' => $user_form_data['USER_PASSWORD'],'USER_STATUS'=>$this->Auth->User('USER_STATUS')]
					);
				}
				$UsersTable=TableRegistry::get('UserLoginActivities'); 
				$User=$UsersTable->newEntity();

				$User->USER_ID=$this->Auth->User('USER_ID');
				$User->LOGIN_DATE=date('Y-m-d H:i:s');
				$User->LOGIN_ACTION=1;
				$User->LOGIN_STATUS=1;
				$User->IP_ADDRESS=$this->request->clientIp();
				$UsersTable->save($User);
               return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
		else
		{
			$this->Cookie->configKey('User', 'encryption', false);
				$user=$this->Auth->User();
				if(!empty($user))
				{
					return $this->redirect($this->Auth->redirectUrl());
				}
                else if($this->Cookie->check('User.USER_ID') && $this->Cookie->check('User.USER_STATUS')!=0)
				{
					$this->request->data['USER_LOGINNAME']=$this->Cookie->read('User.USER_LOGINNAME');
					$this->request->data['USER_PASSWORD']=$this->Cookie->read('User.USER_PASSWORD');
					$user = $this->Auth->identify($this->request->data);
					if($user)
					{
						$this->Auth->setUser($user);
			    	    return $this->redirect($this->Auth->redirectUrl());
					}
				}					
			   else
			   {
				  $this->Cookie->delete('User');
			   } 
			   //$this->Cookie->read('User');die;
		}
    }
	
public function logout()
    {
		$session = $this->request->session();
		$session->destroy();
		//$this->Flash->success(__('Loged out successfully'));
		return $this->redirect($this->Auth->logout());
    }
}
