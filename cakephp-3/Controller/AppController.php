<?php

namespace ClientConfiguration\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;
use Cake\Http\ServerRequest;
use Cake\Http\Response;
use Cake\I18n\Time;

require_once CONFIG . 'smart_configuration.php';

/**
 * CakePHP AppController
 * @author vinay.kumar
 */
class AppController extends BaseController {

    public $curdate = null;
    public $curdateTime = null;
    public $responseArr = [];
    private $_isAjax = false;

    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, $eventManager = null, $components = null) {
        parent::__construct($request, $response, $name, $eventManager, $components);
        if ($request->is('ajax') && strtolower($request->params['controller']) == 'ajax') {
            $this->_isAjax = true;
            $request->params['_ext'] = 'json';
        }
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $date = new Time('now');
        $this->curdate = $date->format('Y-m-d');
        $this->curdateTime = $date->format('Y-m-d H:i:s');
        //set paginate limit globly;
        $session = $this->request->getSession();
        $limit = $session->read('limit');
        if (empty($limit)) {
            $limit = 25;
            $session->write('limit', $limit);
        }
        if (isset($this->request->query['limit']) && !empty($this->request->query['limit'])) {
            $limit = $this->request->query['limit'];
            $session->write('limit', $limit);
        }
        $this->paginate['limit'] = $limit;
    }

    public function beforeRender(Event $event) {
        parent::beforeRender($event);
        if ($this->_isAjax) {
            $this->set([
                'response' => $this->responseArr,
                '_serialize' => ['response']
            ]);
        } else {
            $this->viewBuilder()->setLayout('client-configuration');
            $this->set($this->responseArr);
        }
    }

    public function invokeAction() {
        try {
            parent::invokeAction();
        } catch (\Exception $ex) {
            $message = $ex->getMessage();
            $code = $ex->getCode();
            if ($this->_isAjax) {
                $this->responseArr['error'] = TRUE;
                $this->responseArr['message'] = $message;
            } else {
                $this->Flash->error($message);
            }
            if ($code == 404) {
                $this->render('/Supervisors/index');
            }
        }
    }

    public function loadModels($models = []) {
        if (empty($models)) {
            return NULL;
        }
        if (!is_array($models)) {
            $models = [$models];
        }
        foreach ($models as $model) {
            $this->loadModel($model);
        }
    }

}
