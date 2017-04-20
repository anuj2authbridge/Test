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

?>
<!DOCTYPE html>
<html>
<head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo Configure::read("site_title") ?>:
            <?php echo $title_for_layout; ?>
        </title>
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
            'AdminLTE',
            'custom',
        ]
    );
    echo $this->fetch('css');
    /*JS files*/
        echo $this->Html->script(
          [
            'jQuery/jquery-2.2.3.min.js',
            'bootstrap.min',
            'app',
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
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <?php
                echo $this->Html->image('logo/title.png',
                        array('width' => '250px')
                    );
              ?>
        </div>
        <div class="login-box-body">
            <?=$this->fetch('content'); ?>
        </div>
    </div>
</body>
</html>
