<?php
namespace App\Controller;
use Cake\Event\Event;
class UsersController extends AppController
{

   public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['login','registration']);
    } 
	public function registration()
	{
	$this->layout='login_default';	
        $user = $this->Users->newEntity();
	
        if ($this->request->is('post'))
		{
			
        $user = $this->Users->patchEntity($user, $this->request->data);
        if ($this->Users->save($user))
			 {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(array('action' => 'login'));
             } 
            $this->Flash->error(__('Unable to add user.'));  
        }
        $this->set('user', $user);	

	}
	public function login()
	{
          $this->layout='login_default';	
		//$2y$10$JuKfjrqTAlldyQdWu/SJl.C3PW3pn/FsUSi2Y3HnIO1
		//pr($this->request->data);		
    if ($this->request->is('post')) {
        $user = $this->Auth->identify();
        if ($user) {
            $this->Auth->setUser($user);
            return $this->redirect(array('controller'=>'Dashboards','action'=>'index'));
        }
        $this->Flash->error('Your username or password is incorrect.');
    }		
}
	public function logout()
	{
		$this->Flash->success('You are now logged out.');
		return $this->redirect($this->Auth->logout());
	}
	public function edit()
	{
	    $pro_data = $this->Users->get($this->Auth->user('id'));
		if ($this->request->is(['post', 'put'])) 
		{
			$this->Users->patchEntity($pro_data,$this->request->data);
			if ($this->Users->save($pro_data)) {
				$this->Flash->success(__('Your article has been updated.'));
				return $this->redirect(array('action' => 'edit'));
			}
			$this->Flash->error(__('Unable to update your article.'));
		}

    $this->set('pro_data', $pro_data);	
		
	}
	public function view()
	{
		$view_profile_data=$this->Users->find('all')
										->first();			
		$this->set('view_profile_data',$view_profile_data);						
        }



/*End*/	
}
