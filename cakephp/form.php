<?php 
//create a form
echo $this->Form->create('Test', array('id' => 'test_id', 'class'=>'form-horizontal'));?>

//create a form to search (verbose url)
echo $this->Form->create('Test', array('id' => 'test_id', 'class'=>'form-horizontal', 'type'=>'get', 
'url' => array('controller' => 'tests', 'action' => 'index') + $this->request->params['pass']));?>

// input type text

<?php 
echo $this->Form->input('Test.input_name',array('type'=>'text', 'id'=>'input_id', 'class'=>'', 
'label'=>false, 'div'=>false)); ?>

// input type select

<?php											
		echo $this->Form->input('Test.input_name',array('type'>'select', 'id'=>'input_id', 
		'options'=>$options, 'empty'=>'-Select-', 'label'=>false, 'legend'=>false, 
		'div'=>false, 'hiddenField'=>false));
			
		?>
		
		// end of form
		<?php echo $this->Form->end();?>
		
		--------------------------
		
		// link 
		<?php 
							echo $this->Html->link(
							$this->Html->image('excel_icon.gif'),
							array(
							'controller' => 'test', // controller name
							'action' => 'index/export:csv?'.$exportExcell,  //action name
							'full_base' => true
							),
							array(
							'escape'=>false,'style'=>'margin-right:5px;', 'title'=>'Export'));
						?>
