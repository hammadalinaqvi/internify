<style type="text/css">
.links ul{
	margin:0;
	padding:0;
	 float:right;
	}
.links ul li{
	list-style:none;
	margin-bottom:5px;
}
</style>
<?php

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->username,
);
?>
<div class="links" >
<?php 
 $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Back Link', 'url'=>array('/user/index')),
			),
		)); ?>
</div>        
<h1>View <?php echo ucwords($model->fname)."&nbsp;". ucwords($model->lname); ?> Details</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fname',
		'lname',
		'username',
		'email',
		'act_type',
		'joindate',
		'status',
	),
)); ?>
