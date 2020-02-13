<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Utility\Security;

class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(array('login','signUp'));
    }
    
     public function login(){
        /* $hasher = new DefaultPasswordHasher();
        echo $hasher->hash('auth123');
        die(); */
        if ($this->Auth->user()) {
            return $this->redirect(['controller'=>'Dashboard','action'=>'index']);
        }
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                // By Default - Default Database
                $session = new Session();
                $session->write('database','default');
                // End By Default
                $this->loadModel('UserRoles');
                $roles = $this->UserRoles->getUserRoles($user['USER_ID']);
                if(!empty($roles) && count($roles) > 0){
                    $user['ROLE_ID'] = current(array_keys($roles));
                    $user['USER_ROLES'] = $roles;
                    $this->Auth->setUser($user);
                    return $this->redirect($this->Auth->redirectUrl());
                }else{
                    $this->Flash->error(__('Role not assigned.'));
                    return $this->redirect(['controller'=>'users', 'action'=>'logout']);
                }
                
            } else {
                $this->Flash->error(__('Username or password is incorrect'));
            }
        }
    }

    
    public function changePassword()
    {
        $user =$this->Users->get($this->Auth->user('id')); 
        if($this->request->is(['post', 'put'])){
        if (!empty($this->request->data)) { 
            $user = $this->Users->patchEntity($user, [
                    'old_password'  => $this->request->data['old_password'],
                    'password'      => $this->request->data['password1'],
                    'password1'     => $this->request->data['password1'],
                    'password2'     => $this->request->data['password2']
                ],
                ['validate' => 'password']
            );
            if(!$user->errors()) {
            if ($this->Users->save($user)) {
                $this->Flash->success('The password is successfully changed');                
            } else {
                $this->Flash->error('There was an error during the save!');
            }
            }
        }
        }
        
        $this->set('user',$user);
        
    } 
    
}
