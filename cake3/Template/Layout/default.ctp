<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Core\Configure;
use Cake\Routing\Router;
?>
<!DOCTYPE html>
<html>
<head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo Configure::read("site_title") ?>:
            <?php echo $title_for_layout; ?>
        </title>
        <script type="text/javascript" charset="utf-8">	
            var SITE_URL = "<?php echo SITE_URL;?>";
        </script>
        <?php
        
        /*Meta files*/
        echo $this->Html->meta('icon');
        echo $this->Html->meta(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no,text/html,charset=UTF-8']);
        echo $this->fetch('meta');
        
         /*CSS files*/
        echo $this->Html->css([
            'bootstrap/css/bootstrap.min',
            'font-awesome.min',
            'ionicons.min',
            'skins/_all-skins',
            'AdminLTE',            
            'jquery-ui/jquery-ui',
            'jquery.contextMenu',
            'plugins/select2/select2',
            'custom'
        ]
    );
    echo $this->fetch('css');
    /*JS files*/
        echo $this->Html->script(
          [
            'jQuery/jquery-2.2.3.min',
            'jquery-ui/jquery-ui', 
            'jquery-ui/jquery.ui.datepicker',
            'jquery-ui/jquery-ui-timepicker-addon',
            'bootstrap.min',
            'slimScroll/jquery.slimscroll.min',
            'fastclick/fastclick',
            'app',
            'common',
            'jquery.contextMenu',
            'input-mask/jquery.inputmask',
            'input-mask/jquery.inputmask.extensions',
            'jQuery/jquery.form-validator.min', 
            'plugins/select2/select2.min'
        ]);
        echo $this->fetch('script');
        ?>
      
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<body class="hold-transition skin-blue layout-top-nav fixed">
<div class="wrapper">
  <?= $this->element('header') ?>
  <div class="content-wrapper">
    <div class="container-fluid">
        <!--<section class="content-header">
            <h1><?=$this->fetch('title', $title_for_layout);?></h1>
            <?php 
            $actionName = $this->request->params['action'];
            $actionUrl = 'index';
            if (!isset($controllerName)) $controllerName = $this->request->params['controller'];
            if ($this->request->params['controller'] != 'dashboard'):
                if (isset($controllerName) && !empty($controllerName)):
                    if (!isset($breadcrumb) || empty($breadcrumb)): ?>
                        <ol class="breadcrumb">
                            <li><a href="<?=$this->Url->build(["controller" => "dashboard","action" => "index"])?>">Home</a></li>
                            <?php if(isset($controllerName) && !empty($controllerName)):
                                if(isset($actionName) && !empty($actionName) && $actionName != 'index'): ?>
                                    <li><?php echo $this->Html->link(ucfirst($controllerName), array('controller' => $this->request->params['controller'], 'action' => $actionUrl)); ?></li>
                                <?php else: ?>
                                    <li class="active">
                                        <?php echo $this->Html->link(ucfirst($controllerName), array('controller' => $this->request->params['controller'], 'action' => $actionUrl)); ?>
                                    </li>
                                <?php endif;
                            endif;
                            if (isset($actionName) && !empty($actionName) && $actionName != 'index'): ?>
                                <li class="active"><?php echo ucfirst($actionName); ?></li>
                            <?php endif; ?>
                        </ol>
                    <?php else :
                    echo $this->Breadcrumb->create($breadcrumb);
                    endif;
                endif;?>
            <?php endif; ?>
        </section>-->
        <section class="content">
            <div class="row">
                <div class="col-lg-12 col-less-padding">
                    <?= $this->Flash->render() ?>  
                </div>  
            </div>
        <?= $this->fetch('content') ?>
        </section>
        <div id="loadingDiv"></div>
    </div>
  </div>
  <?= $this->element('footer') ?>  
</div> 
</body>
</html>
