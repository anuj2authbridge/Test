<?php
namespace App\Controller;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use App\Model\Entity\Booking;
class ServicesController extends AppController
{

   //public $uses=array('Registrations','Comments','Tags');
    //public $components=array('Csrf');

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['login','registration']);
    } 
   // public function initialize()  
   // {
      //  parent::initialize();
       // $this->loadComponent('Cookie');
//        $this->Cookie->config(array(
//        'expires' => '+10 days',
//        //'httpOnly' => true
//        ));
        
  //  }
   public function booking()
   {
        //$this->loadModel('Service');
        // pr($this->Services->find('all'));
        //$this->setAction('index');
       
        $service_list = TableRegistry::get('Services');
        $bookings = TableRegistry::get('Bookings');    

        $service_list = $service_list->find('list',array('keyField' => 'id','valueField' => 'service'));
        
           //debug($service_list->toArray());
          //$bookings = TableRegistry::get('Bookings');
         $booking=$bookings->newEntity($this->request->data(),array('validate'=>false));
         //$booking=$bookings->newEntity($this->request->data,['validate' => 'update']);
         
        if($this->request->is('post'))
        { 
            //pr($this->request->data);die;
            //$save_data['service_id']=$this->request->data['service_id'];
            //$save_data['service_date']=$this->request->data['service_date']['year'].'-'.$this->request->data['service_date']['month'].'-'.$this->request->data['service_date']['day'].' '.$this->request->data['service_date']['hour'].':'.$this->request->data['service_date']['minute'].':'.$this->request->data['service_date']['second'];
           // $save_data['service_date']=$this->request->data['service_date'];
           // $save_data['images']=$this->request->data['images']['name'];
           // $save_data['service_location']=$this->request->data['service_location'];
           // $booking=$bookings->patchEntity($booking,$save_data);
           // pr($this->request->data);
            $this->request->data['images']=time().'_'.$this->request->data['images_data']['name'];
          // pr($booking);
            $booking=$bookings->patchEntity($booking,$this->request->data);
           // pr($this->request->data);die;
           pr($booking);die;
        if($bookings->save($booking))
            {
              move_uploaded_file($this->request->data['images_data']['tmp_name'],WWW_ROOT.'img'.DS.'images'.DS.$this->request->data['images_data']['name']); 
              $this->Flash->success('saved');
              $this->redirect(array('action'=>'booking'));
                
            }
            else
            {
                $this->Flash->error('error in save');
            }
     

        }
        $this->set(array('service_list'=>$service_list,'booking'=>$booking));	  
	   
   }
   public function index()
   {
      $bookings=TableRegistry::get('Bookings');
      $booking=$bookings->find('all',array('contain'=>array('Services')));
                
      //debug($booking->toArray());
     // debug($booking);
    $this->set(compact('booking'));

   }
   public function edit($id)
   {
       $conn = ConnectionManager::get('default');
       $Bookings=TableRegistry::get('Bookings');
        $booking=$Bookings->get($id);
        //debug($Bookings->query('select * from bookings')->toArray());
        
        $Services = TableRegistry::get('Services');
        $conn->begin();
        $service_list = $Services->find('list',array('keyField' => 'id','valueField' => 'service'));       
        $this->set(compact('booking','service_list'));
       // debug($booking);
        if($this->request->is('put'))
        {
            $booking_data=$Bookings->patchEntity($booking,$this->request->data);
            if($Bookings->save($booking_data))
            {
                echo $this->Flash->success('Updated successfully');
                $conn->commit();
            }
            else
            {
                 echo $this->Flash->error('Updated successfully');

            }
            
        }
   }
   public function orm()
   {
    $this->layout=false;
    $this->autoRender=false;
    $service_list = TableRegistry::get('Services');
    $bookings = TableRegistry::get('Bookings');
 /*debuging start*/
         $list = $service_list->find('list')
                 ->select(array('id', 'service'));
    //      debug($list->toArray());     // 1) select list
            
            $booking = $bookings
                            ->find()
                            //->where(array('id' => 1,'OR'=>array('service_location'=>'agra','service_id'=>1)))
                            ->where(array('id !=' => 1,'OR'=>array('service_location'=>'agra','service_id'=>1)))
                            ->all();
        // debug($booking);     // 2) where condition combined with AND,where->(array('id')),where->(array('service_location')) with next line
         //debug($booking->toArray());     // 2) where condition combined with AND,where->(array('id')),where->(array('service_location')) with next line
        $booking = $bookings
                ->find()
                ->where(array('author_id' => 2))
                ->orWhere(array('author_id' => 3))
                ->andWhere(array(
                'published' => true,
                'view_count >' => 10
                ))
                ->orWhere(array('promoted' => true));
         //debug($booking->toArray());     // 5) //distinct    
                  $booking = $bookings
                            ->find()
                            ->select(array('myid'=>'id','service_location')) //alias of id
                            ->where(array('id' => 1))
                            ->first();
        //  debug($booking->toArray());     // 3) select,alias 
                  $booking = $bookings
                            ->find()
                            ->distinct(array('service_id')); 
        // debug($booking->toArray());     // 4) //distinct
                  $booking = $bookings
                            ->find()
                            ->distinct(array('service_id')); 
           //debug($booking->toArray());     // 5) //advance where conditions
      $booking = $bookings
                ->find()
                ->where(array('service_id' => 2,'service_location'=>'agra'))
                ->orWhere(array('service_id' => 3,'service_location'=>'agra'))
                ->orWhere(array('service_id' => 3));
         //debug($booking);    
         //debug($booking->toArray());     // 6) //advance where conditions
          
         $booking = $bookings->find()
            ->where(function ($exp) {
                return $exp
                    ->eq('service_id', 4)
                    ->notEq('service_location', 'agra');
                    //->gt('view_count', 10);
                    //->and_();
                    //->_or();
            });
             // debug($booking);    
             //debug($booking->toArray());     // 7) //advance where conditions  
  
            $booking = $bookings
                            ->find()
                            ->limit(2);
                            //->page(2);
          //debug($booking);    
         //debug($booking->toArray());    // 8) //limit        
 
        $booking = $bookings
            ->find()
            ->order(array('service_location' => 'DESC'));

        //debug($booking);    
        //debug($booking->toArray());    // 8) //order by  
        
        $booking = $bookings->find()
                    ->select(['count_alias' => $booking->func()->count('*')]);   
//   debug($booking);    
//   debug($booking->toArray());    // 8) //sql functions 
        
//        $query = $bookings->find();
//        $year = $query->func()->year([
//           'created' => 'literal'
//        ]);
//        $time = $query->func()->date_format([
//           'created' => 'literal',
//           "'%H:%i'" => 'literal'
//        ]);
//       $query->select([
//           'yearCreated' => $year,
//          'timeCreated' => $time
//        ]);
        
/* 
    By making arguments with a value of literal,
    the ORM will know that the key should be treated as a literal SQL value 
    litrals are nothing just like constants and we are telling ORM that treat key as value not as 
    alias and perform mathematical operation on it.
 */        
       // $query->select(array('year_created'=>$query->func()->year(array('created'=>'literal')),'time_created'=>$query->func()->time(array('created'=>'literal'))));
      //debug($query);    
      //debug($query->toArray());    // 8) //sql functions 
      
        
        $booking = $bookings->find()
                            ->select(array('service_locationssss' =>$booking->func()->concat(array(
                            'service_location' => 'literal',
                            ' service_id'=>'literal'
                            ))));     
        
    //debug($query);    
    // debug($booking->toArray());    // 8) //sql functions 
    /* When hydration is disabled results will be returned as basic arrays.   
     * it will disable making fields to entity,objects.it will disable entity hydration 
     */  
        $booking = $bookings->find()
                            ->hydrate(false)
                            ->select([
            'count' => $booking->func()->count('service_id'),
            'service_loc' => 'service_location'
        ])
        ->group('service_loc');
        //->having(['count >=' => 2]);
        //debug($booking);    
        //debug($booking->toArray());      
        //pr($booking->toArray());
//        foreach($booking->toArray() as $key=>$object)
//        {
//            echo $object->get('service_loc');
//        }
        $sid=array(1,2);
        $booking = $bookings->find()
                            ->hydrate(false)
                            ->where(array('service_id IN'=>$sid));

        // debug($booking->toArray());  // IN clause 
        // Get just the first row
        //$row = $query->first();

        // Get the first row or an exception.
        // $row = $query->firstOrFail();
        $booking = $bookings->find()
                             ->count();   
         //debug($booking);  
        //total records The count() method will ignore the limit, offset and page clauses
        // Loading Associations->This technique of combining queries to fetch associated data from other tables is called eager loading using contain.      
        //You can load nested associations-> using nested arrays to define the associations to be loaded    
        
        $query = $bookings->find()->contain([
        'Authors' => ['Addresses'], 'Comments' => ['Authors']
        ]);
        //Alternatively, you can express nested associations using the dot notation
        
        $query = $bookings->find()->contain([
        'Authors.Addresses',
        'Comments.Authors'
        ]);
  //You can eager load associations as deep as you like:  
        $query = $bookings->find()->contain([
        'Shops.Cities.Countries',
        'Shops.Managers'
        ]);
  //If you need to reset the containments on a query you can set the second argument to true
        $query = $bookings->find();
        $query->contain(['Authors', 'Comments'], true);

// Note For BelongsTo and HasOne associations only the where and select clauses are used when loading the associated records. For the rest of the association types you can use every clause that the query object provides.

        $query = $bookings->find()
                ->contain([
        'Comments',
        'Authors.Profiles' => function ($q) {
             return $q->where(['Profiles.is_published' => true]);
            }
        ]); // Notice where . notation for deep data access
//If you need full control over the query that is generated, you can tell contain to not append the foreignKey constraints to the generated query. In that case you should use an array passing foreignKey and queryBuilder:
        $query = $bookings->find()->contain([
            'Authors' => [
                'foreignKey' => false,
                'queryBuilder' => function ($q) {
                    //return $q->where(...); // Full conditions for filtering
                }
            ]
        ]);  
    //  If you have limited the fields you are loading with select() but also want to load fields off of contained associations, you can use autoFields():      
// Select id & title from articles, but all fields off of Users.
        $query->select(['id', 'title'])
            ->contain(['Users'])
            ->autoFields(true);
        
    /*ASSOCIATIONS WORKING EXAMPLES*/  
        
   $booking=$bookings->find()
           ->hydrate(false)
           ->select(array('service_location','Services.service'))
//           ->contain(array('Services','MyHobbies.Hobbies'=>function ($q)  //contain with condition 
//           {
//            return $q->select(array('Hobbies.hobby'));
//           }
//          ))
//            ->contain(array('Services','MyHobbies.Hobbies'=>function ($q)
//                {
//                return $q->where(array('Hobbies.id'=>1)); // Full conditions for filtering now you have full controll
//                }
//            ));  // Contain with out condition
//             ->contain(array('Services','MyHobbies.Hobbies'))  // contain with out condition
//          ->matching('Services',function ($q)  //for matching data use 'use' keyword to pass dynamic data instade of 'vage' 
//               {
//                     return $q->where(array('Services.service' => 'vage'));
//               });

//           ->matching(
//                    'MyHobbies.Hobbies', function ($q) {
//                        return $q->where(array('Hobbies.Hobby' => 'sleeping'));
//                    }
//                );               
           ->join(array('table' => 'services',
               'alias' => 'Services',
               'conditions' => 'Services.id = Bookings.service_id'
               ));
   //debug($booking);
  // debug($booking->toArray());
  //echo json_encode($booking->toArray());

   
//        $query = $bookings->query(); //it is also capable to write query
//        $query->update()
//         ->set(['service_location' =>'jarar'])
//         ->where(array('id' => 1))
//         ->execute();
     /******Retrieving Data & Results Sets*******/
      $booking=$bookings->get(1);
      //debug($booking);
      //debug($booking->toArray());
      $booking=$bookings->find('list')
                        ->toArray();
   //pr($booking);
   //FULL CONTROLL ON association   
        $booking=$bookings->find()
           ->hydrate(false)
           //->contain(array('Services','MyHobbies.Hobbies'));
               // ->select('id')
               ->contain(array(
               'Services' => array('foreignKey' => false,'queryBuilder' => function ($q) {
                  return $q->where(array('Services.id IN'=>array(1,2)));}),
               'MyHobbies.Hobbies' => function ($q) {
                  return $q->where(array('Hobbies.id IN'=>array(3,4)));}));
                  //->autoFields(false);
  //pr($booking->toArray());
 //onfly bind model                 
   /*
     $bookings->belongsTo('NewServices', array('className' => 'Services','foreignKey' => 'service_id'));
   
  
    $booking = $bookings->find()
            ->hydrate(false)
            ->contain(array('NewServices'));
    
    */
    //'NewServices' => array('strategy' => 'select')));
    //debug($booking->toArray());
   /*
          $booking = $bookings
            ->find()
            ->hydrate(false)
           // ->first();    //to find first result
            ->last();    //to find last result
           // ->where(array('author_id' => 2));
    
    */
          $booking = $bookings->find()
                              ->hydrate(false);
                              if(!$booking->isEmpty())
                              {
                                 debug($booking->toArray());
                              }
                 // debug($booking->toArray());
    /*DEBUGING END*/       
   } 
   public function entity()
   {
        
        $book = new Booking();
        $book->service_locationy = 'This is my first post';
        echo $book->service_locationy;
    echo "<hr>";
        $book->set('title', 'This is my first post');
        echo $book->get('title');
    echo "<hr>";
//        $this->loadModel('Bookings');

    $bookings = TableRegistry::get('Bookings');
    pr($bookings->find()->first()->toArray());
    //echo json_encode($bookings->find()->first()->toArray());
    
  
   // echo $book->full_name;
   

    //echo $book->_getJoinLocation();
        die;
      
   }
   public function saving_data()
   {
       $this->autoRender=false;
       $this->layout=false;
       $this->Registrations=TableRegistry::get('Registrations');
    
       $registration_data=$this->Registrations->newEntity();
       $registration_data->name='amit mohan 3';
       $registration_data->service_id='2';
      // pr($registration_data);
       if($this->Registrations->save($registration_data)) 
       {
           echo 'saved';
           echo $registration_data->id;
       }
       else
       {
           echo 'not saved';
       }
       
   }
  public function updating_data()
   {
       $this->autoRender=false;
       $this->layout=false;
       $this->Registrations=TableRegistry::get('Registrations');
       $registration_data=$this->Registrations->get(2); //it meance $registration_data->id=2;
       $registration_data->name='Anil mohan tyagi';
      
       $registration_data->service_id=4;
       //pr($registration_data);
       if($this->Registrations->save($registration_data))
       {
           echo 'updated';
           
       }
       else
       {
           echo 'not updated';
       }
       
   }
   public function saving_data_with_association_belongsTo()
   {
       $this->layout=false;
       $this->autoRender=false;
       $this->Registrations=TableRegistry::get('Registrations');
      // $rd=$this->Registrations->find()->hydrate(false)->contain(array('Services'))->toArray();
      //There should be association in model to save associated data
        $sevice= $this->Registrations->Services->findByService('pizza')->first();
        $registration_data=$this->Registrations->newEntity();
        $registration_data->name='Anuj sharma';
        $registration_data->service=$sevice; 
        //it meance $registration_data->service_id=1 
       
        if($this->Registrations->save($registration_data)) //can also use 'associated' property
        {
        echo 'saved </br>';
        echo 'service_id='.$registration_data->service_id;
        }
        else
        {
        echo 'not saved';
        } 
     
       
   }
   
     public function saving_data_with_association_hasMany()
     {
        $this->layout=false;
        $this->autoRender=false;
        $this->Registrations=TableRegistry::get('Registrations');
        // $rd=$this->Registrations->find()->hydrate(false)->contain(array('Services','Comments'))->toArray();
        //pr($rd);die;
        $comments_data1=$this->Registrations->Comments->newEntity();
        $comments_data1->comment='this is test comment one';
        
        $comments_data2=$this->Registrations->Comments->newEntity();
        $comments_data2->comment='this is test comment two';
        
        $association_data=$this->Registrations->get(2);
        $association_data->comments=array($comments_data1,$comments_data2); 
       //what value keyword is this 'comments' it is model name in singular to know more about it print $rd
       // registration_id will save autometicly
        
        //pr($association_data);die;
        // try to just convert everything similar to pr($rd)
        
        if($this->Registrations->save($association_data)) ////can also use 'associated' property
        {
            echo 'saves';
        }
        else
        {
            echo 'not saved';
        }
        
     }
    public function entity_patch()
    {
        $this->layout=false;
        $this->autoRender=false;
        
        $this->request->data['name']='xyz';
        $this->request->data['service_id']=1;
        
        pr($this->request->data);
        $this->Registrations=tableRegistry::get('registrations');
        $ent=$this->Registrations->newEntity($this->request->data);
        pr($ent);
 
//TEST 1->in case of edit
        $singel_record=$this->Registrations->get(2);
        $pth=$this->Registrations->patchEntity($singel_record,$this->request->data);
        pr($pth);
//TEST 2
        $d['service_id']=2;
        $pth=$this->Registrations->patchEntity($ent,$d);
        pr($pth);
//TEST 3        
        $this->request->data['service_id']=2;
        $pth=$this->Registrations->patchEntity($ent,$this->request->data);
        pr($pth);
        
        
//        if($this->Registrations->save($ent))
//        {
//            echo 'saved';
//        }
//        else
//        {
//            echo 'not saved';
//        }
        //pr($ent);
    }
    public function associations()
    {
        $this->layout=false;
        $this->autoRender=false;

        $this->loadModel('Registrations');
        $this->loadModel('Comments');
        $this->loadModel('Tags');
        $query=$this->Registrations->find()
                ->hydrate(false)
                ->contain(array('Services','Hobbies','Comments'))
                ->all();
       // pr($query->toArray());
        /*****mant to many association*****/
        $query2=$this->Comments->find()
                ->hydrate(false)
                ->contain(array('Tags'))
                ->all();
       // pr($query2->toArray());
        $query2=$this->Tags->find()
                ->hydrate(false)
                ->contain(array('Comments'))
                ->all();
        pr($query2->toArray());
    
        
    }
    public function components_testing()
    {
        //$this->layout=false;
       // $this->autoRender=false;
/*cookie*/
        $this->loadComponent('Cookie');
        // $this->Cookie->write('User.name', 'Larry');
        //echo $this->Cookie->read('User.name');
        //        $this->Cookie->write('User',
        //        array('name' => 'Larry', 'role' => 'Lead')
        //        );
        //  echo $this->Cookie->read('User.name');
        //echo $this->Cookie->read('User.role');
        // $this->Cookie->delete('User.name');
        //  $this->Cookie->write('xxx', 'yyy');
        // echo $this->Cookie->read('xxx');
        //          
        //          if($this->Cookie->check('User.name'))
        //          {
        //              pr($this->Cookie->read('User'));
        //          }
 /*flash*/          
        //both working
        //$this->Flash->greateSuccessOk('greateSuccess');
        //$this->Flash->GreateSuccessOk('greateSuccessOk');
        // $this->Flash->set('this is simple text message without eliment render');

//following not working
//              $this->Flash->greateSuccessOk('The user has been saved', [
//            'key' => 'positive',
//            'params' => [
//                'name' => 'name',
//                'email' => 'email'
//            ]
//        ]);
         
    }      

 /*End*/           
}	
