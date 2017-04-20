<div class="clearfix">
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create(); ?>
    <div class="form-group has-feedback">
        <?=$this->Form->input('USERNAME', array('placeholder' => 'Email','class'=>'form-control','label'=>false))?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <?=$this->Form->input('PASSWORD', array('type'=>'password','placeholder' => 'Password','class'=>'form-control','label'=>false))?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
        <div class="col-xs-4">
            <?php echo $this->Form->button('Sign In', array('class' => 'btn btn-primary btn-block btn-flat')); ?>
        </div>
    </div>
    <div class="row">
                    <div class="checkbox">
                      <label>
                        <?php echo $this->Form->checkbox('persistent',array('value'=>1)); ?> Remember me
                      </label>
                  </div>
    </div>
    <?php
    echo $this->Form->end();
    echo $this->Html->link('Forgot Password ?', array('controller' => 'users', 'action' => 'login'));
    ?>
</div>
