<div class="pagination_bar">
<!--<div class="pull-left"><a href=""><i class="fa fa-caret-left"></i> <strong>Go Back</strong></a></div>-->
<?php  echo $this->Paginator->counter('{{page}} - {{current}} of {{count}}');?>
<ul class="pagination pull-right">
<li><?php   echo $this->Paginator->prev('<i class="fa fa-caret-left"></i>', ['escape'=>false]); ?></li>
<li><?php echo $this->Paginator->next('<i class="fa fa-caret-right"></i>', ['escape'=>false]); ?></li>
</ul>
</div>

sort data by column wise


<?php echo  $this->Paginator->sort('Companys.company_name','<span style="color:white">Name</span>',['escape'=>false]); ?>
