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
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Users',
);
?>

<h1>Users</h1>

<div class="links" >
<?php 
 $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Create User', 'url'=>array('/user/create')),
			),
		)); ?>
</div>        

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns' =>array('fname','lname','username','email',
	array('class'=>'CButtonColumn'),
	)
	
)); ?>
